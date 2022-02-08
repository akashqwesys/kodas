
<div>
<?php
if ($this->session->flashdata('add_attributes')) {
?>
  <hr>
  <div class="alert alert-success">
    <?= $this->session->flashdata('add_attributes') ?>
  </div>
  <hr>
<?php
}
?>
<?php
if ($this->session->flashdata('edit_attributes')) {
?>
  <hr>
  <div class="alert alert-success">
    <?= $this->session->flashdata('edit_attributes') ?>
  </div>
  <hr>
<?php
}
?>
  <h1><img src="<?= base_url('assets/imgs/list-user.png') ?>" class="header-img" style="margin-top:-2px;"> All Attributes</h1>
  <hr>
  <a href="<?= base_url('admin/addattributes'); ?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add Attributes</a>
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table id="table" class="table dt-responsive nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Title</th>
              <th>Sort order</th>
              <th>Group</th>             
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->session->set_flashdata('add_attributes', ''); ?>
<?php $this->session->set_flashdata('edit_attributes', ''); ?>