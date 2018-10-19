<?php
include '../config/configdb.php';
include '../functions/strings.php';

//print_r($_POST);
/*
foreach ($_POST as $key => $value) {
     echo $key.'=>'.$value.'<br>';
}
*/

if(isset($_POST['vlMetaAnual'])){
/**
 * TODO: Fazer aqui uma lógica exclusiva para metas anuais. 
 * TODO: Uma Ideia talvez seja criar uma tabela temporária das lojas existentes, fazer um looping por ela e 
 * TODO: dar um replace into nos meses, fazer o looping de 12 em cada uma, ou talvez pensar numa lógica melhor
 * 
 */

  $meta = $_POST['vlMetaAnual'];
  $ano = right(TRIM($_POST['periodo']),4);

  // Cria uma tabela com as lojas existentes
  $sql  = "CREATE TEMPORARY TABLE IF NOT EXISTS ListaLojas AS (SELECT idLojas FROM lojas);";
  sqlsrv_query( $conn, $sql) ;

  $sql  = "select * from ListaLojas";
  $resultado = sqlsrv_query( $conn, $sql);

  if(sqlsrv_has_rows($resultado)){

    $retorno = '';
    while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){
      $idloja = $row["idLojas"];

      for ($i=1; $i <= 12 ; $i++) {  // Looping de lojas
        $sql  = "REPLACE INTO metas(idLojas, periodo, valorMeta) ";
        $sql .= "VALUES ($idloja,'".sprintf("%02d", $i).$ano."',$meta)";
    
        $flag = 1;//sucesso
        if(sqlsrv_query( $conn, $sql)){
         /// echo "<HR>"."Registros inseridos/atualizados com sucesso";
        }else{
          echo "Um erro ocorreu---->>>>  Error: ". $sql . "<br>".print_r( sqlsrv_errors(), true );
          $flag = 2; // erro
        }
      }
    }

  }
}else {

  $periodo = $_POST['periodo'];
  $numMetas = $_POST['numMetas'];

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
}

header("location: ../p/manut_metas.php?flag=$flag");
?>
