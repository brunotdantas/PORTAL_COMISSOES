<?php

  include '../config/configdb.php';

  $contador = 0;
  $retorno = "";

  $periodo = $_GET['periodo'];

  /* Define the Transact-SQL query. Use question marks (?) in place of
   the parameters to be passed to the stored procedure */
  $tsql_callSP = "{call SP_CALCULAR_COMISSOES( ?, ?  )}";

  /* Define the parameter array. By default, the first parameter is an
  INPUT parameter. The second parameter is specified as an OUTPUT
  parameter. Initializing $salesYTD to 0.0 sets the returned PHPTYPE to
  float. To ensure data type integrity, output parameters should be
  initialized before calling the stored procedure, or the desired
  PHPTYPE should be specified in the $params array.*/
  $status = 0;//0.0;
  $params = array(
                   array($periodo, SQLSRV_PARAM_IN),
                   array($periodo, SQLSRV_PARAM_IN)//,
                   //array(&$status, SQLSRV_PARAM_OUT)
                 );

  /* Execute the query. */
  $stmt3 = sqlsrv_query( $conn, $tsql_callSP, $params);
  if( $stmt3 === false )
  {
       echo "Error in executing statement 3.\n";
       die( print_r( sqlsrv_errors(), true));
  }else{
    echo 'Calculo de comissões realizado com sucesso, por favor verifique o resultado clicando aqui:';
  }

  //if ($status == 0) {
  //  echo "Linhas inseridas com sucesso";
  //}else{
  //  echo "Falha no calculo de comissão ou período já calculado";
  //}

?>
