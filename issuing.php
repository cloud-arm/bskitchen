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
    $_SESSION['SESS_FORM'] = 'issuing';

    include_once("sidebar.php");
    
    $u = $_SESSION['SESS_MEMBER_ID'];



    ?>


    </script>


    <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Issuing
                <small>Preview</small>
            </h1>

        </section>
        <!-- Main content -->
        <section class="content">
            <!-- SELECT2 EXAMPLE -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Item Add</h3>
                            <!-- /.box-header -->
                        </div>

                        <div class="box-body d-block">
                            <form method="POST" action="save/issuing_save.php">
                                <div class="row">
                                    <div class="col-md-12 m-0">
                                        <div class="form-group" id="status"></div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <label>Item</label>
                                                </div>

                                                <select class="form-control select2" name="product" id="p_sel" style="width: 100%;" tabindex="1" autofocus>

                                                    <?php
                                                    $result = $db->prepare("SELECT * FROM products WHERE   dll = 0 ");
                                                    $result->bindParam(':id', $res);
                                                    $result->execute();
                                                    for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                                        <option value="<?php echo $row['id']; ?>">
                                                            <?php echo $row['product_code']; ?> -<?php echo $row['product_name']; ?>
                                                        </option>
                                                    <?php    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <label>Qty</label>
                                                </div>
                                                <input type="number" class="form-control" value="1" step=".001" name="qty" tabindex="2">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <label>Ration</label>
                                                </div>

                                                <select class="form-control select2" name="ration" id="ration"   tabindex="1" autofocus>
                                                    <?php $result=select('ration');
                                                    for ($i = 0; $row = $result->fetch(); $i++) {
                                                     ?>
                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'];  ?></option>
                                                    <?php } ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2" id="property">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <label>Date</label>
                                                </div>
                                                <input type="text" class="form-control" value="<?php echo date('Y-m-d') ?>" id="datepicker"  name="date" tabindex="2">
                                                
                                            </div>
                                        </div>
                                    </div>

                                    

                                    

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="<?php echo $invo; ?>">
                                            <input class="btn btn-warning" type="submit" value="Save">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Item List</h3>
                            <!-- /.box-header -->
                        </div>
                        <div class="box-body d-block">
                            <table id="example1" class="table table-bordered table-striped">
                               <thead>
                               <tr>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>QTY</th>
                                    <th>Ration</th>
                                    <th>Date</th>
                                </tr>
                               </thead>
                               <tbody>
                               <?php 
                                
                                $result = query("SELECT * FROM sales_list ORDER BY id DESC LIMIT 20");
                                
                                for ($i = 0; $row = $result->fetch(); $i++) {
                                    

                                ?>
                                    <tr class="record">
                                        <td><?php echo $row['id']  ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['qty']; ?></td>
                                        <td><?php echo $row['ration']; ?></td>
                                        <td><?php echo $row['date']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                               </tbody>
                                

                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- /.content-wrapper -->
    <?php include("dounbr.php"); ?>

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
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>

    <!-- Page script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();
            $("#example1").DataTable();
        });

        $('#datepicker').datepicker({
            autoclose: true,
            datepicker: true,
            format: 'yyyy-mm-dd '
        });
        $('#datepicker').datepicker({
            autoclose: true
        });

    </script>

</body>

</html>