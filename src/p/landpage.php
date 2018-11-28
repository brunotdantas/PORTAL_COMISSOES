<?php
  include '../pFixas/cabec.php';

// Busca Numero de lojas
$nLojas = 0;

$sql = " SELECT COUNT(*) nLojas FROM lojas  ";
$resultado = sqlsrv_query( $conn, $sql);
  while($dados= sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){
    $nLojas= $dados["nLojas"];
  }

// Busca Número de vendedores
$nVendedores = 0;
$sql = " SELECT COUNT(*) nVend FROM vendedores  ";
$resultado = sqlsrv_query( $conn, $sql);
  while($dados=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){
    $nVendedores= $dados["nVend"];
  }

  $ticketMedio = 0;
  $sql = " select round(avg(cast(ValorTotal as money)),2) TICKET_MEDIO from  VendasCabec where  format([dataVenda],'MM') = format(getdate(),'MM')   ";
  $resultado = sqlsrv_query( $conn, $sql);
    while($dados=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){
      $ticketMedio= $dados["TICKET_MEDIO"];
    }


// Vendedor TOP 1 vendas
$sql = "
SELECT top 1
      vendas.[idVendedor]
	  ,v.Nome
      ,round(sum(cast([ValorTotal] as money)),2) as TOTAL_VENDIDO

  FROM [Portal].[dbo].[VendasCabec] vendas
	inner join vendedores v on v.idVendedor = vendas.idVendedor
  where  format([dataVenda],'MM') = format(getdate(),'MM')
  group by vendas.[idVendedor],Nome
   order by sum(cast([ValorTotal] as money)) desc
   ";
   $resultado = sqlsrv_query( $conn, $sql);
     while($dados=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){
       $vendedorTOP   = $dados["Nome"];
       $totalVendido  = $dados["TOTAL_VENDIDO"];
     }

//Monta o array para popular o gráfico

$sql = "
          select
          case
            WHEN format(dataVenda,'MM') = '01' THEN 'JANEIRO' + '/' +format(dataVenda,'yyyy')
               WHEN format(dataVenda,'MM') = '02' THEN 'FEVEREIRO'  + '/' +format(dataVenda,'yyyy')
               WHEN format(dataVenda,'MM') = '03' THEN 'MARÇO'          + '/' +format(dataVenda,'yyyy')
               WHEN format(dataVenda,'MM') = '04' THEN 'ABRIL'          + '/' +format(dataVenda,'yyyy')
               WHEN format(dataVenda,'MM') = '05' THEN 'MAIO'          + '/' +format(dataVenda,'yyyy')
               WHEN format(dataVenda,'MM') = '06' THEN 'JUNHO'          + '/' +format(dataVenda,'yyyy')
               WHEN format(dataVenda,'MM') = '07' THEN 'JULHO'          + '/' +format(dataVenda,'yyyy')
               WHEN format(dataVenda,'MM') = '08' THEN 'AGOSTO'     + '/' +format(dataVenda,'yyyy')
               WHEN format(dataVenda,'MM') = '09' THEN 'SETEMBRO'   + '/' +format(dataVenda,'yyyy')
               WHEN format(dataVenda,'MM') = '10' THEN 'OUTUBRO'    + '/' +format(dataVenda,'yyyy')
               WHEN format(dataVenda,'MM') = '11' THEN 'NOVEMBRO'   + '/' +format(dataVenda,'yyyy')
               WHEN format(dataVenda,'MM') = '12' THEN 'DEZEMBRO'   + '/' +format(dataVenda,'yyyy')
          END AS MES_VENDA,

          sum(convert(money,ValorTotal)) AS VENDA_MES

          from VendasCabec
          where format(dataVenda,'ddMMyyyy') >= format(getdate()-600,'ddMMyyyy')
          group by format(dataVenda,'MM'),format(dataVenda,'yyyy')
      ";


      $sql = "
        DECLARE @DataINI varchar(30) = FORMAT(DATEADD(MONTH, DATEDIFF(MONTH, 0, GETDATE()),   0 ),'yyyyMMdd')
        DECLARE @DataFIM varchar(30) = FORMAT(DATEADD(MONTH, DATEDIFF(MONTH, -1, GETDATE()), -1),'yyyyMMdd')
        declare @curDate datetime = @dataINI
        begin try drop table #days end try begin catch end catch
        select @curDate as DataVenda ,0 qtdVenda into #days
        while(@curDate < @DataFIM )
        begin
             set @curDate = DATEADD(d, 1, @curDate)
             insert into #days values (@curDate,0)
        end

        begin try drop table tmp_tb_".$_SESSION['cpf']." end try begin catch end catch

        select d.DataVenda AS DIA_VENDA ,isnull(sum(convert(money,v.ValorTotal)),0) AS QTD_VENDA into tmp_tb_".$_SESSION['cpf']."  from #days d
        left join VendasCabec v on v.dataVenda = d.DataVenda
        group by d.DataVenda
      ";

  $resultado = sqlsrv_query( $conn, $sql);
  if( $resultado === false ) {
       die( print_r( sqlsrv_errors(), true));
  }


  $sql = "select
            format(DIA_VENDA,'dd') DIA_VENDA,
            [QTD_VENDA] ,
            		case
            				WHEN format(DIA_VENDA,'MM') = '01' THEN 'JANEIRO' + '/' +format(DIA_VENDA,'yyyy')
            				WHEN format(DIA_VENDA,'MM') = '02' THEN 'FEVEREIRO'  + '/' +format(DIA_VENDA,'yyyy')
            				WHEN format(DIA_VENDA,'MM') = '03' THEN 'MARÇO'          + '/' +format(DIA_VENDA,'yyyy')
            				WHEN format(DIA_VENDA,'MM') = '04' THEN 'ABRIL'          + '/' +format(DIA_VENDA,'yyyy')
            				WHEN format(DIA_VENDA,'MM') = '05' THEN 'MAIO'          + '/' +format(DIA_VENDA,'yyyy')
            				WHEN format(DIA_VENDA,'MM') = '06' THEN 'JUNHO'          + '/' +format(DIA_VENDA,'yyyy')
            				WHEN format(DIA_VENDA,'MM') = '07' THEN 'JULHO'          + '/' +format(DIA_VENDA,'yyyy')
            				WHEN format(DIA_VENDA,'MM') = '08' THEN 'AGOSTO'     + '/' +format(DIA_VENDA,'yyyy')
            				WHEN format(DIA_VENDA,'MM') = '09' THEN 'SETEMBRO'   + '/' +format(DIA_VENDA,'yyyy')
            				WHEN format(DIA_VENDA,'MM') = '10' THEN 'OUTUBRO'    + '/' +format(DIA_VENDA,'yyyy')
            				WHEN format(DIA_VENDA,'MM') = '11' THEN 'NOVEMBRO'   + '/' +format(DIA_VENDA,'yyyy')
            				WHEN format(DIA_VENDA,'MM') = '12' THEN 'DEZEMBRO'   + '/' +format(DIA_VENDA,'yyyy')
                    END AS MES_VENDA


  from tmp_tb_".$_SESSION['cpf'];
  $resultado = sqlsrv_query( $conn, $sql);
  if( $resultado === false ) {
       die( print_r( sqlsrv_errors(), true));
  }
  //var_dump($_SESSION);  // cpf

  $row_count = sqlsrv_num_rows( $resultado );

  $i = 1;

  $mesVenda = "";
  $dadosGrafico = "data : [ ";
  while($dados=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){
    $dadosGrafico .= "['".$dados["DIA_VENDA"]."',".$dados["QTD_VENDA"];

    $mesVenda = $dados["MES_VENDA"];

    if ($i == $row_count) {
      $dadosGrafico .= "]";
    }else{
      $dadosGrafico .= "],";
    }
    $i++;
  }
  $dadosGrafico .= "],";

