<? ?>
  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=$_SESSION["nome"]?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU DE OPÇÕES</li>
        <li class="treeview">

        <?php

          // TODO: fazer aqui uma lógica para buscar da tabela de acessos inves d chumbado como consta abaixo

          switch ($_SESSION["cargo"]) {
            case 1:
                echo "";

            case 2:
                echo '<li class="active"><a href="../p/cad_usuario.php"><i class="fa  fa-user-plus"></i>Manutenção de usuários</a></li>';
                echo '<li class="active"><a href="../p/consulta_usuarios.php"><i class="fa fa-users"></i>Consulta de usuários</a></li>';

                echo '<li class="active"><a href="../p/manut_metas.php"><i class="fa fa-money"></i>Manutenção de metas</a></li>';
                echo '<li class="active"><a href="../p/importa_metas.php"><i class="fa fa-money"></i>Importação de metas</a></li>';
                echo '<li class="active"><a href="../p/cad_fatcalc.php"><i class="fa fa-percent"></i>Cadastro de fat. de cálc.</a></li>';
//                echo '<li class="active"><a href="../p/manut_funcionarios.php"><i class="fa fa-users"></i>Manutenção de funcionários</a></li>';
                echo '<li class="active"><a href="../p/Calcular_comissao.php"><i class="fa fa-dollar"></i>Calcular comissão</a></li>';


            case 3:
                echo '<li class="active"><a href="../p/Comissoes_calculadas.php"><i class="fa fa-money"></i>Comissões já calculadas</a></li>';
          }

        ?>






        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li><a href="../../index2.html"><i class="fa fa-book"></i> <span>Exemplos</span></a></li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
