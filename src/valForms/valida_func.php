<?php

include '../config/configdb.php';
session_start();

/*
foreach ($_POST as $key => $value) {
     echo $key.'=>'.$value.'<br>';
}
*/

$nFuncionarios = $_POST['numFuncionarios'];


for ($i=1; $i <= $nFuncionarios ; $i++) { 
    $cpf = $_POST["cpf$i"];
    $nome = $_POST["nome$i"];  
    $idVendedor = $_POST["idVendedor$i"];  
    $cargo = (isset($_POST["cargo$i"]) ? 1 : 2);   // 1 gerente, 2 vendedor
    echo '<br>' ;

    $sql  =  " UPDATE `vendedores` set idCargo = $cargo where idVendedor = $idVendedor ";

    $flag = 1;//sucesso
    if($db->query($sql)=== TRUE){
      echo "<HR>"."Registros atualizados com sucesso";
    }else{
      echo "Um erro ocorreu---->>>>  Error: ". $sql . "<br>".$db->error;
      $flag = 2; // erro
    }

}



header("location: ../p/manut_funcionarios.php?flag=$flag");

?>
