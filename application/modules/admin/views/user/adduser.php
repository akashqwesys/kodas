<script src="<?=base_url('assets/ckeditor/ckeditor.js')?>"></script>

<h1><img src="<?=base_url('assets/imgs/admin-user.png')?>" class="header-img" style="margin-top:-3px;"> Add User</h1>
<hr>
<?php
$timeNow = time();
if (validation_errors()) {
	?>
<hr>
<div class="alert alert-danger">
  <?=validation_errors()?>
</div>
<hr>
<?php
}
if ($this->session->flashdata('result_publish')) {
	?>
<hr>
<div class="alert alert-success">
  <?=$this->session->flashdata('result_publish')?>
</div>
<hr>
<?php
}
?>

<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-user"></i> Customer Details</h3>
      </div>
      <form method="POST" action="" enctype="multipart/form-data">
      <table class="table">
        <tbody>
          <tr>
            <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Customer"><i class="fa fa-user fa-fw"></i></label></td>
            <td><input type="text" required id="Fullname" name="name" placeholder="Full Name" value="<?=@$_POST['name']?>" class="form-control"></td>
          </tr>
          <tr>
            <td><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="E-Mail"><i class="fa fa-phone fa-fw"></i></label></td>
            <td><input type="text" required id="Phonenumber" name="mobilenumber" placeholder="Mobilenumber" value="<?=@$_POST['mobilenumber']?>" class="form-control"></td>
          </tr>
          <tr>
            <td><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Telephone"><i class="fa fa-envelope-o fa-fw"></i></label></td>
            <td><input type="text" required id="Emailid" name="emailid" placeholder="Email" value="<?=@$_POST['emailid']?>" class="form-control"></td>
          </tr>
          <tr>
            <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Date Added"><i class="fa fa-map-marker fa-fw"></i></label></td>
            <td><textarea name="address" rows="5" placeholder="Address" class="form-control"><?=@$_POST['address']?></textarea></td>
          </tr>
          <tr>
            <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Customer"><i class="fa fa-user fa-fw"></i></label></td>
            <td><input type="text"  id="ContactID" placeholder="Account reference ID" name="contactid" value="<?=@$_POST['contactid']?>" class="form-control"></td>
          </tr>

           <tr>
            <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Customer"><i class="fa fa-briefcase   fa-fw"></i></label></td>
            <td><input type="text"  id="Business" placeholder="Business Name" name="businessname" value="<?=@$_POST['businessname']?>" class="form-control"></td>
          </tr>

           <tr>
            <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Customer"><i class="fa fa-user-md fa-fw"></i></label></td>
            <td><input type="text"  id="JobTitle" placeholder="Jobtitle Name" name="jobtitle" value="<?=@$_POST['jobtitle']?>" class="form-control"></td>
          </tr>

          <tr>
            <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Date Added"><i class="fa fa-calendar fa-fw"></i></label></td>
            <td><select class="form-control" name="isverified">
              <option value="">Select Status</option>
              <option value="false" <?=isset($_POST['isverified']) && $_POST['isverified'] == 'false' ? 'selected' : ''?>>Inactive</option>
              <option value="true" <?=isset($_POST['isverified']) && $_POST['isverified'] == 'true' ? 'selected' : ''?>>Active</option>
            </select></td>
          </tr>
          <tr>
            <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Date Added"><i class="fa fa-money fa-fw"></i></label></td>
            <td><select class="form-control" name="userprice">
              <option value="">Select Price</option>
              <option value="Price1" <?=isset($_POST['userprice']) && $_POST['userprice'] == 'Price1' ? 'selected' : ''?>>Price 1</option>
              <option value="Price2" <?=isset($_POST['userprice']) && $_POST['userprice'] == 'Price2' ? 'selected' : ''?>>Price 2</option>
              <option value="Price3" <?=isset($_POST['userprice']) && $_POST['userprice'] == 'Price3' ? 'selected' : ''?>>Price 3</option>
              <option value="Price4" <?=isset($_POST['userprice']) && $_POST['userprice'] == 'Price4' ? 'selected' : ''?>>Price 4</option>
            </select></td>
          </tr>
          <tr>
          <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Date Added"><i class="fa fa-users fa-fw"></i></label></td>
            <td>          
            <select class="form-control" name="user_group">
              <option value="">Select user group</option>
              <option value="premiumuser" <?=isset($_POST['user_group']) && $_POST['user_group'] == 'premiumuser' ? 'selected' : ''?>>Premium user</option>
              <option value="reguleruser" <?=isset($_POST['user_group']) && $_POST['user_group'] == 'reguleruser' ? 'selected' : ''?>>Reguler user</option>             
            </select>
            <!-- <b>Premium User</b><input id="premiumusercheck" type="checkbox" value="1"  <?//=isset($_POST['premiumuser']) && $_POST['premiumuser'] == '1' ? 'checked="checked"' : ''?> style="margin-left: 5px;" name="premiumuser" /> -->
          </td>
          </tr>
          <!-- <tr>
            <td style="width: 1%;"></td>
            <td><b>Register Guest User</b><input id="guestusercheck" type="checkbox" value="1"  <?//=isset($_POST['guestuser']) && $_POST['guestuser'] == '1' ? 'checked="checked"' : ''?> style="margin-left: 5px;" name="guestuser" /></td>
          </tr> -->

           <tr>
            <td style="width: 1%;"></td>
            <td><b>Coupan Code</b><input type="checkbox" value="1"  <?=isset($_POST['coupan']) && $_POST['coupan'] == '1' ? 'checked="checked"' : ''?> style="margin-left: 5px;" name="coupan" /></td>
          </tr>
           <tr>
            <td style="width: 1%;"></td>
            <td><b>Credit</b><input type="checkbox" value="1"  <?=isset($_POST['credit']) && $_POST['credit'] == '1' ? 'checked="checked"' : ''?> style="margin-left: 5px;" name="credit" /></td>
          </tr>


          <tr>
            <td><strong></strong></td>
            <td class="text-center">
              <input type="hidden" name="pviewcount" placeholder="" value="500" class="form-control">
              <button type="submit" name="submit" class="btn btn-lg btn-default btn-adduser">Save</button>
  <a href="<?=base_url('admin/listuser')?>" class="btn btn-lg btn-default">Cancel</a>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    </div>
  </div>
  <div class="col-md-8">
    <?php if (!empty($_POST) && !empty($_POST['id'])) {?>
    <a href="javascript:void(0);" data-toggle="modal" data-target="#add_useraddress" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add Address</a>
    <div class="panel panel-default" style="display: inline-block;">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-map-marker fa-fw"></i> Customer Billing & Shipping Address</h3>
      </div>
      <!-- <table class="table">
        <tbody>
          <tr>
            <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Date Added"><i class="fa fa-calendar fa-fw"></i></button></td>
            <td><textarea name="address" rows="5" class="form-control"><?=@$_POST['address']?></textarea></td>
          </tr>
        </tbody>
      </table> -->
      <?php if (!empty($_POST['Addresslist'])) {?>
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Address Type</th>
                    <th>Company Name</th>                                        
                    <th>Address</th>
                    <th>GST Number</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($_POST['Addresslist'] as $key => $value) {?>
                  <tr>
                    <td class="relative"><?=$value['addresstype'];?></td>
                    <td><?=$value['companyname'];?></td>
                    <td><?=$value['address'];?></td>
                    <td><?=$value['gstnumber'];?></td>
                    <td><a href="javascript:void(0);" data-toggle="modal" data-target="#edit_useraddress<?=$value['id'];?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span></a>
                            <a href="<?=base_url('admin/shopcategories/?delete=' . $value['id'])?>" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></a></td>
                  </tr>
                  <div class="modal fade" id="edit_useraddress<?=$value['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Address</h4>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Address Type</label>
                                <select name="addresstype" class="form-control">
                                  <option value="">Select Type</option>
                                  <option value="Billing" <?=$value['addresstype'] == 'Billing' ? 'selected=""' : ''?>>Billing</option>
                                  <option value="Shipping" <?=$value['addresstype'] == 'Shipping' ? 'selected=""' : ''?>>Shipping</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" oninvalid="this.setCustomValidity('Please Enter Category Name')"
 oninput="setCustomValidity('')" name="companyname" value="<?=$value['companyname']?>" class="form-control">
                            </div>                          
                            <div class="form-group">                              
                                <label id='add_gst'>GST Number / PAN Number</label>                           
                                <input type="text" oninvalid="this.setCustomValidity('Please Enter Category Name')"
 oninput="setCustomValidity('')" name="gstnumber" value="<?=$value['gstnumber']?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea oninvalid="this.setCustomValidity('Please Enter address')" oninput="setCustomValidity('')" name="address" class="form-control"><?=$value['address']?></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="editaddressid" value="<?=$value['id'];?>">
                        <input type="hidden" name="userid" value="<?=$_POST['id']?>">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="editsubmit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
                  <?php }?>
                </tbody>
            </table>

        <?php }?>
    </div>
    <?php }?>
  </div>



