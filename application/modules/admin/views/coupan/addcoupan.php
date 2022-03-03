<h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> Add COUPON</h1>
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
if ($this->session->flashdata('add_attributesgroup')) {
?>
  <hr>
  <div class="alert alert-danger">
    <?= $this->session->flashdata('add_attributesgroup') ?>
    <?php $this->session->set_flashdata('add_attributesgroup', ''); ?>
  </div>
  <hr>
<?php
}
?>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-user"></i> COUPON</h3>
      </div>
      <form method="POST" action="" enctype="multipart/form-data">
        <table class="table">
          <tbody>
            <tr>
              <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Name"><i class="fa fa-user fa-fw"></i></label></td>
              <td><input type="text" required id="name" name="name" placeholder="Name" value="<?= @$_POST['name'] ?>" class="form-control"></td>
            </tr>
            <tr>
              <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Code"><i class="fa fa-user fa-fw"></i></label></td>
              <td><input type="text" required id="code" name="code" placeholder="Code" value="<?= @$_POST['code'] ?>" class="form-control"></td>
            </tr>
            <tr>
              <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="enddate"><i class="fa fa-user fa-fw"></i></label></td>
              <td>
              <input type="text" required id="enddate" name="enddate" placeholder="Enter End Date" autocomplete="off" class="form-control datepicker">                
              </td>
            </tr> 
            
            <tr>
              <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="discounttype"><i class="fa fa-user fa-fw"></i></label></td> 
              <td>              
              <select class="form-control" name="discounttype" id="discounttypeselect" class="form-control">
              <option value="">Select Discount Type</option>
              <option value="Percentage">Percentage</option>
              <option value="Amount">Amount</option>
            </select></td>
            </tr>            
            <tr>
              <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="discount"><i class="fa fa-user fa-fw"></i></label></td>
              <td>
              <input type="number" required id="discount" name="discount" placeholder="Enter Discount" class="form-control">
              </td>
            </tr>            
            <tr>
              <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="isactive"><i class="fa fa-calendar fa-fw"></i></label></td>
              <td><select class="form-control" name="isactive">
                  <option value="">Select Status</option>
                  <option value="0">Inactive</option>
                  <option value="1">Active</option>
                </select>
              </td>
            </tr>
            <tr>
              <td><strong></strong></td>
              <td class="text-center">
                <input type="hidden" name="pviewcount" placeholder="" value="500" class="form-control">                
                <a href="<?= base_url('admin/listcoupan') ?>" class="btn btn-lg btn-default">Cancel</a>
                <button type="submit" name="submit" class="btn btn-success btn-addattributesgroup">Save</button>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
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