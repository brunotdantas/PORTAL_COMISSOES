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
        Cadastro de fatores de cálculo
        <small></small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
<form class="" action="../valForms/valida_fatCalc.php" method="post">
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
                      <th colspan="6">Regras existentes para fatores de cálculo</th>
                    </tr>
                    <tr>
                      <th>ID Regra</th>
                      <th>Ativo</th>
                      <th>Se aplica a</th>
                      <th>Descrição do Fator</th>
                      <th>Porcentagem aplicada</th>
                      <th>Valor pago</th>
                    </tr>

                  <?php
                    // Le quantas lojas existem
                    $contador = 0;

                    $sql = "SELECT * FROM fatores";

                    $resultado = sqlsrv_query( $conn, $sql);

                    if(sqlsrv_has_rows($resultado) > 0 ){

                      while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){

                          //print_r($row);

                          $ativo          = ($row["ativo"] == 1 ? 'checked' : '');
                          $descricaoFator = $row["descricaoFator"];
                          $vlPorcentagem  = $row["vlPorcentagem"];
                          $valor          = $row["vlReais"];
                          $seAplicaA      = ($row["idCargo"]==1 ? "Gerente" : "Vendedor" );
                          $idFator        = $row["idFator"];

                          $contador++;

                          echo '
                          <tr>
                            <td>
                              <input class="form-control"  type="text" name="idFat'.$contador.'" value="'.$idFator.'" readonly>
                            </td>
                            <td>
                              <input type="checkbox" name="ativo'.$contador.'" '.$ativo.'>
                            </td>
                            <td>'.$seAplicaA.'</td> <input type="hidden" name="aplica'.$contador.'" value="'.$seAplicaA.'">
                            <td>'.$descricaoFator.'</td><input type="hidden" name="descFator'.$contador.'" value="'.$descricaoFator.'">                            
                            <td>
                              <div class="input-group">
                                <input class="form-control" onkeypress="return isNumberKey(event)"   type="text" name="Porcentagem'.$contador.'" value="'.$vlPorcentagem.'" '.($row["vlPorcentagem"] === NULL ? "readonly" : '').'>
                                <span class="input-group-addon">%</span>
                              </div>
                            </td>
                            <td>
                              <div class="input-group">
                                <input id="campoNumero" onkeypress="return isNumberKey(event)" class="form-control" type="text" name="Valor'.$contador.'" value="'.$valor.'" '.($row["vlReais"] === NULL ? "readonly" : '').'>
                                <span class="input-group-addon">R$</span>
                              </div>
                            </td>
                          </tr>
                          ';
                      }
                    }
                  ?>
                  <input type="hidden" name="numFatores" value="<?= $contador ?>">
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

<script>
$(document).ready(function() {
});
</script>

<?php include '../pFixas/footer.php'; ?>
