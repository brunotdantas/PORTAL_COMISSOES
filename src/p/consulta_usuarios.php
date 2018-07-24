<?php
  include '../pFixas/cabec.php';
//--- Modelo principal
?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
        <div class="box-body">

        <table class="table table-bordered text-center">
          <tbody>
          <tr>
            <th colspan="6"><h2>Usuários cadastrados</h2></th>
          </tr>
          <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>CPF</th>
            <th>usuario</th>
            <th>Usuário ativo?</th>
          </tr>

          <?php // busca usuários 
            $sql = "
            SELECT          u.Nome,
                u.Email,
                u.Senha,
                u.idTipo,
                u.CPF,
                u.SenhaTemporaria,
                u.usuario,
                case when u.ativo = 1 then 'SIM' else 'NÃO' end as ativo,
                u.primeiroAcesso,
                tp.descricaoTipo
                
            FROM usuarios u
            inner join tipo_usuarios tp on u.idTipo = tp.idTipo
            ";

            $resultado = sqlsrv_query( $conn, $sql);

            if(sqlsrv_has_rows($resultado)){
              while( $row = sqlsrv_fetch_array($resultado, SQLSRV_FETCH_ASSOC) ){
               $nome = $row["Nome"];
                $email   = $row["Email"];
                $tipo   = $row["descricaoTipo"];
                //(1 Administrador,2 Coordenador, 3 RH)
                $cpf   = $row["CPF"];
                $usuario   = $row["usuario"];
                $ativo   = $row["ativo"];

                echo "
                <tr>
                  <td> $nome </td>
                  <td> $email </td>
                  <td> $tipo </td>
                  <td> $cpf </td>
                  <td> $usuario </td>
                  <td> $ativo </td>

                  </tr>
                ";
              }
            }











          ?>
          












        </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include '../pFixas/footer.php'; ?>
