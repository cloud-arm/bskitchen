<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
date_default_timezone_set("Asia/Colombo");
?>

<body class="hold-transition skin-blue skin-orange sidebar-mini">
    <?php
    include_once("auth.php");
    $r = $_SESSION['SESS_LAST_NAME'];
    $_SESSION['SESS_FORM'] = 'grn_supply';
    if ($r == 'Cashier') {
        header("location: app/");
    }
    if ($r == 'admin') {
        include_once("sidebar.php");
    }

    $depart = $_SESSION['SESS_DEPARTMENT'];

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = 0;
    }
    ?>

    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Supply
                <small>Preview</small>
            </h1>

        </section>

        <!-- add item -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">

                    <?php if ($id == '0') { ?>

                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Add Supplier</h3>
                            </div>

                            <div class="box-body d-block">

                                <form method="POST" action="grn_supply_save.php" class="w-100">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" name="name" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" name="address" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Company Contact</label>
                                                <input type="text" name="contact" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Contact Person</label>
                                                <input type="text" name="person" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Mobile <small>(Optional)</small> </label>
                                                <input type="text" name="mobile" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="height: 75px;display: flex; align-items: end;">
                                            <div class="form-group">
                                                <input type="hidden" name="department" value="<?php echo $depart; ?>">
                                                <input type="hidden" name="id" value="0">
                                                <input type="submit" value="Save" class="btn btn-success">
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    <?php } else { ?>

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Update Supplier</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                    </button>
                                    <a href="grn_supply.php" class="btn btn-box-tool" ><i class="fa fa-times"></i></a>
                                </div>
                            </div>

                            <?php
                            $id = $_GET['id'];

                            $result = $db->prepare("SELECT * FROM supplier WHERE id=:id ");
                            $result->bindParam(':id', $id);
                            $result->execute();
                            for ($i = 0; $row = $result->fetch(); $i++) {
                                $id = $row['id'];
                                $name = $row['name'];
                                $address = $row['address'];
                                $contact = $row['contact'];
                                $person = $row['contact_person'];
                                $mobile = $row['mobile'];
                                $email = $row['email'];
                            } ?>

                            <div class="box-body d-block">

                                <form method="POST" action="grn_supply_save.php" class="w-100">

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" value="<?php echo $name; ?>" name="name" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" value="<?php echo $address; ?>" name="address" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Company Contact</label>
                                                <input type="text" value="<?php echo $contact; ?>" name="contact" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Contact Person</label>
                                                <input type="text" value="<?php echo $person; ?>" name="person" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Mobile <small>(Optional)</small> </label>
                                                <input type="text" value="<?php echo $mobile; ?>" name="mobile" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" value="<?php echo $email; ?>" name="email" class="form-control" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="height: 75px;display: flex; align-items: end;">
                                            <div class="form-group">
                                                <input type="hidden" name="department" value="<?php echo $depart; ?>">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                <input type="submit" value="Update" class="btn btn-info">
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    <?php } ?>

                </div>

                <div class="col-md-12">

                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Supply List</h3>
                        </div>
                        <div class="box-body d-block">
                            <table id="example2" class="table table-bordered ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th>Co: Person</th>
                                        <th>Co: Mobile</th>
                                        <th>Email</th>
                                        <th>Department</th>
                                        <th>#</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $result = $db->prepare("SELECT * FROM supplier WHERE department = '$depart' ");
                                    $result->bindParam(':id', $date);
                                    $result->execute();
                                    for ($i = 0; $row = $result->fetch(); $i++) {  ?>

                                        <tr class="record">
                                            <td><?php echo $row['id'];   ?> </td>
                                            <td><?php echo $row['name'];   ?></td>
                                            <td><?php echo $row['address'];   ?></td>
                                            <td><?php echo $row['contact'];   ?></td>
                                            <td><?php echo $row['contact_person'];   ?></td>
                                            <td><?php echo $row['mobile'];   ?></td>
                                            <td><?php echo $row['email'];   ?></td>
                                            <td><?php echo ucfirst($row['department']);   ?></td>

                                            <td style="display: flex; gap:5px;">
                                                <a href="#" id="<?php echo $row['id']; ?>" class="dll_btn btn btn-sm btn-danger" title="Click to Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <a href="grn_supply.php?id=<?php echo $row['id']; ?>" class="up_btn btn-sm btn btn-warning" title="Click to Delete">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                            </td>

                                        </tr>

                                    <?php }   ?>
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>

    <!-- /.content-wrapper -->
    <?php include("dounbr.php"); ?>

    <div class="control-sidebar-bg"></div>
    </div>

    <?php include_once('script.php'); ?>

    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="../../plugins/select2/select2.full.min.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>

    <script type="text/javascript">
        $(function() {

            $(".dll_btn").click(function() {
                var element = $(this);
                var id = element.attr("id");
                var info = 'id=' + id;
                if (confirm("Sure you want to delete this Collection? There is NO undo!")) {

                    $.ajax({
                        type: "GET",
                        url: "grn_supply_dll.php",
                        data: info,
                        success: function() {

                        }
                    });
                    $(this).parents(".record").animate({
                            backgroundColor: "#fbc7c7"
                        }, "fast")
                        .animate({
                            opacity: "hide"
                        }, "slow");
                }
                return false;
            });

        });

        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        });
    </script>


    <!-- Page script -->
    <script>
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();

            //Date range picker
            $('#reservation').daterangepicker();
            //Date range picker with time picker
            //$('#datepicker').datepicker({datepicker: true,  format: 'yyyy/mm/dd '});
            //Date range as a button


            //Date picker
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


        });
    </script>


</body>

</html>