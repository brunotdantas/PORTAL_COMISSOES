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
          <br>          <br>

        <form action="validaTeste.php" method = "GET">
            <!-- input group -->
            <label>Nome da Meta:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-text-width"></i>
              </div> 
              <!--<input class="form-control" placeholder="Enter ..." disabled="" type="text"> -->
                <input class="form-control" type="text" name="nomeMeta" >                    
            </div>
            <!-- /.input group -->
            <br>
            <!-- Date range -->
            <div class="form-group">
              <label>Escolha o tempo de validade da meta:</label>

              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div> 
                <input class="form-control" type="text" data-toggle="daterangepicker" maxlength="23" name="timestamp" data-filter-type="date-range">                    
              </div>
              <!-- /.input group -->
            </div>
            <br>

            <div class="form-group">
              <label>Disabled Result</label>
              <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                <option selected="selected">Alabama</option>
                <option>Alaska</option>
                <!-- Se precisar desabilitar algum resultado:
                    <option disabled="disabled">California (disabled)</option>
                -->
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select>
            </div>


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
           
           <!-- Se necessário for deixo essa parte para multiplas escolhas --> 



        <!-- /.box-body -->
        <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
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
            customRangeLabel: 'Seleccionar período',
            daysOfWeek: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro',
                'Dezembro'],
            firstDay: 1
        }
    });



  })
</script>

<?php include '../pFixas/footer.php'; ?>

