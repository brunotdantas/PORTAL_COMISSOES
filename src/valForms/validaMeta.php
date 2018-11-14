<?php
  include '../config/configdb.php';
  include '../functions/strings.php';
  $flag = 2; // erro

    $idMetas = $_POST['idMeta'];
    $idLojas = $_POST['idloja'];
    $meses = $_POST['mes'];
    $anos = $_POST['ano'];
    $valorMeta = $_POST['valorMeta'];

    $i = 0;
    foreach ($idMetas as $v1) {
      // Tenta fazer o update dos registros
      try {
          $query = "  UPDATE  Metas
                      set     valorMeta = '$valorMeta[$i]'
                      WHERE   idMetas = '$idMetas[$i]'
                  ";
          echo $query.'<br>';
          $result = sqlsrv_query($conn,$query);
          if( $result === false ) {
              //TODO Controlar o erro para retornar ao usuário die( var_dump( sqlsrv_errors(), true));
              // --> Erro na query
              $err = 0;
              echo "Um erro ocorreu---->>>>  Error: ". $query . "<br>".print_r( sqlsrv_errors(), true );
            }else {
              $flag = 1;//sucesso!
            }
      } catch (Exception $e) {}

      $i++;
    }
    ////executing a database query will save "" in field tblAddressBook.addr2
    //$sql = "update Metas set name=(?), addr1=(?), addr2=(?),..."
    //$params = array($name, $address_line_1, $address_line_2, ...)
    //$sql_srv_query($db_conn, $sql, $params);

    //echo "User Has submitted the form and entered this name : <b> $name </b>";
    //echo "<br>You can use the following form again to enter a new name.";

/*
  for ($i=1; $i <=$numMetas ; $i++) {
    if (!empty($_POST["Meta$i"])){
        $loja = $_POST["codigo$i"];
        $vlMeta = $_POST["Meta$i"];

      $sql  = "REPLACE INTO metas(idLojas, periodo, valorMeta) ";
      $sql .= "VALUES ($loja,'$periodo',$vlMeta)";

      $flag = 1;//sucesso
      if(sqlsrv_query( $conn, $sql)){
      //  echo "<HR>"."Registros inseridos com sucesso";
      }else{
        echo "Um erro ocorreu---->>>>  Error: ". $sql . "<br>".print_r( sqlsrv_errors(), true );
        $flag = 2; // erro
      }
    }

  }
*/
header("location: ../p/manut_metas.php?flag=$flag");
?>
