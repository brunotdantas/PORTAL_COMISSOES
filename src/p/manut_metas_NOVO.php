<?php
  include '../pFixas/cabec.php';
//--- Modelo principal
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <!-- nome meta -->
        <!-- <small>it all starts here</small>-->
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Cadastro de metas de vendas</h3>
                <br><br>

            <div class="form-group">
                <label>Lista de Lojas</label>
                <select id="teste" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <option selected="selected">Selecione uma loja</option>
                    <option>Alaska</option>
                    <option>Delaware</option>
                    <option>Tennessee</option>
                    <option>Texas</option>
                    <option>Washington</option>
                    <!-- Se precisar desabilitar algum resultado:
                        <option disabled="disabled">California (disabled)</option>
                    -->
                </select>
            <button id="botaoPesq" class="btn btn-info pull-left" onclick="getDados();">Carregar dados</button>         
            </div>             <br><br>
            <!--
              <div class="form-group">
                <label>Multiple</label>
                <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Select a State" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  <option>Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
              <!-- /.form-group -->
        </div>

        <div class="box">
            <div class="box-header with-border">
            <h3 class="box-title">Cadastro de metas de vendas</h3>
            <br><br>
           
           <!-- Se necessário for deixo essa parte para multiplas escolhas --> 
          <div id="conteudo"> <!-- Aqui fica o conteúdo AJAX --> </div>
        </div>

        <!-- /.box-body 
        <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
        -->

        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


    $('[data-filter-type="date-range"]').daterangepicker({
        showDropdowns: true,
        minDate: moment(),
        drops:'down',

/*        ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Esta semana': [moment().startOf('week'), moment().endOf('week')],
            'Última semana': [moment().subtract(6, 'days'), moment()],
            'Últimas 2 semanas': [moment().subtract(13, 'days'), moment()],
            'Este mes': [moment().startOf('month'), moment().endOf('month')],
            'Mes anterior': [moment().subtract(1, 'month').startOf('month'),
                moment().subtract(1, 'month').endOf('month')]
        },*/
        autoUpdateInput: true,
        applyClass: 'btn-sm btn-primary',
        cancelClass: 'btn-sm btn-default',
        locale: {
            format: 'DD/MM/YYYY',
            applyLabel: 'Aplicar',
            cancelLabel: 'Limpar',
            fromLabel: 'Desde',
            toLabel: 'Até',
            customRangeLabel: 'Selecionar período',
            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro',
                'Dezembro'],
            firstDay: 1
        }
    });



  })
</script>

<!--
  AJAX
-->

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
       var loja   = document.getElementById("teste").value;

       var result = document.getElementById("conteudo");
       var xmlreq = CriaRequest();

       // Exibe a imagem de progresso
       result.innerHTML = '<div class="overlay"><i class="fa fa-refresh fa-spin"></i> </div>';

       // Iniciar uma requisição
       xmlreq.open("GET", "../valForms/AJAX_NOVO_metas.php?loja=" + loja , true);
 
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

