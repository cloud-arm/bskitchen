<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="icon/favicon.png" alt=""></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg dark"><img src="icon/foodnet-dark.png" alt=""></span>
            <span class="logo-lg light"><img src="icon/foodnet-light.png" alt=""></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">

            </a>
            <?php
            include('connect.php');
            include('config.php');
            date_default_timezone_set("Asia/Colombo");

            $date =  date("Y-m-d");
            $dep = $_SESSION['SESS_DEPARTMENT'];
            $f = $_SESSION['SESS_FORM'];
            $pos = $_SESSION['SESS_LAST_NAME'];
            ?>
            <div class="navbar-menu">
                
            </div>


            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <?php

                    include('connect.php');
                    date_default_timezone_set("Asia/Colombo");
                    $date =  date("Y-m-d");

                    $uname = $_SESSION['SESS_MEMBER_ID'];
                    $result1 = $db->prepare("SELECT * FROM user WHERE id='$uname' ");
                    $result1->bindParam(':userid', $res);
                    $result1->execute();
                    for ($i = 0; $row1 = $result1->fetch(); $i++) {
                        $upic1 = $row1['upic'];
                    }

                    ?>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $_SESSION['SESS_FIRST_NAME']; ?></span>
                        </a>
                        <ul class="dropdown-menu user">
                            <!-- User image -->
                            <li class="user-header">
                                <div>
                                    <span class="badge"><i class="glyphicon glyphicon-user"></i><?php echo $_SESSION['SESS_LAST_NAME']; ?></span>
                                </div>
                                <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <p> <?php echo $_SESSION['SESS_FIRST_NAME']; ?></p>
                                <small>Member since Nov. 2023</small>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href=" ../../../index.php" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>

            <div class="navbar-search hidden">
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="" id="search-txt" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>

                <?php // if ($dep == 'restaurant') { ?>

                    <li class="<?php if ($f == 'index') {
                                    echo 'active';
                                } ?>">
                        <a href="index.php">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="<?php if ($f == 'issuing') {
                                    echo 'active';
                                } ?>">
                        <a href="issuing.php?id=<?php echo date('ymdHis'); ?>">
                            <i class="fa fa-archive"></i> <span>Issuing</span>
                        </a>
                    </li>
                    
                    <li class="<?php if ($f == 'product_view') {
                                    echo 'active';
                                } ?>">
                        <a href="product_view.php?id=<?php echo date('ymdHis'); ?>">
                            <i class="fa fa-cubes"></i> <span>Product</span>
                        </a>
                    </li>

                    <?php $co = '';
                    $co0 = '';
                    $dis = 'none';
                    if ($f == 'stock' || $f == 'stock_adjustment') {
                        $co = 'active';
                        $co0 = 'menu-open';
                        $dis = 'block';
                    } ?>

                    <li class="treeview <?php echo $co; ?>">
                        <a href="#"><i class="fa fa-cubes"></i><span>Stock</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu  <?php echo $co0; ?>" style="display:  <?php echo $dis; ?>;">

                            <li class="<?php if ($f == 'stock') {
                                            echo 'active';
                                        } ?>"><a href="stock.php"><i class="fa fa-circle-o text-aqua"></i> Stock View</a></li>

                            <li class="<?php if ($f == 'stock_adjustment') {
                                            echo 'active';
                                        } ?>"><a href="stock_adjustment.php"><i class="fa fa-circle-o text-aqua"></i> Stock Adjustment</a></li>
                        </ul>
                    </li>

                 

                  

                    <?php $co = '';
                    $co0 = '';
                    $dis = 'none';
                    if ($f == 'grn' || $f == 'grn_supply' || $f == 'grn_payment' || $f == 'grn_return' || $f == 'grn_order' || $f == 'grn_rp' || $f == 'grn_payment_rp' || $f == 'grn_return_rp' || $f == 'grn_order_rp') {
                        $co = 'active';
                        $co0 = 'menu-open';
                        $dis = 'block';
                    } ?>

                    <li class="treeview <?php echo $co; ?>">
                        <a href="#"><i class="fa fa-truck"></i><span>Purchases</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu  <?php echo $co0; ?>" style="display:  <?php echo $dis; ?>;">

                            <li class="<?php if ($f == 'grn') {
                                            echo 'active';
                                        } ?>"><a href="grn.php?id=<?php echo 'pu' . date("ymdhis"); ?>"><i class="fa fa-circle-o text-aqua"></i> GRN</a></li>

                            <li class="<?php if ($f == 'grn_supply') {
                                            echo 'active';
                                        } ?>"><a href="grn_supply.php?id=0"><i class="fa fa-circle-o text-aqua"></i> Suppliers</a></li>

                            <li class="<?php if ($f == 'grn_payment') {
                                            echo 'active';
                                        } ?>"><a href="grn_payment.php"><i class="fa fa-circle-o text-aqua"></i> Payment</a></li>

                            <li class="<?php if ($f == 'grn_return') {
                                            echo 'active';
                                        } ?>"><a href="grn_return.php?id=<?php echo 'rt' . date("ymdhis"); ?>"><i class="fa fa-circle-o text-aqua"></i> Return</a></li>

                            <li class="<?php if ($f == 'grn_order') {
                                            echo 'active';
                                        } ?>"><a href="grn_order.php?id=<?php echo date("ymdhis"); ?>"><i class="fa fa-circle-o text-aqua"></i> Order</a></li>

                            <?php $co = '';
                            if ($f == 'grn_rp' || $f == 'grn_payment_rp' || $f == 'grn_return_rp' || $f == 'grn_order_rp') {
                                $co = 'active';
                            } ?>

                            <li class="treeview <?php echo $co; ?>">
                                <a href="#">
                                    <i class="fa fa-line-chart"></i>
                                    <span>Report</span>
                                    <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                                </a>

                                <ul class="treeview-menu">
                                    <li class="<?php if ($f == 'grn_rp') {
                                                    echo 'active';
                                                } ?>"><a href="grn_rp.php?year=<?php echo date("Y"); ?>&month=<?php echo date("m"); ?>"><i class="fa fa-circle-o text-red"></i> GRN Record</a></li>

                                    <li class="<?php if ($f == 'grn_payment_rp') {
                                                    echo 'active';
                                                } ?>"><a href="grn_payment_rp.php?dates=<?php echo date("Y/m/d"); ?> - <?php echo date("Y/m/d"); ?>"><i class="fa fa-circle-o text-red"></i> Payment Record</a></li>

                                    <li class="<?php if ($f == 'grn_return_rp') {
                                                    echo 'active';
                                                } ?>"><a href="grn_return_rp.php?year=<?php echo date("Y"); ?>&month=<?php echo date("m"); ?>"><i class="fa fa-circle-o text-red"></i> Return Record</a></li>

                                    <li class="<?php if ($f == 'grn_order_rp') {
                                                    echo 'active';
                                                } ?>"><a href="grn_order_rp.php?year=<?php echo date("Y"); ?>&month=<?php echo date("m"); ?>"><i class="fa fa-circle-o text-red"></i> Order Record</a></li>

                                </ul>
                            </li>
                        </ul>
                    </li>

                    <?php $co = '';
                    $co0 = '';
                    $dis = 'none';
                    if ($f == 'sales_rp' || $f == 'inventory_rp') {
                        $co = 'active';
                        $co0 = 'menu-open';
                        $dis = 'block';
                    } ?>

                    <li class="treeview <?php echo $co; ?>">
                        <a href="#">
                            <i class="fa fa-line-chart"></i>
                            <span>Report</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>

                        <ul class="treeview-menu  <?php echo $co0; ?>" style="display:  <?php echo $dis; ?>;">
                           

                            <li class="<?php if ($f == 'inventory_rp') {
                                            echo 'active';
                                        } ?>"><a href="inventory_rp.php?dates=<?php echo date("Y/m/d"); ?> - <?php echo date("Y/m/d"); ?>"><i class="fa fa-circle-o text-aqua "></i> Inventory Report</a></li>

                        </ul>
                    </li>

                <?php // } ?>
                
               
            </ul>
        </section>