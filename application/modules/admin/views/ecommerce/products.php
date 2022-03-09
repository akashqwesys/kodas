
<div>
<?php
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

<?php
if ($this->session->flashdata('result_delete')) {
?>
  <hr>
  <div class="alert alert-success">
    <?= $this->session->flashdata('result_delete') ?>
  </div>
  <hr>
<?php
}
?>

  <h1><img src="<?= base_url('assets/imgs/products-img.png') ?>" class="header-img" style="margin-top:-2px;"> Products <a href="<?= base_url('admin/publish'); ?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;float:right"><b>+</b> Add Product</a></h1>
  <hr>  
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table id="table" class="table dt-responsive nowrap">
          <thead>
            <tr>
            <th>No</th>
            <th>Image</th>
            <th>Title</th>
            <th>Box Wholsell Price</th>
            <th>Thely Wholsell Price</th>
            <th>Pcs</th>
            <th>Guest Count</th>
            <th>User Count</th>
            <th>Status</th>
            <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->session->set_flashdata('result_publish', ''); ?>
<?php $this->session->set_flashdata('result_delete', ''); ?>