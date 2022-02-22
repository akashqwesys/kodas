
<div>
<?php
if ($this->session->flashdata('add_packagingtype')) {
?>
  <hr>
  <div class="alert alert-success">
    <?= $this->session->flashdata('add_packagingtype') ?>
  </div>
  <hr>
<?php
}
?>
<?php
if ($this->session->flashdata('edit_packagingtype')) {
?>
  <hr>
  <div class="alert alert-success">
    <?= $this->session->flashdata('edit_packagingtype') ?>
  </div>
  <hr>
<?php
}
?>
  <h1><img src="<?= base_url('assets/imgs/list-user.png') ?>" class="header-img" style="margin-top:-2px;"> Packaging type</h1>
  <hr>
  <a href="<?= base_url('admin/addpackagingtype'); ?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add Packaging type</a>
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table id="table" class="table dt-responsive nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>PCS</th>                           
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->session->set_flashdata('add_packagingtype', ''); ?>
<?php $this->session->set_flashdata('edit_packagingtype', ''); ?>