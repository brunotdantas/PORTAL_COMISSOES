<?php
  include '../pFixas/cabec.php';
//--- Modelo principal

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
        var periodoAnterior = new Date();
        periodoAnterior = moment(periodoAnterior).subtract(1,'month').format("YYYYMM");
        var result = document.getElementById("conteudo");
        var xmlreq = CriaRequest();

        // Exibi a imagem de progresso
        result.innerHTML = '<div class="overlay"><i class="fa fa-refresh fa-spin"></i> </div>';

        // Iniciar uma requisição
        xmlreq.open("GET", "../valForms/AJAX_executa_comissao.php?periodo="+ periodoAnterior , true);

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


  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Calcular comissão do mês anterior
        <small>Para calcular a comissão do mês anterior clique no botão abaixo:</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">

          <div class="box-tools pull-right">
          </div>
        </div>
        <div class="box-body">

            <button  class="btn btn-block btn-primary btn-lg" onclick="getDados();">Calcular comissão</button>

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
