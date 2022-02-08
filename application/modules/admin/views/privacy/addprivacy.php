<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>

<h1>
  <!-- <img src="<?= base_url(
                    'assets/imgs/admin-user.png'
                  ) ?>" class="header-img" style="margin-top:-3px;">  -->Add Privacy Policy
</h1>
<hr>
<?php
$timeNow = time();
if (validation_errors()) { ?>
  <hr>
  <div class="alert alert-danger">
    <?= validation_errors() ?>
  </div>
  <hr>
<?php }
if ($this->session->flashdata('result_publish')) { ?>
  <hr>
  <div class="alert alert-success">
    <?= $this->session->flashdata('result_publish') ?>
  </div>
  <hr>
<?php }
?>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-file"></i> Privacy Policy Details</h3>
      </div>
      <form method="POST" action="" enctype="multipart/form-data">
        <table class="table">
          <tbody>
            <tr>
              <td style="width: 5%;"><a data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Privacy Policy"><i class="fa fa-user fa-fw"></i></a></td>
              <td><input type="text" id="title" name="title" placeholder="Enter Title" value="<?= @$_POST['title'] ?>" class="form-control"></td>
            </tr>
            <tr>
              <td style="width: 5%;"><a data-toggle="tooltip" required title="" class="btn btn-info btn-xs" data-original-title="Description"><i class="fa fa-map-marker fa-fw"></i></a></td>
              <td>
                <div class="form-group">
                  <textarea name="description" id="description" required rows="50" class="form-control">
                    <?= @$_POST['description'] ?>
                  </textarea>
                  <script>
                    CKEDITOR.replace('description');
                    CKEDITOR.config.entities = false;
                  </script>
                </div>
              </td>
            </tr>
            <tr>
              <td><strong></strong></td>
              <td class="text-center">
                <input type="hidden" name="pviewcount" placeholder="" value="500" class="form-control">
                <button type="submit" name="submit" class="btn btn-lg btn-default btn-addprivacy">Save</button>
                <a href="<?= base_url(
                            'admin/listprivacy'
                          ) ?>" class="btn btn-lg btn-default">Cancel</a>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
    </div>
  </div>