
<div>
<?php
if ($this->session->flashdata('add_coupan')) {
?>
  <hr>
  <div class="alert alert-success">
    <?= $this->session->flashdata('add_coupan') ?>
  </div>
  <hr>
<?php
}
?>
<?php
if ($this->session->flashdata('edit_coupan')) {
?>
  <hr>
  <div class="alert alert-success">
    <?= $this->session->flashdata('edit_coupan') ?>
  </div>
  <hr>
<?php
}
?>
  <h1>Coupon<a href="<?= base_url('admin/addcoupan'); ?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;float:right"><b>+</b> Add Coupon</a></h1>
  <hr>
  
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table id="table" class="table dt-responsive nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Code</th>                           
              <th>Code limit</th>
              <th>End Date</th>
              <th>Discount</th>
              <th>Discount Type</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->session->set_flashdata('add_coupan', ''); ?>
<?php $this->session->set_flashdata('edit_coupan', ''); ?>