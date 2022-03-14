<h1>Add Stock</h1>
<hr>
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-user"></i> Stock</h3>
      </div>
<br>
    <form class="form-horizontal" method="POST" action="">
      <input type="hidden" name="refProduct_id" value="<?php echo $id; ?>">
    <div class="form-group">
      <label class="control-label col-sm-2 col-md-2" for="email">Stock:</label>
      <div class="col-sm-10 col-md-4">
        <input type="text" class="form-control" placeholder="Enter Quantity" name="qty" required>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
      <a href="<?= base_url('admin/products') ?>" class="btn btn-danger">Cancel</a>     
      <button type="submit" name="submit" class="btn btn-success">Save</button>
      </div>
    </div>
  </form>           
    </div>
  </div>