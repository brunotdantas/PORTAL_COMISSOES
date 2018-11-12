<?php

  include '../pFixas/cabec.php';
  $mensagem = '';

  $flag = isset($_GET['flag']) ? $_GET['flag'] : 'z';

  if ($flag == 1){
      $mensagem = '
      <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Valores inseridos/atualizados com sucesso!
      </div>
      ';
  }else if ($flag==2) {
      $mensagem = '
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        Ocorreu um erro no processo de inserção de registros, por favor contate o administrador do sistema
        informando essa mensagem
      </div>
     ';
  }


?>

//--- Modelo principal
<!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?= $mensagem ?>
      <h1>
        Rotina para importação de metas
        <small></small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <form class="" action="importa_metas.php" method="post" enctype="multipart/form-data">
      <div class="box box-primary">
                <div class="box-header">
                  <!--<i class="fa fa-edit"></i>-->
                  <h3 class="box-title">Essa rotina utiliza a importação de um arquivo no
                    formato csv para cadastramento de metas automaticamente seguindo os passos abaixo</h3>
                <div class="box-body pad table-responsive">

<!--- Conteudo ---->
                <p><h3>1</h3><h4> Caso ainda não tenha baixado o modelo para preenchimento da meta clique no botão abaixo  </h4></p>
                <p><input type="button" class="btn btn-primary" onclick="location.href='../download/template.csv';"  value="Baixar arquivo modelo" /> </p>

                <p><h3>2</h3><h4> Preencha o modelo baixado como mostra a imagem abaixo </h4></p>
                <img src="../imgs/exemplo_metas1.png" alt="">

                <p><h3>3</h3><h4> Clique no botão abaixo e selecione o arquivo que você acabou de criar e clique em 'OK' </h4></p>
                <div class="form-group">
                  <!--<label for="exampleInputFile">File input</label> -->
                  <input type="file" name="fileToUpload" id="fileToUpload" require>
                  <!--<p class="help-block">Example block-level help text here.</p>-->
                </div>
<!-- /.Conteudo -->

                </div>
                <!-- /.box -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-info pull-right">Importar</button>
                </div>
              </div> <!-- /.box-footer-->
      </form>
    </section>  <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

<script>
$(document).ready(function() {
});
</script>

<?php include '../pFixas/footer.php'; ?>
