<?php
  include '../pFixas/cabec.php';
//--- Modelo principal
?>
  <script>
  <!-- =============================================== -->
    // Script para carregar calendário
  <!-- =============================================== -->

  $( function() {
    $( "#from" ).datepicker({ dateFormat: 'dd/mm/yy' });
    //$( "#from" ).datepicker( "option", "dateFormat", "yy-mm" );
    var dateFormat = "dd/mm/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 3
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 3
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });

    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
      return date;
    }
  } );
  </script>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
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

        <div> <!--action="validaTeste.php" method = "GET">-->
          <div class="form-group">


          </div>

          <div class="form-group">
                <p><h4> Clique no campo abaixo para selecionar um período para buscar as metas  </h4></p>
                  <input type="text" name="daterange" id="date-range" />
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
        var periodo = document.getElementById("date-range").value;

        var result = document.getElementById("conteudo");
        var xmlreq = CriaRequest();

        // Exibi a imagem de progresso
        result.innerHTML = '<div class="overlay"><i class="fa fa-refresh fa-spin"></i> </div>';

        // Iniciar uma requisição
        xmlreq.open("GET", "../valForms/AJAX_busca_metas.php?periodo="+ periodo , true);

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

  //       $('#mes').attr('readonly', true)
  //       $('#mes option:not(:selected)').prop('disabled', true);

  //       $('#ano').attr('readonly', true)
  //       $('#ano option:not(:selected)').prop('disabled', true);

  //       $('#tpMeta').attr('readonly', true)
  //       $('#tpMeta option:not(:selected)').prop('disabled', true);

  //      //$('#botaoPesq').attr('disabled', true)

  //       $('#botaoPesq').hide();
  //       $('#botaoNVbusca').show();

    }
   </script>

   <script>
   $(function() {
     var start = moment();
     var end = moment().add(1, 'month'); ;

     $('input[name="daterange"]').daterangepicker({
       opens: 'right',
       startDate: start,
       endDate: end,
       locale: {
          format: 'DD/MM/YYYY'
       }
     }, function(start, end, label) {
       console.log("A new date selection was made: " + start.format('DD-MM-YYYY') + ' to ' + end.format('DD-MM-YYYY'));
     });
   });
   </script>

<?php include '../pFixas/footer.php'; ?>
