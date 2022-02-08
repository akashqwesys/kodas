<script src="<?=base_url('assets/ckeditor/ckeditor.js')?>"></script>

<h1><!-- <img src="<?=base_url('assets/imgs/admin-user.png')?>" class="header-img" style="margin-top:-3px;">  -->Add Coupon</h1>
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
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-file"></i>  Coupon Details</h3>
      </div>
      <form method="POST" action="" enctype="multipart/form-data">
      <table class="table">
        <tbody>
          <tr>
            <td style="width: 5%;"><a data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Name"><i class="fa fa-user fa-fw"></i></a></td>
            <td><input type="text" required id="name" name="name" placeholder="Enter Name" autocomplete="off" value="<?=!empty($singlecoupanlist['name']) ? $singlecoupanlist['name'] : '';?>" class="form-control"></td>

            <td style="width: 5%;"><a data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Coupon Code"><i class="fa fa-clipboard fa-fw"></i></a></td>
            <td><input type="text" required id="code" name="code" placeholder="Enter Code" autocomplete="off" value="<?=!empty($singlecoupanlist['code']) ? $singlecoupanlist['code'] : '';?>" class="form-control"></td>

          <!--   <td style="width: 5%;"><a data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Coupon Code Limit"><i class="fa fa-sort-numeric-asc fa-fw"></i></a></td>
            <td><input type="number" required id="codelimit" name="codelimit" placeholder="Enter Code Limit" value="<?=!empty($singlecoupanlist['codelimit']) ? $singlecoupanlist['codelimit'] : '';?>" class="form-control"></td> -->
              <td style="width: 5%;"><a data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Coupon End Date"><i class="fa fa-calendar fa-fw"></i></a></td>
            <td>
              <input type="text" required id="enddate" name="enddate" placeholder="Enter End Date" autocomplete="off" value="<?=!empty($singlecoupanlist['enddate']) ? date('d-m-Y', $singlecoupanlist['enddate']) : '';?>" class="form-control datepicker">
            </td>

          </tr>
          <tr>
            <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Discount Type"><i class="fa fa-sort-desc fa-fw"></i></label></td>
            <td><select class="selectpicker" name="discounttype" id="discounttypeselect">
              <option value="">Select Discount Type</option>
              <option value="Percentage" <?=isset($singlecoupanlist['discounttype']) && $singlecoupanlist['discounttype'] == 'Percentage' ? 'selected' : ''?>>Percentage</option>
              <option value="Amount" <?=isset($singlecoupanlist['discounttype']) && $singlecoupanlist['discounttype'] == 'Amount' ? 'selected' : ''?>>Amount</option>
            </select></td>

               <td style="width: 5%;"><a data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Coupon Discount Amount"><i class="fa fa-percent fa-fw"></i></a></td>
            <td><input type="number" required id="discount" name="discount" placeholder="Enter Discount" value="<?=!empty($singlecoupanlist['discount']) ? $singlecoupanlist['discount'] : '';?>" class="form-control"></td>


            <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Coupon Status"><i class="fa fa-user-times fa-fw"></i></label></td>
            <td><select class="selectpicker" name="isactive">
              <option value="">Select Status</option>
              <option value="0" <?=isset($singlecoupanlist['isactive']) && $singlecoupanlist['isactive'] == '0' ? 'selected' : ''?>>Inactive</option>
              <option value="1" <?=isset($singlecoupanlist['isactive']) && $singlecoupanlist['isactive'] == '1' ? 'selected' : ''?>>Active</option>
            </select></td>

            <td><strong></strong></td>
            <td class="text-center">
              <input type="hidden" name="pviewcount" placeholder="" value="500" class="form-control">
              <?php if (!empty($singlecoupanlist)) {?>
            <input type="hidden" name="updateid" value="<?=!empty($singlecoupanlist['id']) ? $singlecoupanlist['id'] : '';?>">
          <button type="submit" class="btn btn-default" name="update" value="update">Update</button>
            <?php } else {?>
               <button type="submit" name="submit" class="btn btn-lg btn-default btn-addcoupan">Save</button>
            <?php }?>


  <?php if ($this->uri->segment(3) !== null) {?>
  <a href="<?=base_url('admin/listabout')?>" class="btn btn-lg btn-default">Cancel</a>
  <?php }?>
            </td>
          </tr>
        </tbody>
      </table>
    </form>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
  <?php if ($coupanlist) {
	?>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Coupon Code</th>
            <!-- <th>Limit</th> -->
            <th>End Date</th>
            <th>Discount</th>
            <th>Status</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
foreach ($coupanlist as $row) {
		?>
          <tr>
            <td><?=$row->name;?></td>
            <td><?=$row->code;?></td>
            <!-- <td><?=$row->codelimit;?></td> -->
            <td><?=date('d-m-Y', $row->enddate);?></td>
            <?php
if ($row->discounttype == 'Percentage') {
			$type = '%';
		} else {
			$type = '';
		}?>
            <td><?=$row->discount . ' ' . $type;?></td>
            <td><?php
if ($row->isactive == '1') {
			$color = 'label-success';
			$status = 'Active';
		}
		if ($row->isactive == '0') {
			$color = 'label-danger';
			$status = 'Deactivate';
		}
		?>
        <span style="font-size:12px;" class="label <?=$color;?>">
              <?=$status;?>
              </span> <td>
              <div class="pull-right"> <a href="<?=base_url('admin/addcoupan/?edit=' . $row->id)?>" class="btn btn-info">Edit</a> <a href="<?=base_url('admin/addcoupan?delete=' . $row->id)?>"  class="btn btn-danger confirm-delete">Delete</a> </div>
            </td>
          </tr>
          <?php
}
	?>
        </tbody>
      </table>
    </div>
    <?=$links_pagination?>
  </div>
  <?php
} else {
	?>
  <div class ="alert alert-info">No Coupon found!</div>
  <?php }?>
</div>

<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script>
    $(document).ready(function(){

      $('#discounttypeselect').change(function(){
        var discount = $('#discount');
        var selected = $("#discounttypeselect option:selected" ).text();
        if(selected == 'Percentage'){
          discount.attr('max','99');
        }else if(selected == 'Amount'){
          discount.removeAttr('max');
        }
      })

      var date = new Date();
date.setDate(date.getDate());
      var date_input=$('input[name="enddate"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'dd-mm-yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
         startDate: date
      };
      date_input.datepicker(options);
    })
</script>