<div class="modal fade" id="add_useraddress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Address</h4>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Address Type</label>
                                <select name="addresstype" class="form-control">
                                  <option value="">Select Type</option>
                                  <option value="Both">Both</option>
                                  <option value="Billing">Billing</option>
                                  <option value="Shipping">Shipping</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" oninvalid="this.setCustomValidity('Please Enter Category Name')"
 oninput="setCustomValidity('')" name="companyname" value="" class="form-control">
                            </div>                          
                            <!-- <div class="form-group">
                                <label>With GST / Without GST</label>
                                <select name="with_gst" class="form-control">                                  
                                  <option value="1">With GST</option>
                                  <option value="0">Without GST</option>                                 
                                </select>
                            </div> -->
                            <div class="form-group">
                                <label id='add_gst'>GST Number / PAN Number</label>
                                <input type="text" oninvalid="this.setCustomValidity('Please Enter Category Name')"
 oninput="setCustomValidity('')" name="gstnumber" value="" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea oninvalid="this.setCustomValidity('Please Enter address')" oninput="setCustomValidity('')" name="address" value="" class="form-control"></textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="userid" value="<?=$_POST['id']?>">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="addresssubmit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

  <?php if (isset($_POST['isverified'])) {?>
  <!-- <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-cog"></i> Status</h3>
      </div>
      <table class="table">
        <tbody>
          <tr>
            <td><strong>Status</strong></td>
            <td class="text-center">
              <select class="selectpicker" name="isverified">
              <option value="">Select Status</option>
              <option value="false" <?=isset($_POST['isverified']) && $_POST['isverified'] == 'false' ? 'selected' : ''?>>Inactive</option>
              <option value="true" <?=isset($_POST['isverified']) && $_POST['isverified'] == 'true' ? 'selected' : ''?>>Active</option>
            </select>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div> -->
  <?php }?>
