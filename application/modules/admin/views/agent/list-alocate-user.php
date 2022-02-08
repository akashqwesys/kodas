<div>
  <?php
  if ($this->session->flashdata('add_allocation_success')) {
  ?>  
    <hr>
    <div class="alert alert-success">
      <?= $this->session->flashdata('add_allocation_success') ?>
    </div>
    <hr>
  <?php
  }
  ?>
   <?php
  if ($this->session->flashdata('add_allocation_failed')) {
  ?>  
    <hr>
    <div class="alert alert-danger">
      <?= $this->session->flashdata('add_allocation_failed') ?>
    </div>
    <hr>
  <?php
  }
  ?>
  <h1><img src="<?= base_url('assets/imgs/list-user.png') ?>" class="header-img" style="margin-top:-2px;"> User allocation</h1>
  <hr>
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        
      <form id="frm-example" action="<?= base_url('admin/addallocation') ?>" method="POST">
      <table id="example" class="table dt-responsive nowrap display select">
          <thead>
            <tr>
              <th><input name="select_all" value="1" type="checkbox"></th>
              <th>Name</th>
              <th>Mobile</th>
              <th>Email</th>
              <th>Address</th>              
              <th>Business name</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
        </table>
        <hr>
        <input type="hidden" name="agent_id" value="<?= $id; ?>">
<p><button>Allocate</button></p>
</form>

      </div>
    </div>
  </div>
</div>
<?php 
$this->session->set_flashdata('add_allocation_success', '');
$this->session->set_flashdata('add_allocation_failed', '');
?>