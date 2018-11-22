<?php
include '../config/configdb.php';
include '../functions/mail.php';

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$tipo = $_POST['tipo'];
$botaoClicado = $_POST["botao"];

switch ($botaoClicado) {
  case 'botaoAlterar':
  $sql = "UPDATE usuarios  SET Nome = '$nome', Email = '$email', usuario = '$usuario', idTipo = '$tipo'  WHERE CPF = '".$cpf."'";

  $flag = 1;//sucesso
  if(sqlsrv_query( $conn, $sql)){
  }else{
    echo "Um erro ocorreu---->>>>  Error: ". $sql . "<br>".print_r( sqlsrv_errors(), true );
    $flag = 6; // erro
  }
  break;
  /*********************************************************/
  case 'botaoDesativar':
  $sql = "UPDATE usuarios  SET ativo = '0'  WHERE CPF = '".$cpf."'";
  $flag = 2;//sucesso
  if(sqlsrv_query( $conn, $sql)){

  }else{
    echo "Um erro ocorreu---->>>>  Error: ". $sql . "<br>".print_r( sqlsrv_errors(), true );
    $flag = 6; // erro
  }
  break;
  /*********************************************************/
  case 'botaoAtivar':
  $sql = "UPDATE usuarios  SET ativo = '1'  WHERE CPF = '".$cpf."'";
  $flag = 4;//sucesso
  if(sqlsrv_query( $conn, $sql)){

  }else{
    echo "Um erro ocorreu---->>>>  Error: ". $sql . "<br>".print_r( sqlsrv_errors(), true );
    $flag =6; // erro
  }
  break;
  /*********************************************************/
  case 'botaoSalvar':
  // senha temporária:  //TODO no futuro mandar a primeira senha por email
  $sTemp = substr($cpf,0,6);

  $sql = "INSERT INTO usuarios (cpf, nome, email, idTipo, usuario,  Senha,ativo,primeiroAcesso) VALUES('$cpf', '$nome', '$email', '$tipo', '$usuario', '$sTemp',1,1) " ;
  $flag = 5;//sucesso
  if(sqlsrv_query( $conn, $sql)){
  // Envia o e-mail para o usuário
  //'$usuario
    $to  = $email;
    $subject = 'NOVO ACESSO AO SISTEMA DE COMISSÕES';
    $message = '
    <html>
    <head>
      <meta charset="UTF-8"/>
      <title>Detalhes do primeiro login ao acesso ao sistema de comissões</title>
    </head>
    <body>
      <p><h3>Seu primeiro acesso</h3></p>
      <p>Caro(a) usuário(a) <b>'.$nome.'</b>, o Administrador do sistema criou o seu login no portal de vendas de comissões.
      <p>Seu login para acesso é: <b>'.$usuario.'</b></p>
      <p>Sua senha é composta pelos <b>seis primeiros dígitos do seu CPF</b></p>
      <p>Por gentileza faça o primeiro acesso clicando no link abaixo para trocar a sua senha e obter acesso ao portal.</p>
    	<a HREF="http://localhost:81/portal/index.php" TARGET="_blank"> Clique aqui para redefinir sua senha</a>
    </body>
    </html>
    ';
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset="UTF-8' . "\r\n";
    $headers .= 'From: Cadastrar nova senha <birthday@example.com>' . "\r\n";
    mail_utf8($to, 'novoCadastro@portalcomissoes.com' ,$subject, $message);

  }else{
    echo "Um erro ocorreu---->>>>  Error: ". $sql . "<br>".print_r( sqlsrv_errors(), true );
    $flag = 6; // erro
  }

  break;
  /*********************************************************/
  case 'botaoCancelar':
  header("location: ../p/landpage.php?");
  break;
}

header("location: ../p/cad_usuario.php?flag=$flag");
?>
