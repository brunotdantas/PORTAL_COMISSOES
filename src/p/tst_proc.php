<?php

include '../config/configdb.php';

/* Define the Transact-SQL query. Use question marks (?) in place of
 the parameters to be passed to the stored procedure */
$tsql_callSP = "{call SP_CALCULAR_COMISSOES( ?, ? , ? )}";

/* Define the parameter array. By default, the first parameter is an
INPUT parameter. The second parameter is specified as an OUTPUT
parameter. Initializing $salesYTD to 0.0 sets the returned PHPTYPE to
float. To ensure data type integrity, output parameters should be
initialized before calling the stored procedure, or the desired
PHPTYPE should be specified in the $params array.*/
$lastName = "201809";
$salesYTD = 0;//0.0;
$params = array(
                 array($lastName, SQLSRV_PARAM_IN),
                 array($lastName, SQLSRV_PARAM_IN),
                 array(&$salesYTD, SQLSRV_PARAM_OUT)
               );

/* Execute the query. */
$stmt3 = sqlsrv_query( $conn, $tsql_callSP, $params);
if( $stmt3 === false )
{
     echo "Error in executing statement 3.\n";
     die( print_r( sqlsrv_errors(), true));
}

/* Display the value of the output parameter $salesYTD. */
echo "YTD sales for ".$lastName." are ". $salesYTD. ".";


#------------------------------
# Without PDO
#------------------------------
//$cinfo = array(
//    "Database" => $database,
//    "UID" => $uid,
//    "PWD" => $pwd
//);
//
//$conn = sqlsrv_connect($server, $cinfo);
//if( $conn === false )
//{
//    echo "Error (sqlsrv_connect): ".print_r(sqlsrv_errors(), true);
//    exit;
//}
/*
$sql = "exec ?=mleko_test(?)";
$param = 3;
$spresult = 0;
$params = array(
    array(&$spresult, SQLSRV_PARAM_OUT),
    array($param, SQLSRV_PARAM_IN),
);
$stmt = sqlsrv_query($conn, $sql, $params);
if( $stmt === false ) {
    echo "Error (sqlsrv_query): ".print_r(sqlsrv_errors(), true);
    exit;
}

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo 'Stored procedure return value (without PDO): '.$spresult."</br>";
*/
?>
