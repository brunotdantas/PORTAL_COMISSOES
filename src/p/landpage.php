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
  $sql = " select cast(avg(cast(ValorTotal as money)) as  numeric(10,2)) TICKET_MEDIO from  VendasCabec where  format([dataVenda],'MM') = format(getdate(),'MM')   ";
  $resultado = sqlsrv_query( $conn, $sql);
    while($dados=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){
      $ticketMedio= $dados["TICKET_MEDIO"];
    }


// Vendedor TOP 1 vendas
$sql = "
SELECT top 1
        vendas.[idVendedor]
	     ,v.Nome
       ,cast(sum(cast([ValorTotal] as money)) as  numeric(10,2)) as TOTAL_VENDIDO

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
          tickColor  : '#f3f3f3',
          hoverable: true,
          clickable: true
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

      $("#bar-chart").UseTooltip();

  });

  //Initialize tooltip on hover
  var previousPoint = null, previousLabel = null;

  $.fn.UseTooltip = function () {
      $(this).bind("plothover", function (event, pos, item) {
          if (item) {
              if ((previousLabel != item.series.label) || (previousPoint != item.dataIndex)) {
                  previousPoint = item.dataIndex;
                  previousLabel = item.series.label;
                  $("#tooltip").remove();

                  var x = item.datapoint[0];
                  var y = item.datapoint[1];

                  var color = item.series.color;
                  var date = "R$" ;

                  var unit = "";

                  showTooltip(item.pageX, item.pageY, color,
                              "<strong>Total vendido</strong><br>" + date +
                              " : <strong>" + y + "</strong> " + unit + "");
              }
          } else {
              $("#tooltip").remove();
              previousPoint = null;
          }
      });
  };

  function showTooltip(x, y, color, contents) {
      $('<div id="tooltip">' + contents + '</div>').css({
          position: 'absolute',
          display: 'none',
          top: y - 40,
          left: x - 120,
          border: '2px solid ' + color,
          padding: '3px',
          'font-size': '9px',
          'border-radius': '5px',
          'background-color': '#fff',
          'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
          opacity: 0.9
      }).appendTo("body").fadeIn(200);
  }

</script>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bem vindo ao Portal de Comissões
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
              <h3 class="box-title">Relação de vendas de '.$mesVenda.' por dia</h3>
            </div>
            <div class="box-body">
              <div id="bar-chart" style="height: 300px; padding: 0px; position: relative;"></div>
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
