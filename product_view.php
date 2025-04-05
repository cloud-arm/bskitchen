<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>

<body class="hold-transition skin-blue  sidebar-mini">
  <?php
  include_once("auth.php");
  $r = $_SESSION['SESS_LAST_NAME'];
  $_SESSION['SESS_FORM'] = 'product';

  if ($r == 'Cashier') {
    header("location:./../../../index.php");
  }
  if ($r == 'admin') {

    include_once("sidebar.php");
  }
  ?>

  <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Item
        <small>Preview</small>
      </h1>
    </section>

    <section class="content">

      <div class="box">
        <div class="box-header">

          <div class="row">
            <div class="col-md-3">
              <h3 class="box-title">Item Data</h3>
              <a href="product.php" class="btn btn-sm btn-info">New Item</a>
            </div>
            <div class="col-md-4">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-search"></i>
                </div>
                <input type="text" onkeyup="get_value('product-box','product_table.php?str='+this.value)" class="form-control" placeholder="Search..." style="border-left: 0;">
              </div>
            </div>
            
          </div>

        </div>
        <!-- /.box-header -->

        <div class="box-body">


          <table id="example1" class="table table-bordered table-striped">

            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Code</th>
                <th>Type</th>
                <th>#</th>
              </tr>

            </thead>
            <tbody id="product-box"> </tbody>
          </table>

        </div>

      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
  include("dounbr.php");
  ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

  <?php include_once('script.php'); ?>

  <!-- DataTables -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../../plugins/fastclick/fastclick.js"></script>


  <script>
    get_value('product-box', 'product_table.php?str=all')
  </script>

  <!-- page script -->
  <script>
    $(function() {
      $("#example1").DataTable({
        "autoWidth": false
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });

    });
  </script>
</body>

</html>