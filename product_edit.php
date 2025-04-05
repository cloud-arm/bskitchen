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
                Product and Service Edit
                <small>Preview</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- SELECT2 EXAMPLE -->
            <div class="box box-info">

                <!-- /.box -->
                <?php $id = $_GET["id"];
                $result1 = $db->prepare("SELECT * FROM products WHERE id = '$id'");
                $result1->bindParam(':userid', $res);
                $result1->execute();
                for ($i = 0; $row1 = $result1->fetch(); $i++) {
                    $type = $row1['type'];
                ?>
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucfirst($row1['product_name']) ?></h3>
                        <a href="product_view.php" class="btn btn-primary btn-sm"> <i class="fa fa-arrow-left"></i> Back to Product List</a>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form method="post" action="product_edit_save.php">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <label> Name</label>
                                                    </div>
                                                    <input type="text" name="name" class="form-control" value="<?php echo $row1['product_name'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <label>Code</label>
                                                    </div>
                                                    <input type="text" class="form-control" name="code" value="<?php echo $row1['product_code'] ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">

                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <label> Sell Price</label>
                                                    </div>
                                                    <input type="text" value="<?php echo $row1['sell_price'] ?>" class="form-control" name="sell">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <label> Cost Price</label>
                                                    </div>
                                                    <input type="text" value="<?php echo $row1['cost_price'] ?>" class="form-control" name="cost">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <label> Type</label>
                                                    </div>
                                                    <select class="form-control" name="cat_id" id="">
                                                        <?php $cat_id = $row1['cat_id'];
                                                        $result = $db->prepare('SELECT * FROM category   ');
                                                        $result->bindParam(':id', $res);
                                                        $result->execute();
                                                        for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                                            <option <?php if ($row['id'] == $cat_id) {
                                                                        echo "selected";
                                                                    } ?> value="<?php echo $row['id'] ?>"><?php echo $row['name']  ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <input type="hidden" name="pro_id" value="<?php echo $id; ?>">
                                                            <input class="btn btn-info" style="width: 100%;" type="submit" value="Save">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <?php if ($row1['type'] == "dish") { ?>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="box-body inner">
                                            <h4>Use Materials</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form method="post" action="product_raw_add.php">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="">Use Product</label>
                                                                    <select class="form-control select2" name="mat" style="width: 100%;" id="mat">

                                                                        <?php
                                                                        $result = $db->prepare("SELECT * FROM products WHERE type='Materials' ");
                                                                        $result->bindParam(':userid', $res);
                                                                        $result->execute();
                                                                        for ($i = 0; $row = $result->fetch(); $i++) {
                                                                        ?>
                                                                            <option value="<?php echo $row['id']; ?>">
                                                                                <?php echo $row['product_name']; ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="">Qty</label>
                                                                    <input class="form-control" type="text" name="qty" id="qty" width="50%">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input class="btn btn-info" name="pro_id" type="hidden" value="<?php echo $id; ?>">
                                                                <input class="btn btn-info" type="submit" style="margin-top: 23px;" value="ADD">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group" id="sub_list">
                                                        <table class="table table-bordered table-striped" id="example1">
                                                            <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Qty</th>
                                                                    <th>#</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $result = $db->prepare("SELECT * FROM use_product WHERE main_product ='$id' ");
                                                                $result->bindParam(':userid', $res);
                                                                $result->execute();
                                                                for ($i = 0; $row = $result->fetch(); $i++) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $row['product_name']; ?></td>
                                                                        <td><?php echo $row['qty']; ?></td>
                                                                        <td>
                                                                            <span class="btn btn-danger btn-sm" id="<?php echo $row['id']; ?>" onclick="dll(<?php echo $row['id']; ?>)">X</span>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>


                            <?php if ($row1['type'] == "Product" || $row1['type'] == "Quick") { ?>

                                <div class="col-md-6">

                                    <div class="box-body inner">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <label> Category</label>
                                                        </div>
                                                        <select class="form-control select2" name="category" style="width: 100%;" id="mat">

                                                            <?php
                                                            $result = $db->prepare("SELECT * FROM catogary_list  ");
                                                            $result->bindParam(':userid', $res);
                                                            $result->execute();
                                                            for ($i = 0; $row = $result->fetch(); $i++) { ?>
                                                                <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $row1['category']) { ?> selected <?php } ?>>
                                                                    <?php echo $row['name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>


                            <div class="col-md-12" style="padding-bottom: 20px;">

                                <span class="btn btn-danger pull-right mx-2" onclick="product_dll('delete')"> <i class="fa-regular fa-trash-can"></i> Delete This Product</span>

                                <?php if ($row1['action']) { ?>
                                    <span class="btn btn-danger pull-right mx-2" onclick="product_dll('enable')"> <i class="fa-regular fa-circle-check"></i> Enable This Product</span>
                                <?php } else { ?>
                                    <span class="btn btn-danger pull-right mx-2" onclick="product_dll('disable')"> <i class="fa-solid fa-ban"></i> Disable This Product</span>
                                <?php } ?>

                            </div>
                        </div>

                        <form action="product_dll.php" id="dll-form" method="GET">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="type" id="form_type" value="">
                        </form>

                    </div>
                <?php } ?>
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
        <?php if ($type == "dish") { ?>
            var qty = document.getElementById("qty");
            qty.addEventListener("keypress", function(event) {
                // If the user presses the "Enter" key on the keyboard
                if (event.key === "Enter") {
                    // Cancel the default action, if needed
                    event.preventDefault();
                    // Trigger the button element with a click
                    matadd();
                }
            });
        <?php } ?>

        function matadd() {
            var mat = document.getElementById("mat").value;
            var qty = document.getElementById("qty").value;

            var xmlhttp;

            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    // document.getElementById("sub_list").innerHTML = xmlhttp.responseText;
                    console.log(xmlhttp.responseText);
                }
            }

            xmlhttp.open("GET", "product_sub_list_add.php?mat=" + mat + "&qty=" + qty + "&pro_id=<?php echo $id; ?>", true);
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

        function product_dll(type) {
            $('#form_type').val(type);

            if (confirm("Sure you want to " + type + " this Product? There is NO undo!")) {
                $('#dll-form').submit();
            }

            return false;
        }

        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();
            $("#example1").DataTable({
                "lengthChange": false,
                "searching": false
            });
        });
    </script>
</body>

</html>