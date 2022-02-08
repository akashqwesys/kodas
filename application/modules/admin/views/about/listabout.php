<div id="products">
<?php
if ($this->session->flashdata('result_delete')) {
	?>
<hr>
<div class="alert alert-success">
  <?=$this->session->flashdata('result_delete')?>
</div>
<hr>
<?php
}
if ($this->session->flashdata('result_publish')) {
	?>
<hr>
<div class="alert alert-success">
  <?=$this->session->flashdata('result_publish')?>
</div>
<hr>
<?php
}
?>
<h1><!-- <img src="<?=base_url('assets/imgs/list-user.png')?>" class="header-img" style="margin-top:-2px;"> --> About</h1>
<hr>
<a href="<?=base_url('admin/addabout');?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add About</a>
<div class="row">
  <div class="col-xs-12">
  <?php if ($aboutlist) {
	?>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Title</th>
            <th>Description</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
foreach ($aboutlist as $row) {
		?>
          <tr>
            <td><?=$row->title;?></td>
            <td><?=$row->description;?></td>
            <td>
              <div class="pull-right"> <a href="<?=base_url('admin/addabout/' . $row->id)?>" class="btn btn-info">Edit</a> <a href="<?=base_url('admin/listabout?delete=' . $row->id)?>"  class="btn btn-danger confirm-delete">Delete</a> </div>
            </td>
          </tr>
          <?php
}
	?>
        </tbody>
      </table>
    </div>
    <?=$links_pagination?>
  </div>
  <?php
} else {
	?>
  <div class ="alert alert-info">No About found!</div>
  <?php }?>
</div>