?>


<!-- FLOT CHARTS -->
<script src="../../bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="../../bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="../../bower_components/Flot/jquery.flot.pie.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="../../bower_components/Flot/jquery.flot.categories.js"></script>
<!-- ChartJS -->
<script src="../../bower_components/Chart.js/Chart.js"></script>

<!-- page script -->
<script>
  $(function () {

    /*
       * BAR CHART
       * ---------
       */

      var bar_data = {
        <?= $dadosGrafico ?>
        color: '#3c8dbc'
      }
      $.plot('#bar-chart', [bar_data], {
        grid  : {
          borderWidth: 1,
          borderColor: '#f3f3f3',
          tickColor  : '#f3f3f3'
        },
        series: {
          bars: {
            show    : true,
            barWidth: 0.5,
            align   : 'center'
          }
        },
        xaxis : {
          mode      : 'categories',
          tickLength: 0
        }
      });
  });
</script>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bem vindo ao portal de comissões
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

    <?php
    switch ($_SESSION["cargo"]) {
      case 1:

      echo '';

      case 2:

        echo '
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>'.$nLojas.'</h3>

              <p>Lojas cadastradas</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
          </div>
        </div> <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-light-blue">
            <div class="inner">
              <h3>'.$nVendedores.'</h3>
              <p>Funcionários ativos no sistema</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div> <!-- ./col -->

        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-star-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Vendedor TOP 1 de Vendas</span>
              <span class="info-box-number">'.$vendedorTOP.'</span>
              <span class="info-box-number">Total Vendido : R$ '.$totalVendido.'</span>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
      ';

      echo '

      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="small-box bg-green">
          <div class="inner">
            <h2><strong>R$</strong> '.$ticketMedio.'</h3>
            <p>Ticket Médio</p>
          </div>
          <div class="icon">
            <i class="fa fa-dollar"></i>
          </div>

        </div>
        </div>

      </div>
      ';

        echo '

        <div class="box box-primary">
                    <div class="box-header with-border">
                      <i class="fa fa-bar-chart-o"></i>

                      <h3 class="box-title">Relação de vendas de '.$mesVenda.'</h3>

                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                      </div>
                    </div>
                    <div class="box-body">
                      <div id="bar-chart" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base" width="567" height="375" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 454.2px; height: 300px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 75px; top: 283px; left: 21px; text-align: center;">January</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 75px; top: 283px; left: 93px; text-align: center;">February</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 75px; top: 283px; left: 175px; text-align: center;">March</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 75px; top: 283px; left: 253px; text-align: center;">April</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 75px; top: 283px; left: 329px; text-align: center;">May</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 75px; top: 283px; left: 401px; text-align: center;">June</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 270px; left: 7px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 203px; left: 7px; text-align: right;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 135px; left: 1px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 68px; left: 1px; text-align: right;">15</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;">20</div></div></div><canvas class="flot-overlay" width="567" height="375" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 454.2px; height: 300px;"></canvas></div>
                    </div>
                    <!-- /.box-body-->
                  </div>
          ';

      case 3:
          echo '';
    }
    ?>

      </div>

    </section>     <!-- /.content -->
  </div>   <!-- /.content-wrapper -->

<?php include '../pFixas/footer.php'; ?>
