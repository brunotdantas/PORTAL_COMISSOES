<?php
  include '../config/configdb.php';
  session_start();

  $user = $_POST['usuario'];
  $pass = $_POST['senha'];
 

  if ($user == "admin" && $pass=="admin"){
    $_SESSION["logado"]=1;
    $_SESSION["nome"]  = $user;
    $_SESSION["cargo"] = 1;

    echo '<script type="text/javascript">
    window.location = "../p/landpage.php"
    </script>';
  }

  $sql = "select * from usuarios where usuario='".$user."' and Senha = '".$pass."' and ativo = 1";
  $resultado = sqlsrv_query( $conn, $sql);
  if (sqlsrv_has_rows( $resultado )){  
    // Se encontrou usuario e senha 


    while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){
        $_SESSION["logado"]=1;
        $_SESSION["nome"]  = $row["Nome"];
        $_SESSION["cargo"] = $row["idTipo"];
        $_SESSION['primeiroLogin'] = $row["primeiroAcesso"];
        $_SESSION['cpf'] = $row["CPF"];
        $_SESSION['ativo'] = $row["ativo"];        
    }
      
      // Primeiro acesso 
      if($_SESSION['primeiroLogin']==1){
        echo '<script type="text/javascript">
        window.location = "novaSenha.php"
        </script>';  
        exit();  
      }
  
      sqlsrv_close($conn);
      echo '<script type="text/javascript">
      window.location = "../p/landpage.php"
      </script>';

  }else{
    // Senha incorreta
    Echo 'Combinação de usuário e senha incorreta ou usuário INATIVO, você será redirecionado em 3 segundos!';
    header('Refresh: 3; URL=../../index.php');
    echo '<br> Ou Clicando <a href="../../index.php">A Q U I</a>';
  }
?>
