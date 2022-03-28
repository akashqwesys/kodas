
<h1>Orders<a href="<?= base_url('admin/add-order'); ?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;float:right"><b>+</b> Add Order</a>
<div class="col-sm-12 col-md-2 pull-right">          
      <select class="form-control" name="status" id="status">                
      <?php foreach($statusList as $row){
        ?>
        <option value="<?php echo $row['name']; ?>"  <?php if (isset($_SESSION['order_status'])) {if($_SESSION['order_status']==$row['name']){
                                  echo 'selected';
                                }} ?>><?php echo $row['name']; ?></option>
        <?php
      }?>  
      
      </select>
    </div>


</h1>
<hr>

<div class="row">
  <div class="col-xs-12">
    <div class="table-responsive">
      <table id="table" class="table dt-responsive nowrap">
        <thead>
          <tr>
            <th>No</th>
            <th>Order ID</th>
            <th>Date</th>
            <th>Name</th>
            <th>Business Name</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>