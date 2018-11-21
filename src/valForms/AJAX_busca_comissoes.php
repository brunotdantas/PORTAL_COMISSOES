<?php
include '../config/configdb.php';


  $periodo = $_GET['periodo'];

    $sql = "
      select distinct c.periodo,v.Nome,v.CPF,c.valor_a_pagar from comissoes_calculadas c
      inner join vendedores v on c.idVendedor = v.idVendedor
      where c.periodo = '$periodo'
    ";

    $resultado = sqlsrv_query( $conn, $sql);

    if(sqlsrv_has_rows($resultado)){

      echo '<table class="table table-bordered text-center">
        <tbody>
        <tr>
          <th colspan="6"><h2>Comissões Calculadas</h2></th>
        </tr>
        <tr>
          <th>Periodo</th>
          <th>Nome</th>
          <th>CPF</th>
          <th>Valor a pagar</th>
        </tr>
      ';

      while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){
       $periodo         = $row["periodo"];
        $nome           = $row["Nome"];
        $valorApagar    = $row["valor_a_pagar"];
        $cpf            = $row["CPF"];

        echo "
          <tr>
            <td> $periodo </td>
            <td> $nome </td>
            <td> $cpf </td>
            <td> $valorApagar </td>
          </tr>
        ";

      }
        echo '</table>';
        echo '<a target="_blank" class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Imprimir</a>';
        echo '<a href="invoice-print.html"  class="btn btn-default" onclick="window.print();"><i class="fa fa-file-excel-o"></i> Excel/CSV </a>';
        echo '<a href="invoice-print.html"  class="btn btn-default" onclick="window.print();"><i class="fa fa-file-text"></i> TXT </a>';

    }else{
        echo '

        <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-warning"></i> Aviso!</h4>
                        Não existem dados para o período selecionado
                      </div>



        ';
    }


  // PAREI AQUI !!!!!!!!!!!!!!!!!!!!
    // output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');

    // create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // output the column headings
    fputcsv($output, array('Column 1', 'Column 2', 'Column 3'));

    // fetch the data
    mysql_connect('localhost', 'username', 'password');
    mysql_select_db('database');
    $rows = mysql_query('SELECT field1,field2,field3 FROM table');

    // loop over the rows, outputting them
    while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);


?>
