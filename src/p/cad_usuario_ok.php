<?php
include '../pFixas/cabec.php';
include 'Validar_cpf/valida_cpf.php';

// Tira os caracteres da mascara da página anterior
$cpf_usuario =str_replace('-','',str_replace('.','',$_POST['cpf']));

if(!validaCPF($_POST['cpf'])){
  echo '<script type="text/javascript">
            window.location = "cad_usuario.php?flag=3"
          </script>';
}

//$sql = "SELECT * FROM usuarios WHERE CPF = '".$cpf_usuario."'";
$sql = "
  select CPF,Nome,Email,usuario,u.idTipo,t.descricaoTipo,u.ativo
  from usuarios u
  inner join tipo_usuarios t on u.idTipo = t.idTipo
  WHERE CPF = '".$cpf_usuario."'
";

$resultado = sqlsrv_query( $conn, $sql);
$msg = '';
$existe = 0;

if(sqlsrv_has_rows($resultado)){
  while($dados = sqlsrv_fetch_array($resultado,SQLSRV_FETCH_ASSOC)){
    $campo_cpf = $dados["CPF"];
    $campo_nome = $dados["Nome"];
    $campo_email = $dados["Email"];
    $campo_usuario = $dados["usuario"];
    $campo_tipo = $dados["idTipo"];
    $nome_tipo = $dados["descricaoTipo"];
    $habilitado = $dados["ativo"];
    $existe = 1;

    if($habilitado == 1){
      $campo_desativar_usuario="unchecked";
      $labelBotaoDesativar='Desativar';
      $modalDesativar ='#modal-danger';      
    }else{      
      $campo_desativar_usuario="checked";
      $labelBotaoDesativar='Ativar';
      $modalDesativar ='#modal-info2';  
    }

  }

  $btn_salvar="disabled";
  $btn_alterar="enable";
  $btn_desativar="enable";
}else{
  $msg = '<button type="button" class="btn bg-maroon btn-flat margin">Este CPF ainda não existe no banco de dados, por favor crie o cadastro abaixo:</button>';

  $campo_cpf=$cpf_usuario;
  $campo_nome="";
  $campo_email="";
  $campo_usuario="";
  //$campo_senha="";
  $nome_tipo="";
  $campo_tipo="2";
  $campo_desativar_usuario="unchecked";
  $labelBotaoDesativar= 'Desativar';
  $modalDesativar ='#modal-info2';
  
  $btn_salvar="enable";
  $btn_alterar="disabled";
  $btn_desativar="disabled";
}

?>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Cadastro de usuário</h1>
  </section>
  <section class="content">
    <!--==========================Começo da div========================================== -->
    <div class="box box-info">
      <div class="box-header with-border"></div>
      <!-- ==========================Começo do formulário========================================== -->
      <form class="form-horizontal" name="cadastro" method="POST" action="../valForms/valCadastroUsuario.php" >
        <div class="box-body">
          <!-- Estou trabalhando aqui -->
          <?php echo $msg ?>

          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">CPF</label>
            <div class="col-sm-2">
              <!-- =================================== Campo CPF ========================================= -->
              <input type="text" readonly  class="form-control" name="cpf" id="inputEmail3"  value="<?php echo $campo_cpf ?>">
            </div>
          </div>
          <!-- =================================== Campo NOME e USUÁRIO ========================================= -->
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2  control-label">Nome</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="nome"  placeholder="Nome" value="<?php echo $campo_nome ?>" >
            </div>
            <label for="inputEmail3" class="col-sm-2 control-label">Login</label>
            <div class="col-sm-3">
              <input type="text" <?php echo($existe == 1 ? 'readonly' : '') ?> class="form-control" name="usuario" id="inputEmail3" placeholder="Usuário" value=<?php echo $campo_usuario ?>>
            </div>
          </div>
          <!-- =================================== Campo EMAIL========================================= -->
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-5">
              <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email" value=<?php echo $campo_email ?>>
            </div>
          </div>

          <div class="form-group">
