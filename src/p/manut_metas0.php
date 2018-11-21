<?php
  include '../pFixas/cabec.php';
//--- Modelo principal


$mensagem = '';

$flag = isset($_GET['flag']) ? $_GET['flag'] : 'z';

if ($flag == 1){
    $mensagem = '
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-check"></i> Alert!</h4>
      Valores atualizados com sucesso!
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
        var mes = document.getElementById("meses").value;
        var ano = document.getElementById("anos").value;
        var result = document.getElementById("conteudo");
        var xmlreq = CriaRequest();

        // Exibi a imagem de progresso
        result.innerHTML = '<div class="overlay"><i class="fa fa-refresh fa-spin"></i> </div>';

        // Iniciar uma requisição
        xmlreq.open("GET", "../valForms/AJAX_busca_metas.php?periodo="+ ano+mes , true);

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

    }
   </script>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?= $mensagem ?>
      <h1>
        <!--Manutenção de metas já inseridas -->
        <small></small>
      </h1>
<!--      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
-->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manutenção de metas já inseridas</h3>
          <!--
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        -->
        </div>
        <div class="box-body">
                                <?php
                                //<option value="Green">Green</option>

                                // Pega dia de hoje
                                $today = getdate();
                                //$today[mon];
                                //$today[year];

                                // Carrega os meses
                                $meses = [];
                                array_push($meses,array(1,"Janeiro"))  ;
                                array_push($meses,array(2,"Fevereiro"));
                                array_push($meses,array(3,"Março"));
                                array_push($meses,array(4,"Abril"));
                                array_push($meses,array(5,"Maio"));
                                array_push($meses,array(6,"Junho"));
                                array_push($meses,array(7,"Julho"));
                                array_push($meses,array(8,"Agosto"));
                                array_push($meses,array(9,"Setembro"));
                                array_push($meses,array(10,"Outubro"));
                                array_push($meses,array(11,"Novembro"));
                                array_push($meses,array(12,"Dezembro"));

                                // Carrega anos
                                $anos = [];
                                array_push($anos,array(0,date("Y")));
                                array_push($anos,array(1,date("Y")-1));
                                array_push($anos,array(2,date("Y")-2));
                                array_push($anos,array(3,date("Y")-3));
                                array_push($anos,array(4,date("Y")-4));
                                array_push($anos,array(5,date("Y")-5));
                                array_push($anos,array(6,date("Y")-6));
                                array_push($anos,array(7,date("Y")-7));
                                array_push($anos,array(8,date("Y")-8));
                                array_push($anos,array(9,date("Y")-9));
                                array_push($anos,array(10,date("Y")-10));

                                 ?>
                                 <!-- Date -->
                                 <div class="form-group">
                                   <label>Selecione um mês:</label>
                                   <div class="input-group date">
                                     <div class="input-group-addon">
                                       <i class="fa fa-calendar"></i>
                                     </div>

                                    <select class="form-control" id="meses">
                                      <?php
                                        $i = 1;
                                        foreach ($meses as  $value) {
                                          echo '<option value="';
                                          echo sprintf("%02d", $i).'"';
                                          echo ">$value[1]</option>";
                                          $i++;
                                        }
                                      ?>
                                     </select>
                                   </div>

                                   <br>
                                   <!-- Date -->
                                   <div class="form-group">
                                     <label>Selecione um Ano:</label>
                                     <div class="input-group date">
                                       <div class="input-group-addon">
                                         <i class="fa fa-calendar"></i>
                                       </div>

                                       <select class="form-control" id="anos">
                                         <?php
                                           $i = 0;
                                           foreach ($anos as  $value) {
                                             echo '<option value="';
                                             echo $value[1].'"';
                                             echo ">$value[1]</option>";
                                             $i++;
                                           }
                                         ?>
                                        </select>

                            </div>
                          </div>

          <button  class="btn btn-info pull-left" onclick="getDados();">Carregar dados</button>

        </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <div id="conteudo"> <!-- Aqui fica o conteúdo AJAX --> </div>

        </div>



        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include '../pFixas/footer.php'; ?>
