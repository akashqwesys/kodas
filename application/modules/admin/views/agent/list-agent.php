
<div>
<?php
if ($this->session->flashdata('add_agent')) {
?>
  <hr>
  <div class="alert alert-success">
    <?= $this->session->flashdata('add_agent') ?>
  </div>
  <hr>
<?php
}
?>
<?php
if ($this->session->flashdata('edit_agent')) {
?>
  <hr>
  <div class="alert alert-success">
    <?= $this->session->flashdata('edit_agent') ?>
  </div>
  <hr>
<?php
}
?>
  <h1><img src="<?= base_url('assets/imgs/list-user.png') ?>" class="header-img" style="margin-top:-2px;"> All Agent</h1>
  <hr>
  <a href="<?= base_url('admin/addagent'); ?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add Agent</a>
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table id="table" class="table dt-responsive nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Mobile</th>
              <th>Address</th>
              <th>Email</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->session->set_flashdata('add_agent', ''); ?>
<?php $this->session->set_flashdata('edit_agent', ''); ?>