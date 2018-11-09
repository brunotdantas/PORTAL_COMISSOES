<?php
  include '../pFixas/cabec.php';
  $mensagem = '';

  $flag = isset($_GET['flag']) ? $_GET['flag'] : 'z';

  if ($flag == 1){

    echo '
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    ';
      $mensagem = '
      <div class="alert alert-success alert-dismissible" id="msgFeedback">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alert!</h4>
        Valores inseridos/atualizados com sucesso!
      </div>
      ';
  }else if ($flag==2) {
      $mensagem = '
      <div class="alert alert-danger alert-dismissible" id="msgFeedback">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        Ocorreu um erro no processo de inserção de registros, por favor contate o administrador do sistema
        informando essa mensagem
      </div>
     ';
  }



?>

<!-- //- Modelo principal -->
<!-- =============================================== -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manutenção de metas cadastradas
        <small> Esta rotina tem como principal objetivo realizar a manutenção das metas previamente cadastradas pela
        rotina de importação de metas</small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

<!--https://jsfiddle.net/JeZap/1560/-->
      <div class="box box-primary">
                <div class="box-header">
                  <!--<i class="fa fa-edit"></i>-->
                  <h3 class="box-title"></h3>
                  <?= $mensagem ?>
                  <div class="form-group">
                    <label>Informe o Ano desejado:</label>
                    <select class="form-control" name="anoMeta" id="ano" required>
                      <?php
                        $years = range(date("Y"), date("Y")+10);//Ano + 10 anos

                        foreach ($years as $ano) {
                          echo "<option value=".sprintf("%04d", $ano).">".$ano."</option>";
                        }

                      ?>

                    </select>
                    <br>
                    <label>Informe o Mês desejado:</label>
                    <select class="form-control" name="mesMeta" id="mes" required>
                    <?php
                        $MesDesc = array(
                          '',
                          'JANEIRO',
                          'FEVEREIRO',
                          'MARÇO',
                          'ABRIL',
                          'MAIO',
                          'JUNHO',
                          'JULHO',
                          'AGOSTO',
                          'SETEMBRO',
                          'OUTUBRO',
                          'NOVEMBRO',
                          'DEZEMBRO'
                      );

                      $months = range(date("m"),'12'); // Não é possível lançar meta no mês < atual
                      //var_dump($months);

                      foreach ($months as $mes) {
                        echo "<option value=".sprintf("%02d", $mes).">".$MesDesc[$mes]."</option>";
                      }

                    ?>
                    </select>

                    <br>
                    <label>Informe o tipo de meta que deseja cadastrar:</label>
                    <select class="form-control" name="tipoMeta" id="tpMeta" required>
                      <option value="0">Meta por loja por ano e por mês</option>
                      <option value="1">Meta fixa por ano</option>
                    </select>


                  </div>
                  <div class="box-footer">

                    <button id="botaoPesq" class="btn btn-info pull-right" onclick="getDados();">Pesquisar</button>
                    <button id="botaoNVbusca" class="btn btn-success pull-right" onclick="location.reload();">Fazer uma nova busca</button>

                  </div>
                </div>
                <div id="conteudo"> <!-- Aqui fica o conteúdo AJAX --> </div>

              </div> <!-- /.box-footer-->

    </section>  <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

 <!-- Código para buscar CPF -->
 <script>
  /**
    * Função para criar um objeto XMLHTTPRequest
    */
   function CriaRequest() {
       try{
           request = new XMLHttpRequest();
       }catch (IEAtual){

           try{
               request = new ActiveXObject("Msxml2.XMLHTTP");
           }catch(IEAntigo){

               try{
                   request = new ActiveXObject("Microsoft.XMLHTTP");
               }catch(falha){
                   request = false;
               }
           }
       }

       if (!request)
           alert("Seu Navegador não suporta Ajax!");
       else
           return request;
   }

   /**
    * Função para enviar os dados
    */
   function getDados() {

       // Declaração de Variáveis
       var valorBusca   = document.getElementById("mes").value+document.getElementById("ano").value;
       var tpMeta = document.getElementById("tpMeta").value;

       var result = document.getElementById("conteudo");
       var xmlreq = CriaRequest();

       // Exibi a imagem de progresso
       result.innerHTML = '<div class="overlay"><i class="fa fa-refresh fa-spin"></i> </div>';

       // Iniciar uma requisição
       xmlreq.open("GET", "../valForms/AJAX_metas.php?periodo=" + valorBusca + "&tipoMeta="+ tpMeta , true);

       // Atribui uma função para ser executada sempre que houver uma mudança de ado
       xmlreq.onreadystatechange = function(){

           // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
           if (xmlreq.readyState == 4) {
               // Verifica se o arquivo foi encontrado com sucesso
               if (xmlreq.status == 200) {
                   result.innerHTML = xmlreq.responseText;
               }else{
                   result.innerHTML = "Erro: " + xmlreq.statusText;
               }
           }
       };
       xmlreq.send(null);

        $('#mes').attr('readonly', true)
        $('#mes option:not(:selected)').prop('disabled', true);

        $('#ano').attr('readonly', true)
        $('#ano option:not(:selected)').prop('disabled', true);

        $('#tpMeta').attr('readonly', true)
        $('#tpMeta option:not(:selected)').prop('disabled', true);

       //$('#botaoPesq').attr('disabled', true)

        $('#botaoPesq').hide();
        $('#botaoNVbusca').show();
   }
  </script>

<?php include '../pFixas/footer.php'; ?>
<script>
$(function() {

    $('#botaoNVbusca').hide();

  // Função é executada assim que a página fica pronta
    var $MesDesc = [
              '',
              'JANEIRO',
              'FEVEREIRO',
              'MARÇO',
              'ABRIL',
              'MAIO',
              'JUNHO',
              'JULHO',
              'AGOSTO',
              'SETEMBRO',
              'OUTUBRO',
              'NOVEMBRO',
              'DEZEMBRO'
              ];
    var option = ''; // guarda os valores do select html

    $('#ano').change(function(e){
    var cmbMes = document.getElementById("mes");
    var anoSelecionado = $('#ano').val();
    var d = new Date();
    if (anoSelecionado == (d.getFullYear())){ // Se Ano atual -> começar o mês no atual+1
      for (let index = d.getMonth()+1; index <= 12; index++) {
        option += '<option value="'+("0" + index).slice(-2)+'">'+$MesDesc[index]+'</option>';
      }
      cmbMes.innerHTML = '<select class="form-control" name="mesMeta" id="mes" required>';
      cmbMes.innerHTML += option;
      cmbMes.innerHTML += '</select>';
      option = '';
    }else{
      for (let index = 1; index <= 12; index++) {
        option += '<option value="'+("0" + index).slice(-2)+'">'+$MesDesc[index]+'</option>';
      }
      cmbMes.innerHTML = '<select class="form-control" name="mesMeta" id="mes" required>';
      cmbMes.innerHTML += option;
      cmbMes.innerHTML += '</select>';
      option = '';
    }
  })
});

  $(function() {
    //TODO: Fazer uma função para dar Fade in na msg de inserção/alteração com sucesso
  });
</script>
