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

    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Date Selector</h3>
          </div>

          <div class="box-body">
            <form action="" method="GET">
              <div class="row" style="margin-bottom: 20px;display: flex;align-items: end;">
                <div class="col-lg-1"></div>
                <div class="col-lg-8">
                  <label>Date range:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="reservation" name="dates" value="<?php echo $_GET['dates']; ?>">
                  </div>
                </div>
                <input type="hidden" name="pro" value="<?php echo $_GET['pro'] ?>">

                <div class="col-lg-2">
                  <input type="submit" class="btn btn-info" value="Apply">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php
    include("connect.php");
    date_default_timezone_set("Asia/Colombo");

    $dates = $_GET['dates'];
    $d1 = date_format(date_create(explode("-", $dates)[0]), "Y-m-d");
    $d2 = date_format(date_create(explode("-", $dates)[1]), "Y-m-d");

    ?>

    <section class="content">

      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Inventory record</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>id</th>
                <th>Type</th>
                <th>Name</th>
                <th>qty</th>
                <th>Balance</th>
                <th>Time</th>
                <th>#</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $dates = $_GET['dates'];
              $d1 = date_format(date_create(explode("-", $dates)[0]), "Y-m-d");
              $d2 = date_format(date_create(explode("-", $dates)[1]), "Y-m-d");
          
              echo $d1;
              $pro_id=$_GET['pro'];
              $result = select_query("SELECT * FROM stock_log WHERE product_id='$pro_id' AND date BETWEEN '$d1' AND '$d2'  ORDER by id ASC  ");
              for ($i = 0; $row = $result->fetch(); $i++) {
              ?>
                <tr class="record">
                  <td><?php echo $id = $row['id']; ?></td>
                  <td><?php echo $row['type']; ?></td>
                  
                  <td><?php echo $row['product_name']; ?></td>
                  <td><?php echo $row['qty']; ?></td>
                  <td><?php echo $row['qty_balance']; ?></td>
                  <th><?php echo $row['date'].' / '.$row['time']  ?></th>
                  <td><?php echo $row['invoice_no']; ?></td>
                  
                  
                </tr>

              <?php } ?>

            </tbody>
            <tfoot>


            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
      <!-- /.row -->

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
  <!-- date-range-picker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
  <!-- SlimScroll -->
  <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../../plugins/fastclick/fastclick.js"></script>
  <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
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

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    //$('#datepicker').datepicker({datepicker: true,  format: 'yyyy/mm/dd '});
    //Date range as a button
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function(start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }
    );

    $('#datepicker').datepicker({
      autoclose: true,
      datepicker: true,
      format: 'yyyy-mm-dd '
    });
    $('#datepicker').datepicker({
      autoclose: true
    });



    $('#datepickerd').datepicker({
      autoclose: true,
      datepicker: true,
      format: 'yyyy-mm-dd '
    });
    $('#datepickerd').datepicker({
      autoclose: true
    });
  </script>
</body>

</html>