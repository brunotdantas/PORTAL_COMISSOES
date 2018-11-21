
<?php

// Include the database connections
include '../config/configdb.php';

// Get some parameter if you need
$periodo = $_GET['periodo'];

// Your query
$sql = "
  select distinct c.periodo,v.Nome,v.CPF,c.valor_a_pagar from comissoes_calculadas c
  inner join vendedores v on c.idVendedor = v.idVendedor
  where c.periodo = '$periodo'
";

// handle the result of the query to a variable
$resultado = sqlsrv_query( $conn, $sql);


$FileName = "Comissoes_".$periodo.".txt";
$file = fopen($FileName,"w");

// Save headings alon
$HeadingsArray=array();

// handle the results of the query to a variable
$row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ;

  // Get the first row  (usually this is the column name of your query)
	foreach($row as $name => $value){
		$HeadingsArray[]=$name;
	}

  // out put the results to a csv
	fputcsv($file,$HeadingsArray);

  // Save all records without headings
  while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){

    // get the lines and do the same as above
    $valuesArray=array();

		foreach($row as $name => $value){
		$valuesArray[]=$value;
		}

	fputcsv($file,$valuesArray);

	}
    //close the file
  	fclose($file);

    header('Content-Description: File Transfer');
    header('Content-type: text/plain');
    header('Content-Disposition: attachment; filename='.$FileName);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($FileName));

    if ($FileName != '')
    {
        echo file_get_contents($FileName);
    }

 ?>