</div>



<div class="container">
  <div class="row"> </div>
</div>
<!-- <form method="POST" action="" enctype="multipart/form-data">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-6">
      <div class="form-group">
        <label>Name </label>
        <input type="text" required id="Fullname" name="name" value="<?=@$_POST['name']?>" class="form-control">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-lg-6">
      <div class="form-group">
        <label>Mobilenumber</label>
        <input type="text" required id="Phonenumber" name="mobilenumber" value="<?=@$_POST['mobilenumber']?>" class="form-control">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-lg-6">
      <div class="form-group">
        <label>Email-id </label>
        <input type="text" required id="Emailid" name="emailid" value="<?=@$_POST['emailid']?>" class="form-control">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-lg-6">
      <div class="form-group for-shop">
        <?php /*?><label>Product View Count</label><?php */?>
        <input type="hidden" name="pviewcount" placeholder="" value="500" class="form-control">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-lg-12">
      <div class="form-group">
        <label for="description">Address</label>
        <textarea name="address" rows="5" class="form-control"><?=@$_POST['address']?>
</textarea>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-lg-6">
    	<div class="col-xs-12 col-sm-12 col-lg-12">
          <?php if (isset($_POST['isverified'])) {?>
          <div class="form-group for-shop">
            <label>User Status</label>
            <select class="selectpicker" name="isverified">
              <option value="">Select Status</option>
              <option value="false" <?=isset($_POST['isverified']) && $_POST['isverified'] == 'false' ? 'selected' : ''?>>Inactive</option>
              <option value="true" <?=isset($_POST['isverified']) && $_POST['isverified'] == 'true' ? 'selected' : ''?>>Active</option>
            </select>
          </div>
          <?php }?>
      	</div>
        <div class="col-xs-12 col-sm-12 col-lg-12">
          <div class="form-group for-shop">
            <?php /*?><label>Premium User</label><?php */?>
            <input type="hidden" value="1"  <?=isset($_POST['premiumuser']) && $_POST['premiumuser'] == '1' ? 'checked="checked"' : ''?> style="margin-left: 5px;" name="premiumuser" />
          </div>
      	</div>
    </div>


    <div class="col-xs-12 col-sm-12 col-lg-6" style="display:none;">
      <div class="contacts">
        <label>Firm Name:</label>
        <?php
