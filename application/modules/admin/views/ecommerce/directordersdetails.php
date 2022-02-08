<link href="<?=base_url('assets/css/bootstrap-toggle.min.css')?>" rel="stylesheet">
<div>
  <h1><img src="<?=base_url('assets/imgs/orders.png')?>" class="header-img" style="margin-top:-2px;"> Direct Orders Details</h1>
  <?php /*?><?php if (!isset($_GET['settings'])) { ?>
<a href="?settings" class="pull-right orders-settings"><i class="fa fa-cog" aria-hidden="true"></i> <span>Settings</span></a>
<?php } else { ?>
<a href="<?= base_url('admin/orders') ?>" class="pull-right orders-settings"><i class="fa fa-angle-left" aria-hidden="true"></i> <span>Back</span></a>
<?php } ?><?php */?>
</div>
<hr>
<?php
if (!isset($_GET['settings'])) {
	if (!empty($orders_details)) {
		?>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Order Details</h3>
      </div>
      <table class="table">
        <tbody>
          <tr>
            <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Date Added"><i class="fa fa-calendar fa-fw"></i></button></td>
            <td><?=date('d/m/Y', $orders_details->datetime);?></td>
          </tr>
          <!-- <tr>
            <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Shipping Method"><i class="fa fa-truck fa-fw"></i></button></td>
            <td><?=$orders_details->transportname;?></td>
          </tr> -->
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-user"></i> Customer Details</h3>
      </div>
      <table class="table">
        <tbody>
          <tr>
            <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Customer"><i class="fa fa-user fa-fw"></i></button></td>
            <td><?=$orders_details->name;?></td>
          </tr>
          <tr>
            <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Business Name"><i class="fa fa-user fa-fw"></i></button></td>
            <td><?=$orders_details->businessname;?></td>
          </tr>
          <tr>
            <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="E-Mail"><i class="fa fa-envelope-o fa-fw"></i></button></td>
            <td><a href="mailto:<?=$orders_details->emailid;?>">
              <?=$orders_details->emailid;?>
              </a></td>
          </tr>
          <tr>
            <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Telephone"><i class="fa fa-phone fa-fw"></i></button></td>
            <td><?=$orders_details->mobilenumber;?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-cog"></i> Status</h3>
      </div>
      <table class="table">
        <tbody>
          <tr>
            <td><strong>Status</strong></td>
            <td class="text-center"><select class="form-control" name="orderstatus" id="directorderstatus">


            <option value="Pending" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Pending') {echo 'selected="selected"';}?>>Pending</option>
            <option value="Accepted_by_Agent" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Accepted_by_Agent') {echo 'selected="selected"';}?>>Accepted By Agent</option>
            <option value="Accepted_by_kodas" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Accepted_by_kodas') {echo 'selected="selected"';}?>>Accepted By Kodas</option>                                   
            <option value="Processing" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Processing') {echo 'selected="selected"';}?>>Processing</option>
            <option value="Shipped" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Shipped') {echo 'selected="selected"';}?>>Shipped</option>
            <!-- <option value="Delivered" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Delivered') {echo 'selected="selected"';}?>>Delivered</option>
            <option value="Complete" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Complete') {echo 'selected="selected"';}?>>Complete</option> -->
            <option value="Cancelled" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Cancelled') {echo 'selected="selected"';}?>>Cancelled</option>



                <!-- <option value="Pending" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Pending') {echo 'selected="selected"';}?>>Pending</option>
                <option value="Processing" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Processing') {echo 'selected="selected"';}?>>Processing</option>
                <option value="Shipped" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Shipped') {echo 'selected="selected"';}?>>Shipped</option>
                <option value="Delivered" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Delivered') {echo 'selected="selected"';}?>>Delivered</option>
                <option value="Complete" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Complete') {echo 'selected="selected"';}?>>Complete</option>
                <option value="Cancelled" <?php if (isset($orders_details->orderstatus) && $orders_details->orderstatus == 'Cancelled') {echo 'selected="selected"';}?>>Cancelled</option> -->
              </select></td>
                <td>
                <button type="button" onclick="directorderstatus(<?=$orders_details->id;?>)"  class="btn btn-primary">Submit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-info-circle"></i> Order (#
      <?=$orders_details->id;?>
      )</h3>
  </div>
  <div class="panel-body">
    <table class="table table-bordered" cellpadding="4">
      <thead>
        <tr>
          <td class="text-center">Image</td>
          <td class="text-left">Title</td>
          <td class="text-left">Description</td>
          <td class="text-center">Audio</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center"><?php if (isset($orders_details->orderphoto) && $orders_details->orderphoto != '') {
			echo '<a href="' . base_url('attachments/photoorder_images/' . $orders_details->orderphoto) . '" download><img src="' . base_url('attachments/photoorder_images/' . $orders_details->orderphoto) . '" height="75" width="75"></a>';
		}?></td>
          <td class="text-left"><?=$orders_details->title;?></td>
          <td class="text-left"><?=$orders_details->description;?></td>
          <td class="text-center"><?php if (isset($orders_details->orderaudio) && $orders_details->orderaudio != '') {
			echo '<audio controls="">
					  <source src="' . base_url('attachments/audiofile/' . $orders_details->orderaudio) . '" type="audio/mpeg">
					</audio>';
		}?></td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr>
          <td>Direct Order Comment</td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><table class="table table-bordered" cellpadding="4">
              <thead>
                <tr>
                  <td class="text-left">Username</td>
                  <td class="text-left">Message</td>
                  <td class="text-left">Date & Time </td>
                </tr>
              </thead>
              <tbody>
                <?php

		foreach ($ordercomment as $key => $value) {
			$namemsg = '';
			if ($value['usertype'] == 'admin') {
				$test = $this->db->select('*')->where('id', $value['sender_id'])->get('users')->row();
				$namemsg = $test->username . ' (admin)';
			} else {
				$namemsg = $orders_details->name;
			}
			?>
                <tr>
                  <td class="text-left"><?=$namemsg;?></td>
                  <td class="text-left"><?=$value['message'];?></td>
                  <td class="text-left"><?=date('d-m-Y h:i:s A', $value['time']);?></td>
                </tr>
                <?php }?>
              </tbody>
            </table></td>
        </tr>
      </tbody>
    </table>
    <div class="row">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"> Send Order Comment</h3>
          </div>
          <form style="padding: 10px 20px;" method="post">
          <div class="form-group">
          <input type="hidden" name="sender_id" value="1" />
          <input type="hidden" name="receiver_id" value="<?=$orders_details->userid;?>" />
          <input type="hidden" name="order_id" value="<?=$orders_details->id;?>" />
          <textarea class="form-control" name="ordercommentmsg"></textarea>
          </div>
          <button type="submit" name="sendcomment" class="btn btn-primary">Send</button>
          </form>
        </div>
      </div>
    </div>

    <div class="row text-right" style="margin-right: 0px;">
  <a href="<?=base_url('admin/directorders')?>" class="btn btn-lg btn-default">Back</a>
    </div>
  </div>
</div>
<?php } else {?>
<div class="alert alert-info">No orders to the moment!</div>
<?php }
	?>
<hr>
<?php
}
?>
<style type="text/css">
.table thead td {
    font-weight: bold;
}
</style>
<script src="<?=base_url('assets/js/bootstrap-toggle.min.js')?>"></script>
