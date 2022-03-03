<div>
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
  <h1>SUBSCRIBERS</h1>
  <hr>  
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table id="table" class="table dt-responsive nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>Email</th>
              <th>Suscribe Date</th>                                        
              <th>Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
<?php $this->session->set_flashdata('result_delete', ''); ?>
