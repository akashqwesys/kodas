<h1>Add Category</h1>
<hr>
<?php
$timeNow = time();
if (validation_errors()) {
?>
  <hr>
  <div class="alert alert-danger">
    <?= validation_errors() ?>
  </div>
  <hr>
<?php
}
if ($this->session->flashdata('add_categories')) {
?>
  <hr>
  <div class="alert alert-danger">
    <?= $this->session->flashdata('add_categories') ?>
    <?php $this->session->set_flashdata('add_categories', ''); ?>
  </div>
  <hr>
<?php
}
?>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-user"></i> Category</h3>
      </div>
      <form method="POST" action="" enctype="multipart/form-data">
        <table class="table">
          <tbody>
            <tr>
              <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Category name"><i class="fa fa-list fa-fw"></i></label></td>
              <td><input type="text" required id="name" name="name" placeholder="Category Name" value="<?= @$_POST['name'] ?>" class="form-control"></td>
            </tr>
            <tr>
              <td><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Position"><i class="fa fa-list fa-fw"></i></label></td>
              <td><input type="text" required id="position" name="position" placeholder="Position" value="<?= @$_POST['position'] ?>" class="form-control"></td>
            </tr> 
            <tr>
            <td><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Position"><i class="fa fa-list fa-fw"></i></label></td>
              <td>Web image
                <input type="file" id="websiteimg" name="websiteimg" class="form-control" placeholder="websiteimg"></td>
            </tr>
            <tr>
            <td><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Position"><i class="fa fa-list fa-fw"></i></label></td>
              <td>
              App image
                <input type="file" id="catimg" name="catimg" class="form-control" placeholder="catimg"></td>
            </tr>                                   
            <tr>
              <td><strong></strong></td>
              <td class="text-center">
                <input type="hidden" name="pviewcount" placeholder="" value="500" class="form-control">                
                <a href="<?= base_url('admin/listcategories') ?>" class="btn btn-lg btn-default">Cancel</a>
                <button type="submit" name="submit" class="btn btn-success btn-addcategories">Save</button>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>