<!-- ============================= Inicio combobox======================================= -->
<!-- =================================== Campo TIPO ========================================= -->
            <label for="inputEmail3" class="col-sm-2 control-label">Tipo de Usuário</label>
            <div class="col-sm-2">

              <select name ="tipo" class="form-control" id="inputEmail3">

               <!-- Ordena o tipo caso o usuário já exista -->
               <?php

             //--------------------Preencher combo--------------------------
              if(!Empty($campo_tipo)){
              $sql = " SELECT * from tipo_usuarios where idTipo = $campo_tipo

                        UNION ALL

                        SELECT * from tipo_usuarios where idTipo <> $campo_tipo
              ";
              }else{
              $sql = " SELECT * from tipo_usuarios ";
              }

              $resultado = sqlsrv_query( $conn, $sql);
              if(sqlsrv_has_rows($resultado)){
                while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){
                  echo '<option value="'.$row["idTipo"].'">  '.$row["descricaoTipo"].'</option>';
                }
              }
                //-------------------------------------------------------------
                ?>
              </select>
            </div>
<!-- ============================= Fim combobox======================================= -->
<!-- =================================== Campo DESATIVAR USUÁRIO ========================================= -->
            <div class="form-group col-lg-3" style="float:right" >
              <input type="checkbox" disabled name="usu_inativo" value="1" <?php echo $campo_desativar_usuario ?>> Usuário inativo?
            </div>
          </div>
<!-- =================================== botão DESATIVAR, SALVAR e ALTERAR========================================= -->
          <div class="box-footer">
            <div  style= "float: right">
              <div class="box-body">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-info" <?php echo $btn_salvar ?> > Criar </button>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-warning" <?php echo $btn_alterar ?> > Alterar </button>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="<?php echo $modalDesativar ?>" <?php echo $btn_desativar ?> > <?php echo $labelBotaoDesativar ?> </button>
                <button type="submit" name="botao" value="botaoCancelar" class="btn btn-info"> Cancelar </button>
              </div>
<!--***********************MODAL************************************ -->
              <div class="modal modal-info fade" id="modal-info" >
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header"><h4 class="modal-title">AVISO!</h4></div>
                    <div class="modal-body"> <p>Deseja CRIAR o perfil de acesso?</p></div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">NÃO</button>
                      <button type="submit" name="botao" value="botaoSalvar" class="btn btn-outline">SIM</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal modal-warning fade" id="modal-warning">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header"><h4 class="modal-title">AVISO!</h4></div>
                    <div class="modal-body"><p>Deseja realmente ALTERAR o perfil acesso?</p></div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">NÃO</button>
                      <button type="submit" name="botao" value="botaoAlterar" class="btn btn-outline">SIM</button>
                    </div>
                  </div>
                </div>
              </div>
<!-- modal para Desativar cadastro -->
              <div class="modal modal-danger fade" id="modal-danger">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header"><h4 class="modal-title">AVISO!</h4></div>
                    <div class="modal-body">
                      <p>Deseja realmente DESATIVAR o perfil acesso?</p>
                      <p>Após esta alteração o usuário não poderá mais fazer o login no sistema!</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">NÃO</button>
                      <button type="submit" name="botao" value="botaoDesativar"  class="btn btn-outline">SIM</button>
                    </div>
                  </div>
                </div>
              </div>
<!-- modal para Ativar cadastro -->
              <div class="modal modal-info fade" id="modal-info2" >
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header"><h4 class="modal-title">AVISO!</h4></div>
                    <div class="modal-body"> <p>Deseja ATIVAR o perfil de acesso?</p></div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">NÃO</button>
                      <button type="submit" name="botao" value="botaoAtivar" class="btn btn-outline">SIM</button>
                    </div>
                  </div>
                </div>
              </div>
<!--***********************FINAL MODAL************************************ -->
            </div>
          </div>
          </div>
          </form>
        </div>
        <!--==========================Fim========================================== -->
      </section>
    </div>

    <?php include '../pFixas/footer.php'; ?> <!--rodapé -->
