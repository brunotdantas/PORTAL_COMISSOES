<?php
include '../pFixas/cabec.php';

$mensagem = '';

$flag = isset($_GET['flag']) ? $_GET['flag'] : 'z';

switch ($flag) {
  case 1:
  echo ' <script type="text/javascript">' ;
  echo "   $(window).on('load',function(){
    $('#exampleModal').modal('show');
  });
  </script> ";

  $mensagem = '
  <div class="alert alert-success alert-dismissible">
  <h4><i class="icon fa fa-check"></i> Alert!</h4>
  CADASTRO ATUALIZADO COM SUCESSO!
  </div>
  ';
  break;
  /*********************************************************/
  case 2:
  echo ' <script type="text/javascript">' ;
  echo "   $(window).on('load',function(){
    $('#exampleModal').modal('show');
  });
  </script> ";

  $mensagem = '
  <div class="alert alert-success alert-dismissible">
  <h4><i class="icon fa fa-check"></i> Alert!</h4>
  CADASTRO DESATIVADO COM SUCESSO!
  </div>
  ';
  break;
  /*********************************************************/
  case 3:
  $mensagem = '
  <div class="alert alert-danger alert-dismissible">
  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
  CPF INVÁLIDO, POR FAVOR CORRIJA O CPF DIGITADO ANTERIORMENTE.
  </div>
  ';
  break;
  /*********************************************************/
  case 4:
  echo ' <script type="text/javascript">' ;
  echo "   $(window).on('load',function(){
    $('#exampleModal').modal('show');
  });
  </script> ";

  $mensagem = '
  <div class="alert alert-success alert-dismissible">
  <h4><i class="icon fa fa-check"></i> Alert!</h4>
  CADASTRO ATIVADO COM SUCESSO!
  </div>
  ';
  break;
  /*********************************************************/
  case 5:
  echo ' <script type="text/javascript">' ;
  echo "   $(window).on('load',function(){
    $('#exampleModal').modal('show');
  });
  </script> ";

  $mensagem = '
  <div class="alert alert-success alert-dismissible">
  <h4><i class="icon fa fa-check"></i> Alert!</h4>
  CADASTRO CRIADO COM SUCESSO!
  </div>
  ';
  break;
  /*********************************************************/
  case 6:
  $mensagem = '
  <div class="alert alert-danger alert-dismissible">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-ban"></i> Alert!</h4>
  Ocorreu um erro no cadastro de usuário, por favor contate o administrador do sistema
  informando essa mensagem!
  </div>
  ';
  break;
}
?>

<div class="content-wrapper">
  <section class="content-header">
    <h1>Manutenção de Usuários <small>Consultar CPF</small></h1>
  </section>
  <section class="content">
    <form class="form-horizontal" action="cad_usuario_ok.php" method="post">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title"></h3>
          <?= $mensagem ?>
          <div class="box-footer"></div>
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">CPF</label>
            <div class="col-sm-3">
              <!-- =================================== Campo CPF ========================================= -->
              <input name="cpf" type="text" class="form-control"  id="inputEmail3" placeholder="CPF" required>
            </div>
            <!-- =================================== botão Consultar ========================================= -->
            <button type="submit" name="botao" value="botaoCpf" class="btn btn-info pull-left" >Consultar</button>
          </div>
          <div class="box-footer"></div>
        </div>
      </div>
    </form>
  </section>
</div>



<?php include '../pFixas/footer.php'; ?>
<script>
  $('#inputEmail3').mask('000.000.000-00', {reverse: true});
  $('#vlMeta').mask('000.000.000.000.000,00', {reverse: true});
</script>
