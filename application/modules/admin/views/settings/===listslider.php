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
<h1>
  <?php /*?><img src="<?= base_url('assets/imgs/list-user.png') ?>" class="header-img" style="margin-top:-2px;"><?php */?>
  App Slider</h1>
<hr>

<div class="row">
  <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <div class="col-sm-3">
      <div class="form-group">
        <div class="col-sm-10">
          <input type="file" name="sliderfile" class="form-control" <?=empty($oneslider['imagename']) ? 'required' : '';?> />
          <?=!empty($oneslider['imagename']) ? '<img style="height: 50px;margin-top: 10px;" src="' . base_url('attachments/slider_img/' . $oneslider['imagename']) . '">' : '';?>
          <input type="hidden" name="slideroldimg" value="<?=!empty($oneslider['imagename']) ? $oneslider['imagename'] : '';?>">
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <div class="col-sm-10">
          <select class="form-control" name="productid" required>
          	<option value="">Select Product</option>
          	<?php foreach ($products as $product) {
	$selected = '';
	if (isset($oneslider['productid']) && $oneslider['productid'] == $product->id) {$selected = 'selected';}
	echo '<option value="' . $product->id . '" ' . $selected . '>' . $product->title . '</option>';
}?>

          </select>
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <div class="col-sm-10">
          <input type="text" name="postition" placeholder="Position" class="form-control" value="<?=!empty($oneslider['position']) ? $oneslider['position'] : '';?>" />
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="form-group">
        <div class="col-sm-10">
          <input type="text" name="youtubeurl" placeholder="Youtube Video ID" class="form-control" value="<?=!empty($oneslider['youtubeurl']) ? $oneslider['youtubeurl'] : '';?>" />
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <?php if (!empty($oneslider)) {?>
            <input type="hidden" name="updateid" value="<?=!empty($oneslider['id']) ? $oneslider['id'] : '';?>">
          <button type="submit" class="btn btn-default" name="update" value="update">Update</button>
            <?php } else {?>
              <button type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
            <?php }?>

        </div>
      </div>
    </div>
  </form>
</div>
<div class="row">
  <div class="col-xs-12">
    <?php
if ($userlist) {
	?>
    <div class="table-responsive">
      <table class="table table-bordered" style="width:50%;">
        <thead>
          <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Position</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
foreach ($userlist as $row) {
		$u_path = 'attachments/slider_img/';
		if ($row->imagename != null && file_exists($u_path . $row->imagename)) {
			$image = base_url($u_path . $row->imagename);
		} else {
			$image = base_url('attachments/no-image.png');
		}
		?>
          <tr>
            <td><img src="<?=$image?>" alt="No Image" class="img-thumbnail" style="height:100px;"></td>
            <td><?=$row->title;?></td>
            <td><?=$row->position;?></td>
            <td><div class="pull-right"> <a href="<?=base_url('admin/listslider/?edit=' . $row->id)?>" class="btn btn-info">Edit</a> <a href="<?=base_url('admin/listslider?delete=' . $row->id)?>"  class="btn btn-danger confirm-delete">Delete</a> </div></td>
          </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
    <?=$links_pagination?>
  </div>
  <?php
} else {
	?>
  <div class ="alert alert-info">No products found!</div>
  <?php }?>
</div>
