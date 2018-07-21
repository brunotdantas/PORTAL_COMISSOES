<?php
  include '../pFixas/cabec.php';

/**
 * D E M O S T R A Ç Ã O
 * TODO: o que temos que fazer ainda
 * ! isso é um aviso importante 
 * ? Isso é uma dúvida ou uma indicação de query 
 * 
 * 
 */
//// Isso é um comentário riscado

// Busca Numero de lojas 
$nLojas = 0;

$sql = " SELECT COUNT(*) nLojas FROM `lojas` WHERE 1  ";
$row = sqlsrv_query( $conn, $sql);
if($row-> num_rows>0){
  while($dados=$row->fetch_assoc()){
    $nLojas= $dados["nLojas"];
  }
}

// Busca Número de vendedores
$nVendedores = 0;

$sql = "SELECT COUNT(*) nVend FROM `vendedores`";
$row = sqlsrv_query( $conn, $sql);
if($row-> num_rows>0){
  while($dados=$row->fetch_assoc()){
    $nVendedores = $dados["nVend"];
  }
}

?>

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
          <a href="#" class="small-box-footer">
            More info <i class="fa fa-arrow-circle-right"></i>
          </a>
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
          <a href="manut_funcionarios.php" class="small-box-footer">
            Veja detalhes <i class="fa fa-arrow-circle-right"></i>
          </a>
        </div>
      </div> <!-- ./col -->
    ';

      case 2:
          echo '';

      case 3:
          echo '';
    }
    ?>

      </div>



    </section>     <!-- /.content -->
  </div>   <!-- /.content-wrapper -->

<?php include '../pFixas/footer.php'; ?>
