<?php
$user = "teste";

if(isset($_GET['token'])){
    $token = $_GET['token'];
}else{
  $token = '0';
  session_start();
  if (isset($_SESSION['primeiroLogin'])){
    if ($_SESSION['primeiroLogin'] == 1){
        $token="primeiroAcesso";
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Portal de comissões</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>Portal de comissões</b>
    </div>
    <div class="login-box-body">
      <p class="login-box-msg">Redefinir senha</p>

      <form action="validaNovaSenha.php" method="POST">
        <div class="form-group has-feedback">
          <input id="password" name="Novasenha" type="password" class="form-control" placeholder="Senha">
        </div>
        <div class="form-group has-feedback">
          <input id="confirm_password" name="ConfirmarNovaSenha"type="password" class=" form-control" placeholder="Confirmar nova senha">
          <span id='message'></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
          </div>
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat" name="botao" value="entrar">Confirmar</button>
          </div>
        </div>
        <div>
          <!-- envia o valor do token para a página validaNovaSenha.php-->
          <input name="confirmacao" type="hidden"  value=<?php echo $token ?>>
        </div>
      </form>

    </div>
  </div>
  <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
  <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="../../plugins/iCheck/icheck.min.js"></script>

  <script>

    $(function () {
        $('#password, #confirm_password').on('keyup', function () {
          if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Senhas são iguais').css('color', 'green');
          } else
            $('#message').html('Senhas não são iguais').css('color', 'red');
        });

        $('form').on('submit', function(e){
          var isvalid = false;
          // validation code here

            if ($('#password').val() == $('#confirm_password').val()) {
              isvalid = true;
            }

            if($('#password').val()==""){
              $('#message').html('Preencha a senha').css('color', 'red');
              isvalid = false;
            }

          if(!isvalid) {
            e.preventDefault();
          }
        });


    });
  </script>




</script>
</body>
</html>
