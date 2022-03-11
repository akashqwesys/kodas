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
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-user"></i> Attributes</h3>
      </div>

<br>
      <form class="form-horizontal" method="POST" action="">
    <div class="form-group">
      <label class="control-label col-sm-2 col-md-2" for="email">User:</label>
      <div class="col-sm-10 col-md-4">
        <select class="selectpicker form-control show-tick show-menu-arrow" data-live-search="true" name="connectedProduct">
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
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2 col-md-2" for="email">Product:</label>
      <div class="col-sm-10 col-md-4">
      <select class="selectpicker form-control show-tick show-menu-arrow" data-live-search="true" name="connectedProduct">
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
        <input type="text" class="form-control" id="pwd" placeholder="Enter Quantity" name="Qty">
      </div>
      <div class="col-sm-10 col-md-2">          
        <select class="selectpicker form-control show-tick show-menu-arrow" data-live-search="true" name="ProductType">            
          <option value="box">Box</option>
          <option value="theli">Thely</option>                                          
        </select>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
      <a href="<?= base_url('admin/listattributes') ?>" class="btn btn-danger">Cancel</a>
      <button type="submit" name="submit" class="btn btn-success btn-addattributes">Save</button>
      </div>
    </div>
  </form>           
    </div>
  </div>