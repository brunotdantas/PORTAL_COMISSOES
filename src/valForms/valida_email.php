<?php
  include '../functions/mail.php';
  header("Content-Type: text/html; charset=UTF-8" ,true);

  include '../p/Validar_cpf/valida_senhas_iguais.php';


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

  $email = $_POST['email_cadastrado'];

  $sql = "select * from usuarios where Email='".$email."'";
  $resultado = sqlsrv_query( $conn, $sql);

  if(sqlsrv_query( $conn, $sql)){
  }else{
    echo "Um erro ocorreu---->>>>  Error: ". $sql . "<br>".print_r( sqlsrv_errors(), true );
    $flag = 2; // erro
  }

  if(sqlsrv_has_rows($resultado)){
    // ACHOU O E-MAIL
    while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){
      $codigoUsuario = $row["IDusuario"];
      $nome = $row["Nome"];
      $login = $row["usuario"];
    }
    $a = criarCriptografia($email. mt_rand());//SENHA TEMPORARIA (função para criar uma senha temporária)
    //adicionar no banco;
    $sql = "UPDATE usuarios  SET SenhaTemporaria = '$a' WHERE IDusuario = '".$codigoUsuario."'";
    //sucesso
    if(sqlsrv_query( $conn, $sql)){
    }else{
      echo "Um erro ocorreu---->>>>  Error: ". $sql . "<br>".print_r( sqlsrv_errors(), true );
    }

    sqlsrv_close($conn);
//==========================envia o e-mail com a senha temporaria ==========================================
    $to  = $email;//'scomissao2018@gmail.com';
    $subject = 'REDEFINIR SENHA';
    $message = '
    <html>
    <head>
    	<meta charset="UTF-8"/>
    	<title>Redefinir Senha</title>
    </head>
    <body>
    	<p><h3>Solicitação de Senha</h3></p>
    	<p>Caro(a) usuário(a) <b>'.$nome.'</b>, seu login é: <b>'.$login.'</b> , segue o link para redefinir a sua senha de acesso ao sistema integrado de cálculo de comissão.</p>
    	<a HREF="http://localhost:81/portal/src/valForms/novaSenha.php?token='.$a.'" TARGET="_blank"> Clique aqui para redefinir sua senha</a>
    	<p>Em caso de dúvidas, entre em contato com o administrador do sistema.</p>
    	<p></p>
    </body>
    </html>
    ';
    mail_utf8($to, 'novoCadastro@portalcomissoes.com' ,$subject, $message);

//==========================fim =========================================================

    echo 'Acesse o e-mail <b>'.$email.'</b> e clique no link para redefinir sua senha';
    echo '<br>Você será redirecionado para a tela de login em 8 segundos...';
    echo '<br> Ou Clicando <a href="../../index.php">A Q U I</a>';
    header('Refresh: 8; URL=../../index.php');

  }else{
    // Senha incorreta
    Echo 'E-mail '.$email.' não encontrado, Você será redirecionado para a tela de login em 8 segundos...';
    header('Refresh: 8; URL=../../index.php');
    echo '<br> Ou Clicando <a href="../../index.php">A Q U I</a>';
  }

?>
