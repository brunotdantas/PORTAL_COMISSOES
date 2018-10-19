<?php

  include '../config/configdb.php';

  $retorno = "";

  // Le quantas lojas existem
  $contador = 0;
  $loja = $_GET['loja'];

  $loja .= "oi";

  $retorno = $loja;
 
  echo $retorno;
/*

  switch ($tpMeta) {
    case 0:
    
      // TODO esse resultado traz branco
      $resultado = sqlsrv_query( $conn, $sql);

      if(sqlsrv_has_rows($resultado)){

        $retorno .= '<form class="" action="../valForms/validaMeta.php" method="post">';

        $retorno .= '<div><button type="submit" class="btn btn-info btn-block">Salvar</button></div>';   

        $retorno .= '<div class="box-body pad table-responsive">
          <!-- Calendário: http://jsfiddle.net/DBpJe/15060/ -->
          <table class="table table-bordered text-center">
            <tbody>
            <tr>
              <th>Código</th>
              <th>Loja</th>
              <th>Meta</th>
            </tr>';

        while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){

            $contador++;
            $idlojas = $row["idLojas"];
            $cnpj = '';//$row["CNPJ"];
            $nomeLoja = $row["NomeLoja"];
            $valorMeta = $row["valorMeta"];
            $retorno .='
              <tr>
                <td>
                  <input class="form-control"  type="text" name="codigo'.$contador.'" value="'.$idlojas.'" readonly>
                </td>
                <td>
                  <input class="form-control"  type="text" name="loja'.$contador.'" value="'.$nomeLoja.'" readonly>
                </td>
                <td>
                <div class="input-group input-group-md">
                <span class="input-group-addon">R$</span>
                <input class="form-control" onkeypress="return isNumberKey(event)" type="text" name="Meta'.$contador.'" value="'.$valorMeta.'" />

                </td>
              </tr>
            ';
        }
      
      }else{
        die( print_r( sqlsrv_errors(), true));
      }

      $retorno .= ' <input type="hidden" name="numMetas" value="'.$contador.'"></tbody></table>';
      $retorno .= ' <input type="hidden" name="periodo" value="'.$periodo.'">';   
      $retorno .= '<div><button type="submit" class="btn btn-info btn-block">Salvar</button></div>';  
      $retorno .= ' </form></div><!-- /.box -->'; 

      break;
    case 1:
      $retorno .= '

      <form class="" action="../valForms/validaMeta.php" method="post">
      <div class="box-body pad table-responsive">
        <h4>Preencha o valor da meta que será considerado em todas as lojas no ano escolhido:</h4>
        <div class="input-group input-group-md">
          <span class="input-group-addon">R$</span>
          <input name="vlMetaAnual" class="form-control" type="number" min="0.00"  step="0.01" />
          <input type="hidden" name="periodo" value="'.$periodo.'">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-success btn-flat">Salvar</button>
          </span>

        </div>
      </div>
      ';
    break;
  }

  echo $retorno;
*/
?>