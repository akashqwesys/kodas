<h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> Add Packaging type</h1>
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
if ($this->session->flashdata('add_packagingtype')) {
?>
  <hr>
  <div class="alert alert-danger">
    <?= $this->session->flashdata('add_packagingtype') ?>
    <?php $this->session->set_flashdata('add_packagingtype', ''); ?>
  </div>
  <hr>
<?php
}
?>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-user"></i> Packaging type</h3>
      </div>
      <form method="POST" action="" enctype="multipart/form-data">
        <table class="table">
          <tbody>
            <tr>
              <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Packaging type name"><i class="fa fa-user fa-fw"></i></label></td>
              <td><input type="text" required id="title" name="title" placeholder="Title" value="<?= @$_POST['title'] ?>" class="form-control"></td>
            </tr>
            <tr>
              <td><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Peaces"><i class="fa fa-phone fa-fw"></i></label></td>
              <td><input type="text" required id="pcs" name="pcs" placeholder="Peaces" value="<?= @$_POST['pcs'] ?>" class="form-control"></td>
            </tr>                    
            <tr>
              <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Status"><i class="fa fa-calendar fa-fw"></i></label></td>
              <td><select class="form-control" name="status">
                  <option value="">Select Status</option>
                  <option value="0" <?= isset($_POST['status']) && $_POST['status'] == '0' ? 'selected' : '' ?>>Inactive</option>
                  <option value="1" <?= isset($_POST['status']) && $_POST['status'] == '1' ? 'selected' : '' ?>>Active</option>
                </select></td>
            </tr>
            <tr>
              <td><strong></strong></td>
              <td class="text-center">
                <input type="hidden" name="pviewcount" placeholder="" value="500" class="form-control">
               
                <a href="<?= base_url('admin/listpackagingtype') ?>" class="btn btn-lg btn-default">Cancel</a>
                <button type="submit" name="submit" class="btn btn-success btn-addpackagingtype">Save</button>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>