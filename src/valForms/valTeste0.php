<?php
// Verifica se existe a variável txtnome
if (isset($_GET["txtCPF"])) {
    $cpf = $_GET["txtCPF"];
    // Conexao com o banco de dados
    $server = "localhost";
    $user = "root";
    $senha = "";
    $base = "portal";
    $conexao = new mysqli($server, $user, $senha, $base) or die("Erro na conexão!");
    // Verifica se a variável está vazia
    if (empty($cpf)) {
        $sql = "SELECT * FROM usuarios limit 1";
    } else {
        $sql = "SELECT * FROM usuarios WHERE CPF = '$cpf'";
    }
    sleep(1);

    $result = $conexao->query($sql);

	  $cont = mysqli_affected_rows($conexao);

    // Verifica se a consulta retornou linhas
    if ($cont > 0) {
        // Atribui o código HTML para montar uma tabela

        // Captura os dados da consulta e inseri na tabela HTML
        while ($linha = mysqli_fetch_array($result)) {
            /*
            $return.= "<td>" . utf8_encode($linha["NOME"]) . "</td>";
            $return.= "<td>" . utf8_encode($linha["FONE"]) . "</td>";
            $return.= "<td>" . utf8_encode($linha["CELULAR"]) . "</td>";
            $return.= "<td>" . utf8_encode($linha["EMAIL"]) . "</td>";
            $return.= "</tr>";
            */


            $return = '<form class="form-horizontal" name="cadastro" method="post" action="../valForms/valTeste00.php" >
              <div class="box-body">
                <!-- Estou trabalhando aqui -->
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">CPF</label>
                  <div class="col-sm-3">
                    <input type="number" class="form-control" name="cpf" id="inputEmail3" placeholder="CPF" value="'.utf8_encode($linha["CPF"]).'" readonly>
                  </div>
                  <!-- botão OK -->
                  <button type="submit" name="botao" value="botaoCpf" class="btn btn-info pull-left" >OK</button>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2  control-label">Nome</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="nome" id="inputEmail3" placeholder="Nome" >
                  </div>
                  <label for="inputEmail3" class="col-sm-2 control-label">Usuário</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="usuario" id="inputEmail3" placeholder="Usuário">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="email" id="inputEmail3" placeholder="Email">
                  </div>
                  <label for="inputEmail3" class="col-sm-2 control-label">Senha</label>
                  <div class="col-sm-3">
                    <input type="password" class="form-control"name="senha" id="inputEmail3" placeholder="Senha">
                  </div>
                </div>
                <!--=============================================================================================== -->
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="remember_me" value="valor"> Remember me
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <!-- botão OK Excluir -->
                <span> <button type="submit" name="botao" value="botaoExcluir" class="btn btn-default pull-right"  >Excluir</button></Span>
                  <!-- botão Salvar -->
                  <span><button type="submit" name="botao" value="botaoSalvar" class="btn btn-info pull-right" >Salvar</button></span>
                </div>
              </form>
            </div>
            ';


        }
        echo $return;
    } else {
        // Se a consulta não retornar nenhum valor, exibi mensagem para o usuário
        echo ' Não foram encontrados registros por favor digite outro valor <hr>
               Digite um CPF :
                <input type="text" name="txtCPF" id="txtCPF"/>
                <input type="button" name="btnPesquisar" value="Pesquisar" onclick="getDados();"/>';
    }
}
?>
