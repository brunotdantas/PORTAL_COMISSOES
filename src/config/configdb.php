<?php
   define('DB_SERVER', 'DESKTOP-A2KGUDC');//'HEL001259\SQLEXPRESS');  
   define('DB_USERNAME', 'php');
   define('DB_PASSWORD', 'portal');
   define('DB_DATABASE', 'Portal');

   $connectionInfo = array( "Database"=>DB_DATABASE, "UID"=>DB_USERNAME, "PWD"=>DB_PASSWORD);
    $conn = sqlsrv_connect( DB_SERVER, $connectionInfo);
/*
    $sql = "SELECT * FROM Usuarios";
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
   }

   while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
	    echo $row['Nome']."</br>";
    }

*/

?>
