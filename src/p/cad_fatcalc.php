<?php
// TODO: 1. Pensar em como adicionar dinamicamente os fatores, ou seja
// TODO:    o próprio usuário poder adicionar

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

<script>
$(document).ready(function(){

$( "#checkbox1:checkbox" ).change(
	function(){
      var isChecked = $( "#checkbox1" ).prop("checked");

          if (!isChecked){
            $("#porcentagem").attr('readonly',true);
            $("#campoNumero").attr('readonly',true);
            $( "#campoNumero" ).val("");
            $( "#porcentagem" ).val("");
          }else{
            $("#porcentagem").attr('readonly',false);
          }
});

$( "#checkbox1:checkbox" ).change(
	function(){
      var isChecked = $( "#checkbox1" ).prop("checked");

          if (!isChecked){
            $("#porcentagem").attr('readonly',true);
            $("#campoNumero").attr('readonly',true);
            $( "#campoNumero" ).val("");
            $( "#porcentagem" ).val("");
          }else{
            $("#porcentagem").attr('readonly',false);
          }
});




});

</script>

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
                      <th colspan="7">Regras existentes para fatores de cálculo</th>
                    </tr>
                    <tr>
                      <th>ID Regra</th>
                      <th>Ativo</th>
                      <th>Se aplica a</th>
                      <th>Descrição do Fator</th>
                      <th>Porcentagem aplicada</th>
                      <th>Valor pago</th>
                      <th>Qual o tipo de pagamento</th>
                    </tr>

                  <?php
                    // Le quantas lojas existem
                    $contador = 0;

                    $sql = "
                      SELECT
                        idFator ,
                        descricaoFator ,
                        cast(convert(numeric(10,2), vlPorcentagem) as varchar) as vlPorcentagem ,
                        cast(convert(numeric(10,2), vlReais) as varchar) as vlReais ,
                        ativo ,
                        create_time ,
                        update_time ,
                        cl.idCargo,
                        cl.Descricao,
                        isnull(tpPagamento,'') as tpPagamento
                      FROM fatores f
                      inner join Cargo_Lojas cl on cl.idCargo =  f.idCargo
                    ";

                    $resultado = sqlsrv_query( $conn, $sql);

                    if(sqlsrv_has_rows($resultado)){

                      while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){
                      //print_r($row);

                        $ativo          = ($row["ativo"] == 1 ? 'checked' : '');
                        $descricaoFator = $row["descricaoFator"];
                        $vlPorcentagem  = $row["vlPorcentagem"];
                        $valor          = $row["vlReais"];
                        $seAplicaA      = $row["Descricao"];
                        $idCargo        = $row["idCargo"];
                        $idFator        = $row["idFator"];
                        $tpPagamento    = $row["tpPagamento"];

                        $contador++;

                        echo '
                        <tr>
                          <td>
                            <input class="form-control"  type="text" name="idFat'.$contador.'" value="'.$idFator.'" readonly>
                          </td>
                          <td>
                            <input id="checkbox1" type="checkbox" name="ativo'.$contador.'" '.$ativo.'>
                          </td>
                          <td>'.$seAplicaA.'</td> <input type="hidden" name="aplica'.$contador.'" value="'.$idCargo.'">
                          <td>'.$descricaoFator.'</td><input type="hidden" name="descFator'.$contador.'" value="'.$descricaoFator.'">
                          <td>
                            <div class="input-group">
                              <input id="porcentagem" class="form-control" onkeypress="return isNumberKey(event)"   type="text" name="Porcentagem'.$contador.'" value="'.$vlPorcentagem.'" '.($row["vlPorcentagem"] === NULL ? "readonly" : '').'>
                              <span class="input-group-addon">%</span>
                            </div>
                          </td>
                          <td>
                            <div class="input-group">
                              <input id="campoNumero" onkeypress="return isNumberKey(event)" class="form-control" type="text" name="Valor'.$contador.'" value="'.$valor.'" '.($row["vlReais"] === NULL ? "readonly" : '').'>
                              <span class="input-group-addon">R$</span>
                            </div>
                          </td>
                          <td>
                              <select name="tpPagamento'.$contador.'" >
';
                              switch ($tpPagamento) {
                                case '0':
                                  echo (
                                    '
                                    <option selected="selected" Value="0">Bônus Fixo por porcentagem atingida</option>
                                    <option Value="1">Porcentagem paga em cima do valor total da loja</option>
                                    <option Value="2">Porcentagem paga em cima do valor total do Vendedor</option>
                                    '
                                  );
                                  break;

                                case '1':
                                  echo (
                                    '
                                    <option Value="0">Bônus Fixo por porcentagem atingida</option>
                                    <option selected="selected" Value="1">Porcentagem paga em cima do valor total da loja</option>
                                    <option Value="2">Porcentagem paga em cima do valor total do Vendedor</option>
                                    '
                                  );
                                  break;

                                case '2':
                                  echo (
                                    '
                                    <option Value="0">Bônus Fixo por porcentagem atingida</option>
                                    <option Value="1">Porcentagem paga em cima do valor total da loja</option>
                                    <option selected="selected" Value="2">Porcentagem paga em cima do valor total do Vendedor</option>
                                    '
                                  );
                                  break;

                                default:
                                  echo '
                                  <option selected="selected" Value="0">Bônus Fixo por porcentagem atingida</option>
                                  <option Value="1">Porcentagem paga em cima do valor total da loja</option>
                                  <option Value="2">Porcentagem paga em cima do valor total do Vendedor</option>
                                  ';
                                  break;
                              }
'.

                              </select>
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


<?php include '../pFixas/footer.php'; ?>
