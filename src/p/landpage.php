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

//Monta o array para popular o gráfico

$dadosGrafico = "data : [
                    ['January', 10],
                    ['February', 8],
                    ['March', 4],
                    ['April', 13],
                    ['May', 17],
                    ['June', 9]
                ],";

// Busca vendas dos ultimos 12 meses
$sql = "
          select
          case
            WHEN format(dataVenda,'MM') = '01' THEN 'JANEIRO' + '/' +format(dataVenda,'yyyy')
          	WHEN format(dataVenda,'MM') = '02' THEN 'FEVEREIRO'  + '/' +format(dataVenda,'yyyy')
          	WHEN format(dataVenda,'MM') = '03' THEN 'MARÇO'	     + '/' +format(dataVenda,'yyyy')
          	WHEN format(dataVenda,'MM') = '04' THEN 'ABRIL'	     + '/' +format(dataVenda,'yyyy')
          	WHEN format(dataVenda,'MM') = '05' THEN 'MAIO'	     + '/' +format(dataVenda,'yyyy')
          	WHEN format(dataVenda,'MM') = '06' THEN 'JUNHO'	     + '/' +format(dataVenda,'yyyy')
          	WHEN format(dataVenda,'MM') = '07' THEN 'JULHO'	     + '/' +format(dataVenda,'yyyy')
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


  $resultado = sqlsrv_query( $conn, $sql);
  $row_count = sqlsrv_num_rows( $resultado );

  $i = 1;

  $dadosGrafico = "data : [ ";
  while($dados=sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){
    $dadosGrafico .= "['".$dados["MES_VENDA"]."',".$dados["VENDA_MES"];
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

        echo '    <div class="row">
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
      </div>
      ';


        echo '

        <div class="box box-primary">
                    <div class="box-header with-border">
                      <i class="fa fa-bar-chart-o"></i>

                      <h3 class="box-title">Relação de vendas</h3>

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