if ($id != 0 && $id != '') {
	$this->db->select('user_firmlist.*');
	$this->db->where('user_firmlist.userid', $id);
	$query = $this->db->get('user_firmlist');

	$numItems = count($query->result_array());
	if ($numItems > 0) {
		$i = 0;
		foreach ($query->result_array() as $key => $value) {
			?>
          <?php

			if (++$i === $numItems) {?>
    			<div class="form-group multiple-form-group input-group">
          <input type="text" name="firmname[]" class="form-control" value="<?=$value['firmname'];?>">
          <span class="input-group-btn">
          <button type="button" class="btn btn-success btn-add">+</button>
          </span> </div>
  		  <?php } else {?>

		  <div class="form-group multiple-form-group input-group">
          <input type="text" name="firmname[]" class="form-control" value="<?=$value['firmname'];?>">
          <span class="input-group-btn">
          <button type="button" class="btn btn-danger btn-remove">-</button>
          </span> </div>

		  <?php }?>

		<?php }} else {?>
		<div class="form-group multiple-form-group input-group">
          <input type="text" name="firmname[]" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-success btn-add">+</button>
          </span> </div>
		<?php }} else {?>
        <div class="form-group multiple-form-group input-group">
          <input type="text" name="firmname[]" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-success btn-add">+</button>
          </span> </div>
		<?php }?>
      </div>
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-lg btn-default btn-adduser">Save</button>
  <?php if ($this->uri->segment(3) !== null) {?>
  <a href="<?=base_url('admin/listuser')?>" class="btn btn-lg btn-default">Cancel</a>
  <?php }?>
</form> -->

<!-- <?php if (!empty($_POST['Addresslist'])) {?>

<div class="row">
<hr>
<div class="col-sm-12 col-md-12 col-lg-12">
<table class="table table-bordered">
    <thead>
      <tr>
        <th>Address Type</th>
        <th>Company Name</th>
        <th>Address</th>
        <th>GST Number</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($_POST['Addresslist'] as $key => $value) {?>
      <tr>
        <td class="relative"><?=$value['addresstype'];?></td>
        <td><?=$value['companyname'];?></td>
        <td><?=$value['address'];?></td>
        <td><?=$value['gstnumber'];?></td>
      </tr>
      <?php }?>
    </tbody>
</table>
</div>
</div>
<?php }?> -->

<!-- Chat Messanger -->
<!-- <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-info-circle"></i> Chat Message </h3>
  </div>
  <div class="panel-body">
    <table class="table table-bordered" cellpadding="4">
      <thead>
        <tr>
          <td class="text-center">Username</td>
          <td class="text-left">Message</td>
          <td class="text-center">Audio</td>
          <td class="text-center">Date & Time</td>
        </tr>
      </thead>
      <tbody>
          <?php
// echo '<pre>';
// print_r($_POST['Chatcomment']);
?>
          <?php
