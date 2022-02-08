<h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> Edit Attributesgroup</h1>
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
if ($this->session->flashdata('edit_attributesgroup')) {
?>
  <hr>
  <div class="alert alert-danger">
    <?= $this->session->flashdata('edit_attributesgroup') ?>
    <?php $this->session->set_flashdata('edit_attributesgroup', ''); ?>
  </div>
  <hr>
<?php
}
?>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-user"></i> Attributesgroup Details</h3>
      </div>
      <form method="POST" action="" enctype="multipart/form-data">
          <input type="hidden" name="attributesgroup_id" value="<?= $attributesgroup_result['attributesgroup_id']; ?>">
        <table class="table">
          <tbody>
          <tr>
              <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Attributesgroup name"><i class="fa fa-user fa-fw"></i></label></td>
              <td><input type="text" required id="title" name="title" placeholder="Title" value="<?= $attributesgroup_result['title'] ?>" class="form-control"></td>
            </tr>
            <tr>
              <td><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Sort Order"><i class="fa fa-phone fa-fw"></i></label></td>
              <td><input type="text" required id="sort_order" name="sort_order" placeholder="Sort order" value="<?= $attributesgroup_result['sort_order'] ?>" class="form-control"></td>
            </tr>                    
            <tr>
              <td style="width: 1%;"><label data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Status"><i class="fa fa-calendar fa-fw"></i></label></td>
              <td><select class="form-control" name="status">
                  <option value="">Select Status</option>
                  <option value="0" <?= $attributesgroup_result['status'] == '0' ? 'selected' : '' ?>>Inactive</option>
                  <option value="1" <?= $attributesgroup_result['status'] == '1' ? 'selected' : '' ?>>Active</option>
                </select></td>
            </tr>
            <tr>
              <td><strong></strong></td>
              <td class="text-center">
                <input type="hidden" name="pviewcount" placeholder="" value="500" class="form-control">
                <button type="submit" name="submit" class="btn btn-lg btn-default btn-addattributesgroup">Save</button>
                <a href="<?= base_url('admin/listattributesgroup') ?>" class="btn btn-lg btn-default">Cancel</a>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>