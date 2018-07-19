<?php
  session_start();
  header("Content-Type: text/html; charset=UTF-8" ,true);
  include '../config/configdb.php';
  include '../p/Validar_cpf/valida_senhas_iguais.php';

  $Confirma_Email = $_POST['confirmacao'];
  $senha1 = $_POST['Novasenha'];
  $senha2 = $_POST['ConfirmarNovaSenha'];


  //Se o usuário fizer o primeiro acesso 
  if ($Confirma_Email == 'primeiroAcesso'){
    if($_SESSION['ativo']==1){  //verificar se o cadastro esta ativo
      if(!validaSenha($_POST['Novasenha'], $_POST['ConfirmarNovaSenha'])){
        echo 'Senha inválida! Você será redirecionado em 3 segundos...';
        header('Refresh: 3; URL=../../index.php');
      }else{
        $sql = "UPDATE usuarios  SET primeiroAcesso = 0, Senha = '$senha1', SenhaTemporaria = '' WHERE CPF = '". $_SESSION['cpf']."'";//salvar a nova senha
        if($db->query($sql)=== TRUE){
          Echo 'Senha alterada com sucesso! Você será redirecionado em 3 segundos ...';
          header('Refresh: 3; URL=../../index.php');
        }else{
          echo "Um erro ocorreu---->>>>  Error: ". $sql . "<br>".$db->error;
        }
      }
      $db->close();
    }else{
      Echo 'Cadastro desativado!';
    }
  }else{
    $sql = "select * from usuarios where SenhaTemporaria='".$Confirma_Email."'";  //verificar se o token e a senhaTemporaria são iguais
    $resultado = $db->query($sql);
      if($resultado->num_rows > 0 ){
        while ($row = $resultado->fetch_assoc()){
          $codigoUsuario = $row['IDusuario'];//verificar o id do usuario
          $ativo = $row['ativo'];
        }
        if($ativo==1){  //verificar se o cadastro esta ativo
          if(!validaSenha($_POST['Novasenha'], $_POST['ConfirmarNovaSenha'])){
            echo 'Senha inválida! Você será redirecionado em 3 segundos...';
            header('Refresh: 3; URL=../../index.php');
        }else{
            $sql = "UPDATE usuarios  SET Senha = '$senha1', SenhaTemporaria = '' WHERE IDusuario = '".$codigoUsuario."'";//salvar a nova senha
            if($db->query($sql)=== TRUE){
              Echo 'Senha alterada com sucesso! Você será redirecionado em 3 segundos ...';
              header('Refresh: 3; URL=../../index.php');
            }else{
              echo "Um erro ocorreu---->>>>  Error: ". $sql . "<br>".$db->error;
            }
          }
          $db->close();
        }else{
          Echo 'Cadastro desativado!';
        }

    }else{
      // Senha incorreta
      //echo "<script language=javascript>alert( 'Alerta Vermelho!' );</script>";
      Echo 'Link expirado/ token inválido, solicite novamente a alteração de sua senha ';
      header('Refresh: 3; URL=../../index.php');
      echo '<br><a href="../../index.php">A Q U I</a>';
    }
  }
?>
