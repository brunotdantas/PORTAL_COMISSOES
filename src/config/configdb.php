<?php
$config = 1 ;

if (config == 0){
    define('DB_SERVER', '.\SQLEXPRESS');//'HEL001259\SQLEXPRESS');  
    define('DB_USERNAME', 'php');
    define('DB_PASSWORD', 'portal');
    define('DB_DATABASE', 'Portal');
 
     $connectionInfo = array( "Database"=>DB_DATABASE, "UID"=>DB_USERNAME, "PWD"=>DB_PASSWORD,"CharacterSet"=>"UTF-8");
     $conn = sqlsrv_connect( DB_SERVER, $connectionInfo);
 
     if( !$conn ) {
         // Se não conseguir logar com .\SQLEXPRESS
         $connectionInfo = array( "Database"=>DB_DATABASE, "UID"=>DB_USERNAME, "PWD"=>DB_PASSWORD,"CharacterSet"=>"UTF-8");
         $conn = sqlsrv_connect( 'localhost', $connectionInfo);    
     }   
     
     if (!$conn){
         echo "Connection could not be established.<br />";
         die( print_r( sqlsrv_errors(), true));
     }

} 

else {
    $serverName = "your_server.database.windows.net";
    $connectionOptions = array(
        "Database" => "your_database",
        "Uid" => "your_username",
        "PWD" => "your_password"
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    $tsql= "SELECT TOP 20 pc.Name as CategoryName, p.name as ProductName
            FROM [SalesLT].[ProductCategory] pc
            JOIN [SalesLT].[Product] p
        ON pc.productcategoryid = p.productcategoryid";
    $getResults= sqlsrv_query($conn, $tsql);
    echo ("Reading data from table" . PHP_EOL);
    if ($getResults == FALSE)
        echo (sqlsrv_errors());
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    echo ($row['CategoryName'] . " " . $row['ProductName'] . PHP_EOL);
    }
    sqlsrv_free_stmt($getResults);



}    

    /*
    $sql = "SELECT 'olá Mundo' as Nome";
    $stmt = sqlsrv_query( $conn, $sql);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
   }

   while( $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) ){
	    echo $row['Nome']."</br>";
    }

*/
?>
