<h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> Add Order</h1>
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
if ($this->session->flashdata('add_attributes')) {
?>
  <hr>
  <div class="alert alert-danger">
    <?= $this->session->flashdata('add_attributes') ?>
    <?php $this->session->set_flashdata('add_attributes', ''); ?>
  </div>
  <hr>
<?php
}
?>




<select class="product_select form-control show-tick show-menu-arrow mainpicker" style="display:none" data-live-search="true" name="ItemId[]">          
          <?php foreach ($conn_products as $conn_product) {                     
            ?>
            <option value="<?=$conn_product['p_id']?>">
            <?php
              echo $conn_product['title'];
            ?>
              </option>
              <?php } ?>
        </select>

<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-user"></i> Order</h3>
      </div>
<br>
      <form class="form-horizontal" method="POST" action="">
    <div class="form-group">
      <label class="control-label col-sm-2 col-md-2" for="email">User:</label>
      <div class="col-sm-10 col-md-4">
        <select class="selectpicker form-control show-tick show-menu-arrow" data-live-search="true" id="UserId" name="UserId" required>
        <option value="0">Select User</option>
          <?php foreach ($users as $user) {                     
        ?>
        <option value="<?=$user['id']?>">
        <?php
          echo $user['name'];
        ?>
          </option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="form-group block block1">
      <label class="control-label col-sm-2 col-md-2 lbl_append" for="ItemId">Product:</label>
      <div class="col-sm-10 col-md-4">
        <select class="selectpicker product_select form-control show-tick show-menu-arrow" data-live-search="true" name="ItemId[]" required>          
          <?php foreach ($conn_products as $conn_product) {                     
            ?>
            <option value="<?=$conn_product['p_id']?>">
            <?php
              echo $conn_product['title'];
            ?>
              </option>
              <?php } ?>
        </select>
      </div>
      <div class="col-sm-10 col-md-2">          
        <input type="text" class="form-control" placeholder="Enter Quantity" name="Qty[]" required>
      </div>
      <div class="col-sm-10 col-md-2">          
        <select class="form-control show-tick show-menu-arrow" name="ProductType[]" required>            
          <option value="box">Box</option>
          <option value="theli">Thely</option>                                          
        </select>        
      </div>            
      <div class='col-sm-10 col-md-2 block_img_div' style="display:none;">
        <img src='<?php echo site_url('assets/imgs/cancel.png') ?>' style='width:30px' class='block_img'>
      </div>
    </div> 
    



    <div class="form-group">
      <label class="control-label col-sm-2 col-md-2" for="email">Shipping:</label>
      <div class="col-sm-10 col-md-4">
        <select class="form-control show-tick show-menu-arrow" name="ShipId" id="ShipId" required>                     
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2 col-md-2" for="email">Billing:</label>
      <div class="col-sm-10 col-md-4">
        <select class="form-control show-tick show-menu-arrow" name="BillId" id="BillId" required>                     
        </select>
      </div>
    </div>

    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
      <a href="<?= base_url('admin/orders') ?>" class="btn btn-danger">Cancel</a>
      <button type="button" class="btn btn-info" id="addBlock">Add block</button>
      <button type="submit" name="submit" class="btn btn-success">Save</button>
      </div>
    </div>
  </form>           
    </div>
  </div>