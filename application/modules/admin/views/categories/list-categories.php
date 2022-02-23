
<div>
<?php
if ($this->session->flashdata('add_categories')) {
?>
  <hr>
  <div class="alert alert-success">
    <?= $this->session->flashdata('add_categories') ?>
  </div>
  <hr>
<?php
}
?>
<?php
if ($this->session->flashdata('edit_categories')) {
?>
  <hr>
  <div class="alert alert-success">
    <?= $this->session->flashdata('edit_categories') ?>
  </div>
  <hr>
<?php
}
?>
  <h1>Categories <a href="<?= base_url('admin/addcategories'); ?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;float:right"><b>+</b> Add Category</a></h1>
  <hr>  
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table id="table" class="table dt-responsive nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Name</th>
              <th>Position</th>                                        
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->session->set_flashdata('add_categories', ''); ?>
<?php $this->session->set_flashdata('edit_categories', ''); ?>