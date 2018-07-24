<?php
  include '../pFixas/cabec.php';
  $mensagem = '';

  $flag = isset($_GET['flag']) ? $_GET['flag'] : 'z';

  if ($flag == 1){
      $mensagem = '
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Valores inseridos/atualizados com sucesso!
      </div>
      ';
  }else if ($flag==2) {
      $mensagem = '
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        Ocorreu um erro no processo de inserção de registros, por favor contate o administrador do sistema
        informando essa mensagem
      </div>
     ';
  }


?>

//--- Modelo principal
<!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manutenção de funcionários
        <small></small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
<form class="" action="../valForms/valida_func.php" method="post">
<!--https://jsfiddle.net/JeZap/1560/-->
      <div class="box box-primary">
                <div class="box-header">
                  <!--<i class="fa fa-edit"></i>-->
                  <h3 class="box-title"></h3>
                  <?= $mensagem ?>
                <div class="box-body pad table-responsive">
                  <!-- Calendário: http://jsfiddle.net/DBpJe/15060/ -->
<!--  -->
                  <table class="table table-bordered text-center">
                    <tbody>
                    <tr>
                      <th colspan="3">Funcionários Cadastrados</th>
                    </tr>
                    <tr>
                      <th>CPF</th>
                      <th>Nome</th>
                      <th>Cargo</th>
                    </tr>

                  <?php
                    // Le quantas lojas existem
                    $contador = 0;

                    $sql = "SELECT CPF,Nome,idCargo, idVendedor FROM `vendedores`";

                    $resultado = sqlsrv_query( $conn, $sql);

                    if(sqlsrv_has_rows($resultado)){

                      while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){

                          $cpf    = $row["CPF"];
                          $nome   = $row["Nome"];
                          $idVendedor   = $row["idVendedor"];

                          $contador++;

                          echo '
                          <tr>
                            <td>'.$cpf.'</td> <input type="hidden" name="cpf'.$contador.'" value="'.$cpf.'">
                            <td>'.$nome.'</td><input type="hidden" name="nome'.$contador.'" value="'.$nome.'">
                            <td>
                            <input value="1" name="cargo'.$contador.'"  '.($row["idCargo"] == 1 ? 'checked' : '').' data-toggle="toggle" data-on="Gerente" data-off="Vendedor" type="checkbox" data-onstyle="success" data-offstyle="info">
                            </td>
                            <input type="hidden" name="idVendedor'.$contador.'" value="'.$idVendedor.'">
                          </tr>
                          ';
                      }
                    }
                  ?>

                  <input type="hidden" name="numFuncionarios" value="<?= $contador ?>">
                  </tbody></table>
                </div>
                <!-- /.box -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-info pull-right">Salvar</button>
                </div>
              </div> <!-- /.box-footer-->
      </form>
    </section>  <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

<?php include '../pFixas/footer.php'; ?>
