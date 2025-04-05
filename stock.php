<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>

<body class="hold-transition skin-blue skin-orange sidebar-mini">
  <?php
  include_once("auth.php");
  $r = $_SESSION['SESS_LAST_NAME'];
  $_SESSION['SESS_FORM'] = 'stock';

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
        Stock
        <small>Preview</small>
      </h1>

    </section>



    <section class="content">
      <div class="box box-success">
        <div class="box-header">
          <h3 class="box-title">STOCK Data</h3>
        </div>

        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>Product_id</th>
                <th>Code</th>
                <th>Name</th>
                <th>qty</th>
                <th>Type</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>

              <?php
              $result = $db->prepare("SELECT * FROM products   ORDER by id ASC  ");
              $result->bindParam(':userid', $date);
              $result->execute();
              for ($i = 0; $row = $result->fetch(); $i++) {

              ?>
                <tr class="record">
                  <td><?php echo $id = $row['id']; ?></td>
                  <td></td>
                  <td><?php echo $row['product_name']; ?></td>
                  <td><?php echo $row['qty']; ?></td>
                  <td><?php echo $row['type']; ?></td>
                  <td>
                    <a href="inventory.php" title="Click to view" class="btn btn-info btn-sm fa fa-eye"></a>
                  </td>

                </tr>
              <?php }  ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </section>
  </div>

  <!-- /.content-wrapper -->

  <?php
  include("dounbr.php");
  ?>

  <div class="control-sidebar-bg"></div>
  </div>

  <?php include_once('script.php'); ?>

  <!-- DataTables -->
  <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../../plugins/fastclick/fastclick.js"></script>
  <!-- page script -->

  <script>
    $(function() {

      $("#example1").DataTable();
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

  <script type="text/javascript">
    $(function() {


    });
  </script>

</body>

</html>