
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
  <h1><img src="<?= base_url('assets/imgs/list-user.png') ?>" class="header-img" style="margin-top:-2px;"> Agents <a href="<?= base_url('admin/addagent'); ?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;float:right"><b>+</b> Add Agent</a></h1>
  <hr>
  <form class="form-horizontal" action="<?=base_url('admin/addbulkagent');?>" role="form" method="post" enctype="multipart/form-data">
    <div class="col-md-2">
      <div class="form-group">
        <div class="col-sm-4">
          <input type="file" id="csvfile" name="csvfile" required>
        </div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <div class="col-sm-4">
          <input type="submit" class="btn btn-primary btn-md" style="padding: 2px;" name="submit" value="Import">
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="col-sm-4">
          <a href="<?php echo base_url() ?>Kodas-agents.csv" download="Kodas-agents.csv"  style="padding: 2px;" class="btn btn-primary btn-md">Download Sample CSV File</a>
        </div>
      </div>
    </div>
  </form>

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