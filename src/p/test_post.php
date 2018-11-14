<?php
  include '../pFixas/cabec.php';
?>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <div class="">
          <?php
            if(isset($_POST['submit']))
            {
                var_dump($_POST);
                $name = $_POST['arrayname'];
                $name1 = $_POST['arrayname1'];

                $iz = 0;
                foreach ($name as $v1) {
                  echo $name[$iz].'<br>';
                  echo $name1[$iz].'<br>';
                  $iz++;
                }

                //echo "User Has submitted the form and entered this name : <b> $name </b>";
                //echo "<br>You can use the following form again to enter a new name.";
            }
          ?>
          </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="number" name="arrayname[]"><br>
            <input type="number" name="arrayname[]"><br>
            <input type="number" name="arrayname[]"><br>

            <input type="number" name="arrayname1[]"><br>
            <input type="number" name="arrayname1[]"><br>
            <input type="number" name="arrayname1[]"><br>

            <input type="submit" name="submit" value="Submit Form"><br>
          </form>





        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include '../pFixas/footer.php'; ?>
