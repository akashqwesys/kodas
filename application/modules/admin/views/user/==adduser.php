<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>

<h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> Add User</h1>
<hr>
<?php
$timeNow = time();
if (validation_errors()) {
    ?>
<hr>
<div class="alert alert-danger">
  <?= validation_errors() ?>
</div>
<hr>
<?php
}
if ($this->session->flashdata('result_publish')) {
    ?>
<hr>
<div class="alert alert-success">
  <?= $this->session->flashdata('result_publish') ?>
</div>
<hr>
<?php
}
?>
<div class="container">
  <div class="row"> </div>
</div>
<form method="POST" action="" enctype="multipart/form-data">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-lg-6">
      <div class="form-group">
        <label>Name </label>
        <input type="text" required id="Fullname" name="name" value="<?= @$_POST['name'] ?>" class="form-control">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-lg-6">
      <div class="form-group">
        <label>Mobilenumber</label>
        <input type="text" required id="Phonenumber" name="mobilenumber" value="<?= @$_POST['mobilenumber'] ?>" class="form-control">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-lg-6">
      <div class="form-group">
        <label>Email-id </label>
        <input type="text" required id="Emailid" name="emailid" value="<?= @$_POST['emailid'] ?>" class="form-control">
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
        <textarea name="address" rows="5" class="form-control"><?= @$_POST['address'] ?>
</textarea>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-lg-6">
    	<div class="col-xs-12 col-sm-12 col-lg-12">
          <div class="form-group for-shop">
            <label>User Status</label>
            <select class="selectpicker" name="isverified">
              <option value="">Select Status</option>
              <option value="false" <?= isset($_POST['isverified']) && $_POST['isverified'] == 'false' ? 'selected' : '' ?>>Inactive</option>
              <option value="true" <?= isset($_POST['isverified']) && $_POST['isverified'] == 'true' ? 'selected' : '' ?>>Active</option>
            </select>
          </div>
      	</div>
        <div class="col-xs-12 col-sm-12 col-lg-12">
          <div class="form-group for-shop">
            <label>Premium User</label>
            <input type="checkbox" value="1"  <?= isset($_POST['premiumuser']) && $_POST['premiumuser'] == '1' ? 'checked="checked"' : '' ?> style="margin-left: 5px;" name="premiumuser" />            
          </div>
      	</div>
    </div>
    
    
    <div class="col-xs-12 col-sm-12 col-lg-6">
      <div class="contacts">
        <label>Firm Name:</label>
        <?php 
		if($id != 0 && $id != ''){
		$this->db->select('user_firmlist.*');
        $this->db->where('user_firmlist.userid', $id);
        $query = $this->db->get('user_firmlist');
		
		$numItems = count($query->result_array());
		if($numItems > 0){
		$i = 0;
		foreach($query->result_array() as $key => $value){?>
          <?php 
		  
		  if(++$i === $numItems) {?>
    			<div class="form-group multiple-form-group input-group">          
          <input type="text" name="firmname[]" class="form-control" value="<?=$value['firmname'];?>">
          <span class="input-group-btn">
          <button type="button" class="btn btn-success btn-add">+</button>
          </span> </div>
  		  <?php }else{?>
		  
		  <div class="form-group multiple-form-group input-group">          
          <input type="text" name="firmname[]" class="form-control" value="<?=$value['firmname'];?>">
          <span class="input-group-btn">
          <button type="button" class="btn btn-danger btn-remove">-</button>
          </span> </div>
		  
		  <?php } ?>
          
		<?php } }else{?> 
		<div class="form-group multiple-form-group input-group">          
          <input type="text" name="firmname[]" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-success btn-add">+</button>
          </span> </div>
		<?php } }else{?>		
        <div class="form-group multiple-form-group input-group">          
          <input type="text" name="firmname[]" class="form-control" />
          <span class="input-group-btn">
          <button type="button" class="btn btn-success btn-add">+</button>
          </span> </div>
		<?php } ?>
      </div>
    </div>
  </div>
  <button type="submit" name="submit" class="btn btn-lg btn-default btn-adduser">Save</button>
  <?php if ($this->uri->segment(3) !== null) { ?>
  <a href="<?= base_url('admin/listuser') ?>" class="btn btn-lg btn-default">Cancel</a>
  <?php } ?>
</form>
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