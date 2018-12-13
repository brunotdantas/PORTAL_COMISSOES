<?php

  include '../config/configdb.php';

  $contador = 0;
  $retorno = "";

  $periodo = $_GET['periodo'];

  /* Define the Transact-SQL query. Use question marks (?) in place of
   the parameters to be passed to the stored procedure */
//  $tsql_callSP = "{call SP_CALCULAR_COMISSOES(  @periodoDE='?',@periodoATE='?',@status =? )}";
  $tsql_callSP = "{call SP_CALCULAR_COMISSOES( ?,? )}";


  /* Define the parameter array. By default, the first parameter is an
  INPUT parameter. The second parameter is specified as an OUTPUT
  parameter. Initializing $salesYTD to 0.0 sets the returned PHPTYPE to
  float. To ensure data type integrity, output parameters should be
  initialized before calling the stored procedure, or the desired
  PHPTYPE should be specified in the $params array.*/
  $status = 0;//0.0;
  $params = array(
                   array($periodo, SQLSRV_PARAM_IN),
                   array(&$status, SQLSRV_PARAM_OUT)
                 );

  /* Execute the query. */
  $stmt = sqlsrv_prepare( $conn, $tsql_callSP, $params);
  if (!$stmt) {
    var_dump( sqlsrv_errors());
  }

  if (sqlsrv_execute($stmt) === false){
    var_dump(sqlsrv_errors());
  }


  $sql = " select resultados from resultado_comissoes ";
  $resultado = sqlsrv_query( $conn, $sql);
  if (sqlsrv_has_rows( $resultado )){
    // Se encontrou usuario e senha


    while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){
      switch ($row["resultados"]) {
        case 0:
          echo '
            <hr>
            <div class="callout callout-success">
              <h4>Comissões calculadas com sucesso, verifique o resultado na rotina "Comissões Já Calculadas"!</h4>
            </div>
          ';
          break;
        case 3:
          echo '
            <hr>
            <div class="callout callout-warning">
              <h4> Não existem METAS CADASTRADAS para o período anterior</h4>
            </div>
          ';
          break;
        case 4:
          echo '
            <hr>
            <div class="callout callout-danger">
              <h4> Período anterior já calculado</h4>
            </div>
          ';
          break;
        default:
          echo $status;
          break;
      }
    }
  }

echo '<br>Verifique as comissões já calculadas clicando no <a href="../p/comissoes_calculadas.php">Aqui</a> ';

//  if ($status == 5) {
//    echo '<hr>'."Linhas inseridas com sucesso";
//  }else{
//    echo '<hr>'."Falha no calculo de comissão ou <b>período já calculado</b>";
//  }

?>
