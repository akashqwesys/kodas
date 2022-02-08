<link href="<?=base_url('assets/css/bootstrap-toggle.min.css')?>" rel="stylesheet">
<div>
  <h1><img src="<?=base_url('assets/imgs/orders.png')?>" class="header-img" style="margin-top:-2px;">Direct Orders
    <?=isset($_GET['settings']) ? ' / Settings' : ''?>
  </h1>
  <?php /*?><?php if (!isset($_GET['settings'])) { ?>
<a href="?settings" class="pull-right orders-settings"><i class="fa fa-cog" aria-hidden="true"></i> <span>Settings</span></a>
<?php } else { ?>
<a href="<?= base_url('admin/orders') ?>" class="pull-right orders-settings"><i class="fa fa-angle-left" aria-hidden="true"></i> <span>Back</span></a>
<?php } ?><?php */?>
</div>
<hr>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
<div class="row" style="margin-bottom:10px;">
  <form method="get" action="<?=base_url('admin/directorders');?>">
    <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
      <select class="form-control selectpicker" name="status">
        <option value="">Select Status</option>
        <option value="Pending" <?php if (isset($_GET['status']) && $_GET['status'] == 'Pending') {
                                  echo 'selected';
                                } ?>>Pending</option>
        <option value="Accepted_by_Agent" <?php if (isset($_GET['status']) && $_GET['status'] == 'Accepted_by_Agent') {
                                      echo 'selected';
                                    } ?>>Accepted By Agent</option>

<option value="Accepted_by_kodas" <?php if (isset($_GET['status']) && $_GET['status'] == 'Accepted_by_kodas') {
                                      echo 'selected';
                                    } ?>>Accepted By Kodas</option>                                   

        <option value="Processing" <?php if (isset($_GET['status']) && $_GET['status'] == 'Processing') {
                                      echo 'selected';
                                    } ?>>Processing</option>
        <option value="Shipped" <?php if (isset($_GET['status']) && $_GET['status'] == 'Shipped') {
                                  echo 'selected';
                                } ?>>Shipped</option>
        <!-- <option value="Delivered" <?php if (isset($_GET['status']) && $_GET['status'] == 'Delivered') {
                                    echo 'selected';
                                  } ?>>Delivered</option>
        <option value="Complete" <?php if (isset($_GET['status']) && $_GET['status'] == 'Complete') {
                                    echo 'selected';
                                  } ?>>Complete</option> -->
        <option value="Cancelled" <?php if (isset($_GET['status']) && $_GET['status'] == 'Cancelled') {
                                    echo 'selected';
                                  } ?>>Cancelled</option> 
      </select>
    </div>
    <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
          <input type="text" id="fromDate" class="form-control" value="<?php if (isset($_GET['startdate'])) {echo $_GET['startdate'];}?>" name="startdate" placeholder="Start Date" autocomplete="off">
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
          <input type="text" id="toDate" class="form-control" name="enddate" placeholder="End Date" value="<?php if (isset($_GET['enddate'])) {echo $_GET['enddate'];}?>" autocomplete="off">
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-12 col-md-4 col-lg-2 col-xl-2">
      <input type="text" class="form-control" name="orderid" placeholder="Enter Order ID" value="<?php if (isset($_GET['orderid'])) {echo $_GET['orderid'];}?>" autocomplete="off">
    </div>
    <div class="col-12 col-sm-12 col-md-2 col-lg-1 col-xl-1">
      <input class="btn btn-primary" type="submit" value="Submit">
    </div>
    <div class="col-12 col-sm-12 col-md-2 col-lg-1 col-xl-1">
      <a href="<?=base_url('admin/directorders');?>" class="btn " style="background: #6c757d; color: #fff;">Reset</a>
    </div>
  </form>
</div>
<?php
if (!isset($_GET['settings'])) {
	if (!empty($orders)) {
		?>
<div>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Name</th>
        <th>Business Name</th>
        <th>Date</th>
        <th>Status</th>
        <th class="text-center">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $key => $value) {?>
      <tr>
        <td class="relative"><a href="directordersdetails/<?=$value['id']?>">#
          <?=$value['id'];?>
          <?php if ($value['viewed'] == 0) {?>
        <span class="badge badge-danger ml-2" style="background-color: #d9534f;">New</span>
        <?php }?>
          </a></td>
        <td><?=$value['name'];?></td>
        <td><?=$value['businessname'];?></td>
        <td><?=date('d-m-Y', $value['datetime']);?></td>
        <td><?=$value['orderstatus'];?></td>
        <td class="text-center"><a href="<?=base_url('admin/directordersdetails/' . $value['id']);?>" class="btn btn-default more-info"> More Info <i class="fa fa-info-circle" aria-hidden="true"></i> </a></td>
      </tr>
      <?php }?>
    </tbody>
  </table>
</div>
<?=$links_pagination?>
<?php } else {?>
<div class="alert alert-info">No orders to the moment!</div>
<?php }
	?>
<hr>
<?php
}
?>
<!-- Modal for more info buttons in orders -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
$(document).ready(function(){
   $("#fromDate").datepicker({
       format: 'dd-mm-yyyy',
       autoclose: true,
   }).on('changeDate', function (selected) {
       var minDate = new Date(selected.date.valueOf());
       $('#toDate').datepicker('setStartDate', minDate);
   });

   $("#toDate").datepicker({
       format: 'dd-mm-yyyy',
       autoclose: true,
   }).on('changeDate', function (selected) {
           var minDate = new Date(selected.date.valueOf());
           $('#fromDate').datepicker('setEndDate', minDate);
   });
});
</script>

<script src="<?=base_url('assets/js/bootstrap-toggle.min.js')?>"></script>
