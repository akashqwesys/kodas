<div>
  <?php
  if ($this->session->flashdata('add_shareproduct_success')) {
  ?>  
    <hr>
    <div class="alert alert-success">
      <?= $this->session->flashdata('add_shareproduct_success') ?>
    </div>
    <hr>
  <?php
  }
  ?>
   <?php
  if ($this->session->flashdata('add_shareproduct_failed')) {
  ?>  
    <hr>
    <div class="alert alert-danger">
      <?= $this->session->flashdata('add_shareproduct_failed') ?>
    </div>
    <hr>
  <?php
  }
  ?>
  <h1><img src="<?= base_url('assets/imgs/list-user.png') ?>" class="header-img" style="margin-top:-2px;">Shareproduct</h1>
  <hr>
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        
      <form id="frm-example" action="<?= base_url('admin/addshareproduct') ?>" method="POST">
      <table id="example" class="table dt-responsive nowrap display select">
          <thead>
            <tr>
              <th><input name="select_all" value="1" type="checkbox"></th>
              <th>Title</th>
              <th>Price</th>
              <th>Old Price</th>
              <!-- <th>Abbr</th>                        -->
            </tr>
          </thead>
        </table>
        <hr>        
<p><button>Allocate</button></p>
</form>

      </div>
    </div>
  </div>
</div>
<?php 
$this->session->set_flashdata('add_shareproduct_success', '');
$this->session->set_flashdata('add_shareproduct_failed', '');
?>