if (isset($_POST['Chatcomment'])) {
	foreach ($_POST['Chatcomment'] as $key => $value) {
		$namemsg = '';
		if ($value['usertype'] == 'admin') {
			$test = $this->db->select('*')->where('id', $value['sender_id'])->get('users')->row();
			$namemsg = $test->username . ' (admin)';
		} else {
			$namemsg = @$_POST['name'];
		}

		$audiofile = !empty($value['audiofile']) ? base_url('attachments/audiofile/' . $value['audiofile']) : '';
		?>
                <tr>
                  <td class="text-left"><?=$namemsg;?></td>
                  <td class="text-left"><?=$value['message'];?></td>
                  <td class="text-left">
                    <?php
if (isset($audiofile) && $audiofile != '') {
			echo '<audio controls="">
                        <source src="' . $audiofile . '" type="audio/mpeg">
                      </audio>';
		}?>
                  </td>
                  <td class="text-left"><?=date('d-m-Y h:i A', $value['timeanddate']);?></td>
                </tr>
                <?php }}?>
              </tbody>
            </table></td>
        </tr>
      </tbody>
    </table>

    <div class="row">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"> Send Message</h3>
          </div>
          <form style="padding: 10px 20px;" method="post">
          <div class="form-group">
          <input type="hidden" name="sender_id" value="1" />
          <input type="hidden" name="receiver_id" value="<?=$id;?>" />
          <textarea class="form-control" name="commentmsg"></textarea>
          </div>
          <button type="submit" name="sendmessagechat" class="btn btn-primary">Send</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div> -->


<!-- Modal Upload More Images -->

<!-- virtualProductsHelp -->

<style>
* {
  .border-radius(0) !important;
}

#field {
    margin-bottom:20px;
}

input#field1 {
    display: inline-block;
    height: 30px;
    background-color: #ffffff;
    border: 1px solid #cccccc;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
    -webkit-transition: border linear .2s, box-shadow linear .2s;
    -moz-transition: border linear .2s, box-shadow linear .2s;
    -o-transition: border linear .2s, box-shadow linear .2s;
    transition: border linear .2s, box-shadow linear .2s;
    border-radius: 0 4px 4px 0;
    -webkit-border-radius: 4px 0 0 4px;
}

button#b1 {
    margin-left: -1px;
    padding: 4px 12px;
}
</style>
<script>

$( document ).ready(function() {
  $('#premiumusercheck').click(function() {
    $('#guestusercheck').prop('checked', false);
  });
  $('#guestusercheck').click(function() {
    $('#premiumusercheck').prop('checked', false);
  });
});



(function ($) {
    $(function () {

        var addFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).closest('.form-group');
            var $multipleFormGroup = $formGroup.closest('.multiple-form-group');
            var $formGroupClone = $formGroup.clone();

            $(this)
                .toggleClass('btn-success btn-add btn-danger btn-remove')
                .html('–');

            $formGroupClone.find('input').val('');
            $formGroupClone.find('.concept').text('Phone');
            $formGroupClone.insertAfter($formGroup);

            var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            if ($multipleFormGroup.data('max') <= countFormGroup($multipleFormGroup)) {
                $lastFormGroupLast.find('.btn-add').attr('disabled', true);
            }
        };

        var removeFormGroup = function (event) {
            event.preventDefault();

            var $formGroup = $(this).closest('.form-group');
            var $multipleFormGroup = $formGroup.closest('.multiple-form-group');

            var $lastFormGroupLast = $multipleFormGroup.find('.form-group:last');
            if ($multipleFormGroup.data('max') >= countFormGroup($multipleFormGroup)) {
                $lastFormGroupLast.find('.btn-add').attr('disabled', false);
            }

            $formGroup.remove();
        };

        var selectFormGroup = function (event) {
            event.preventDefault();

            var $selectGroup = $(this).closest('.input-group-select');
            var param = $(this).attr("href").replace("#","");
            var concept = $(this).text();

            $selectGroup.find('.concept').text(concept);
            $selectGroup.find('.input-group-select-val').val(param);

        }

        var countFormGroup = function ($form) {
            return $form.find('.form-group').length;
        };

        $(document).on('click', '.btn-add', addFormGroup);
        $(document).on('click', '.btn-remove', removeFormGroup);
        $(document).on('click', '.dropdown-menu a', selectFormGroup);

    });
})(jQuery);
</script>