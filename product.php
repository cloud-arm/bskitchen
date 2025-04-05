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
    $_SESSION['SESS_FORM'] = 'product';

    if ($r == 'Cashier') {

        include_once("sidebar2.php");
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

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4> Item Form:</h4>
                                            <form method="post" action="product_save.php">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <label> Name</label>
                                                                </div>
                                                                <input type="text" name="name" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="input-group date">
                                                                <div class="input-group-addon">
                                                                    <label>Code</label>
                                                                </div>
                                                                <input type="text" class="form-control" name="code" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                   

                                                    <div class="col-md-12">
                                                        <div class="form-group">

                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <label> Category</label>
                                                                </div>
                                                                <select name="cat" class="form-control select2">
                                                                    <?php
                                                                    $result = $db->prepare('SELECT * FROM category   ');
                                                                    $result->bindParam(':id', $res);
                                                                    $result->execute();
                                                                    for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                                                        <option value="<?php echo $row['id']  ?>">
                                                                            <?php echo $row['name']  ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                        <input type="hidden" class="form-control" name="sell">
                                                            <input type="hidden" name="type" value="Stock">
                                                            <input type="hidden" name="category" value="0">
                                                            <input type="hidden" name="re_order" value="0">
                                                            <input class="btn btn-info" style="width: 100%;" type="submit" value="Submit">
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                        


                                    </div>
                                </div>
                    <!-- /.tab-content -->
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

    <!-- Select2 -->
    <script src="../../plugins/select2/select2.full.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
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
    <!-- Page script -->
    <script>
        var qty1 = document.getElementById("qty1");
        qty1.addEventListener("keypress", function(event) {
            // If the user presses the "Enter" key on the keyboard
            if (event.key === "Enter") {
                // Cancel the default action, if needed
                event.preventDefault();
                // Trigger the button element with a click
                matadd(1);
            }
        });

        var qty2 = document.getElementById("qty2");
        qty2.addEventListener("keypress", function(event) {
            // If the user presses the "Enter" key on the keyboard
            if (event.key === "Enter") {
                // Cancel the default action, if needed
                event.preventDefault();
                // Trigger the button element with a click
                matadd(2);
            }
        });


        function matadd(i) {
            var mat = document.getElementById("mat" + i).value;
            var qty = document.getElementById("qty" + i).value;
            var xmlhttp;

            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("sub_list" + i).innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET", "product_sub_list_add.php?mat=" + mat + "&qty=" + qty, true);
            xmlhttp.send();

            document.getElementById("qty").value = "";
        }

        function dll(did) {

            var xmlhttp;

            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("sub_list").innerHTML = xmlhttp.responseText;
                }
            }

            xmlhttp.open("GET", "material_dll.php?id=" + did, true);
            xmlhttp.send();
        }

        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();

            $("#example1").DataTable({
                "lengthChange": false,
                "searching": false
            });
            $("#example2").DataTable({
                "lengthChange": false,
                "searching": false
            });
            $('#example4').DataTable({
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