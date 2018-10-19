<?php
include '../config/configdb.php';
//print_r($_POST);

foreach ($_POST as $key => $value) {
     echo $key.'=>'.$value.'<br>';
}
$numFatores = $_POST['numFatores'];
//exit();
for ($i=1; $i <=$numFatores ; $i++) {
    // Se foi preenchido valor para essa loja
      // REPLACE INTO:  se já existir atualiza, caso
      //                contrário insere
    $idFator = $_POST["idFat$i"];
    $ativo = (isset($_POST["ativo$i"]) ? 1 : 0);
    $porcentagem = (empty($_POST["Porcentagem$i"]) ? 'NULL' : $_POST["Porcentagem$i"]);
    $valor = (empty($_POST["Valor$i"]) ? 'NULL' : $_POST["Valor$i"]);
    $aplica = $_POST["aplica$i"];
    $descFator = $_POST["descFator$i"];
    
    $sql = " IF EXISTS (SELECT idFator FROM fatores where idFator = $idFator) ";
    $sql .= " begin ";
    $sql .= "   update fatores set " ;
    $sql .= "     ativo			= $ativo	,  ";
    $sql .= "     vlPorcentagem	= $porcentagem	, "; 
    $sql .= "     vlReais			= $valor	, ";
    $sql .= "     descricaoFator	= '$descFator'	, " ;
    $sql .= "     idCargo			= '$aplica' ";
    $sql .= "    where ";
    $sql .= "     idFator = $idFator ";
    $sql .= " end ";
    $sql .= " else insert into  fatores(ativo, vlPorcentagem, vlReais,descricaoFator,idCargo)  ";
    $sql .= " VALUES ($ativo,$porcentagem,$valor,'$descFator',$aplica)  "; 

    $flag = 1;//sucesso
    if(sqlsrv_query( $conn, $sql)){
    }else{
      echo "Um erro ocorreu---->>>>  Error: ". $sql . "<br>".print_r( sqlsrv_errors(), true );
      $flag = 2; // erro
    }
}

header("location: ../p/cad_fatcalc.php?flag=$flag");
?>
