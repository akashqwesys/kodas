<script src="<?= base_url('assets/highcharts/highcharts.js') ?>"></script>
<script src="<?= base_url('assets/highcharts/data.js') ?>"></script>
<script src="<?= base_url('assets/highcharts/drilldown.js') ?>"></script>
<h1><img src="<?= base_url('assets/imgs/admin-home.png') ?>" class="header-img" style="margin-top:-3px;"> Home</h1>
<hr>




<?php
/*$url = "https://ramrasiya.com/api/Dashboardcount";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
$json = curl_exec($ch);
if (!$json) {
echo curl_error($ch);
}
curl_close($ch);
$apidata = json_decode($json);*/

// echo $apidata->Data[0]->todaysales;
// echo $apidata->Data[0]->weeksales;
// echo $apidata->Data[0]->topcustomer;
// echo $apidata->Data[0]->bottomcustomer;
?>
<div class="home-page">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard - Statistics Overview
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <!-- <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </div> -->
                        <div class="col-xs-12">
                            <h4>Today’s Orders <span class="pull-right"><?php echo $todaysOrder + $todaysDirectOrder; ?></span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <!-- <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </div> -->
                        <div class="col-xs-12">
                            <h4>Weekly Orders <span class="pull-right"><?php echo $weeklyOrder['cnt'] + $weeklyDirectOrder['cnt']; ?></span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <!-- <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </div> -->
                        <div class="col-xs-12">
                            <h4>Monthly Orders <span class="pull-right"><?php echo $monthlyOrder['cnt'] + $monthlyDirectOrder['cnt']; ?></span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <!-- <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </div> -->
                        <div class="col-xs-12">
                            <h4>Today’s Sales <span class="pull-right">Rs.<?php echo $todaysSales['gstwithamount']; ?>/-</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <!-- <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </div> -->
                        <div class="col-xs-12">
                            <h4>Weekly Sales <span class="pull-right">Rs.<?php echo $weeklySales['total']; ?>/-</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <!-- <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-3x"></i>
                        </div> -->
                        <div class="col-xs-12">
                            <h4>Monthly Sales <span class="pull-right">Rs.<?php echo $monthlySales['total']; ?>/-</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-success">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $activeCustomers; ?></div>
                            <div>Active Customers</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url('admin/get-user-by-status/active'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user-times fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $inActiveCustomers; ?></div>
                            <div>In-Active Customers</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo site_url('admin/get-user-by-status/inactive'); ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class=""><i class="fa fa-shopping-cart"></i></span>&nbsp;Pending Orders (<?php echo $pendingOrder; ?>) <a href="<?php echo site_url('admin/get-order-by-status/Pending'); ?>" style="color:white"><span class="pull-right">View All</span></a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" style="margin-bottom: 0px;">
                        <table class="table table-hover table-responsive" style="margin-bottom: 0px;">
                            <thead class="bg-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listPendingOrder as $row) { ?>
                                    <tr>
                                        <td><b><?php echo $row['first_name']; ?></b>
                                            <p><?php echo $row['phone']; ?></p>
                                        </td>
                                        <td>Rs.<?php echo $row['gstwithamount']; ?>/-</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!---->
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <span class=""><i class="fa fa-shopping-cart"></i></span>&nbsp;Cancelled Orders (<?php echo $cancelledOrder; ?>) <a href="<?php echo site_url('admin/get-order-by-status/Cancelled'); ?>" style="color:#a94442"><span class="pull-right">View All</span></a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" style="margin-bottom: 0px;">
                        <table class="table table-hover table-responsive" style="margin-bottom: 0px;">
                            <thead class="bg-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listCancelledOrder as $row) { ?>
                                    <tr>
                                        <td><b><?php echo $row['first_name']; ?></b>
                                            <p><?php echo $row['phone']; ?></p>
                                        </td>
                                        <td>Rs.<?php echo $row['gstwithamount']; ?>/-</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!---->
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class=""><i class="fa fa-shopping-cart"></i></span>&nbsp;Pending Direct Orders (<?php echo $pendingDirectOrder; ?>) <a href="<?php echo site_url('admin/directorders?status=Pending&startdate=&enddate=&orderid='); ?>" style="color:#fff"><span class="pull-right">View All</span></a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" style="margin-bottom: 0px;">
                        <table class="table table-hover table-responsive" style="margin-bottom: 0px;">
                            <thead class="bg-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listPendingDirectOrder as $row) { ?>
                                    <tr>
                                        <td><b><?php echo $row['name']; ?></b>
                                            <p><?php echo $row['mobilenumber']; ?></p>
                                        </td>
                                        <td><?php echo $row['emailid']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!---->
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <span class=""><i class="fa fa-shopping-cart"></i></span>&nbsp;Cancelled Direct Orders (<?php echo $cancelledDirectOrder; ?>) <a href="<?php echo site_url('admin/directorders?status=Cancelled&startdate=&enddate=&orderid='); ?>" style="color:#a94442"><span class="pull-right">View All</span></a>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" style="margin-bottom: 0px;">
                        <table class="table table-hover table-responsive" style="margin-bottom: 0px;">
                            <thead class="bg-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listCancelledDirectOrder as $row) { ?>
                                    <tr>
                                        <td><b><?php echo $row['name']; ?></b>
                                            <p><?php echo $row['mobilenumber']; ?></p>
                                        </td>
                                        <td><?php echo $row['emailid']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!---->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class=""><i class="fa fa-users"></i></span>&nbsp;Top Customers <span class="pull-right">View All</span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" style="margin-bottom: 0px;">
                        <table class="table table-hover table-responsive" style="margin-bottom: 0px;">
                            <thead class="bg-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Total Order</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($topCustomers as $row) { ?>
                                    <tr>
                                        <td><b><?php echo $row['name']; ?></b>
                                            <p><?php echo $row['mobilenumber']; ?></p>
                                        </td>
                                        <td><?php echo $row['cnt']; ?></td>
                                        <td>Rs.<?php echo $row['totalAmount']; ?>/-</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!---->
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <span class=""><i class="fa fa-users"></i></span>&nbsp;Bottom Customers <span class="pull-right">View All</span>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" style="margin-bottom: 0px;">
                        <table class="table table-hover table-responsive" style="margin-bottom: 0px;">
                            <thead class="bg-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Total Order</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bottomCustomers as $row) { ?>
                                    <tr>
                                        <td><b><?php echo $row['name']; ?></b>
                                            <p><?php echo $row['mobilenumber']; ?></p>
                                        </td>
                                        <td><?php echo $row['cnt']; ?></td>
                                        <td>Rs.<?php echo $row['totalAmount']; ?>/-</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!---->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <span class=""><i class="fa fa-bar-chart"></i></span>&nbsp;Month To Month Orders
                </div>
                <div class="panel-body">
                    <canvas id="mTomOrders"></canvas>
                </div>
                <!---->
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <span class=""><i class="fa fa-bar-chart"></i></span>&nbsp;Month To Month Active Users
                </div>
                <div class="panel-body">
                    <canvas id="mTomActiveUser"></canvas>
                </div>
                <!---->
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <span class=""><i class="fa fa-bar-chart"></i></span>&nbsp;Views vs Orders
                </div>
                <div class="panel-body">
                <canvas id="viewVsOrder"></canvas>
                </div>
                <!---->
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <span class=""><i class="fa fa-bar-chart"></i></span>&nbsp;Customer vs Orders
                </div>
                <div class="panel-body">
                <canvas id="customerVsOrder"></canvas>
                </div>
                <!---->
            </div>
        </div>
    </div>
    