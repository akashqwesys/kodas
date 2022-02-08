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

<!-- <div class="row">
  <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <div class="col-sm-3">
      <div class="form-group">
        <div class="col-sm-10">
          <input type="file" name="sliderfile" class="form-control" required />
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <div class="col-sm-10">
          <select class="form-control" name="productid" required>
          	<option value="">Select Product</option>
          	<?php foreach ($products as $product) {
	echo '<option value="' . $product->id . '">' . $product->title . '</option>';
}?>

          </select>
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <div class="col-sm-10">
          <input type="text" name="postition" placeholder="Position" class="form-control" />
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default" name="submit" value="submit">Submit</button>
        </div>
      </div>
    </div>
  </form>
</div> -->
<div class="row">
  <div class="col-xs-6">
    <h1>
  <?php /*?><img src="<?= base_url('assets/imgs/list-user.png') ?>" class="header-img" style="margin-top:-2px;"><?php */?>
  App Slider</h1>
<hr>
<a href="javascript:void(0);" data-toggle="modal" data-target="#add_app_slider" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add Slide</a>
    <div class="clearfix"></div>
    <?php
if ($appslidelist) {
	?>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Position</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
foreach ($appslidelist as $row) {
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
            <td style="width: 11%;"><div class="pull-center"> <a href="javascript:void(0);" data-toggle="modal" data-target="#edit_app_slider<?=$row->id;?>" class="btn btn-primary btn-xs confirm-edit"><span class="glyphicon glyphicon-edit"></span></a> <a href="<?=base_url('admin/listslider?delete=' . $row->id)?>"  class="btn btn-danger btn-xs confirm-delete"><span class="glyphicon glyphicon-remove"></span></a> </div></td>
          </tr>
          <div class="modal fade" id="edit_app_slider<?=$row->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Application Slide</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                                <label>Select Product</label>
                                <select class="form-control" name="productid" oninvalid="this.setCustomValidity('Please Enter Category Name')"
 oninput="setCustomValidity('')" required>
                                  <option value="">Select Product</option>
                                  <?php foreach ($products as $product) {
			$select = '';
			if ($product->id == $row->productid) {$select = 'selected=""';}
			echo '<option value="' . $product->id . '" ' . $select . '>' . $product->title . '</option>';
		}?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>App Image</label>
                                <input type="file" oninvalid="this.setCustomValidity('Please Select App Image')"
 oninput="setCustomValidity('')" name="sliderfile" class="form-control">
                          <input type="hidden" name="oldsliderfile" value="<?=$row->imagename;?>">
                          <img src="<?=$image;?>" alt="" width="200" height="100">
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="number" oninvalid="this.setCustomValidity('Please Enter Position')"
 oninput="setCustomValidity('')" min="0" name="postition" value="<?=$row->position;?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Youtube Video ID</label>
                                <input type="text" name="youtubeurl" value="<?=$row->youtubeurl;?>" class="form-control">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="slider_type" value="Application">
                        <input type="hidden" name="editsliderid" value="<?=$row->id;?>">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
          <?php }?>
        </tbody>
      </table>
    </div>
    <?=$links_pagination?>

  <?php
} else {
	?>
  <div class ="alert alert-info">No slider found!</div>
  <?php }?>
  </div>

  <div class="col-xs-6">
    <h1>
  <?php /*?><img src="<?= base_url('assets/imgs/list-user.png') ?>" class="header-img" style="margin-top:-2px;"><?php */?>
  Web Slider</h1>
<hr>
<a href="javascript:void(0);" data-toggle="modal" data-target="#add_web_slider" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add Slide</a>
    <div class="clearfix"></div>
    <?php
if ($websiteslidelist) {
	?>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Image</th>
            <th>Product Name</th>
            <th>Position</th>
            <th class="text-center">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
foreach ($websiteslidelist as $row) {
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
            <td style="width: 11%;"><div class="pull-center"> <a href="javascript:void(0);" data-toggle="modal" data-target="#edit_web_slider<?=$row->id;?>" class="btn btn-primary btn-xs confirm-edit"><span class="glyphicon glyphicon-edit"></span></a> <a href="<?=base_url('admin/listslider?delete=' . $row->id)?>"  class="btn btn-danger btn-xs confirm-delete"><span class="glyphicon glyphicon-remove"></span></a> </div></td>
          </tr>
          <div class="modal fade" id="edit_web_slider<?=$row->id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Website Slide</h4>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Select Product</label>
                                <select class="form-control" name="productid" oninvalid="this.setCustomValidity('Please Enter Category Name')"
 oninput="setCustomValidity('')" required>
                                  <option value="">Select Product</option>
                                  <?php foreach ($products as $product) {
			echo '<option value="' . $product->id . '">' . $product->title . '</option>';
		}?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Web Image</label>
                                <input type="file" oninvalid="this.setCustomValidity('Please Select Web Image')"
 oninput="setCustomValidity('')" name="sliderfile" class="form-control">
                          <input type="hidden" name="oldsliderfile" value="<?=$row->imagename;?>">
                          <img src="<?=$image;?>" alt="" width="200" height="100">
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="number" oninvalid="this.setCustomValidity('Please Enter Position')"
 oninput="setCustomValidity('')" min="0" name="postition" value="<?=$row->position;?>" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Youtube Video ID</label>
                                <input type="text" name="youtubeurl" value="<?=$row->youtubeurl;?>" class="form-control">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="slider_type" value="Website">
                        <input type="hidden" name="editsliderid" value="<?=$row->id;?>">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
          <?php }?>
        </tbody>
      </table>
    </div>
    <?=$links_pagination?>

  <?php
} else {
	?>
  <div class ="alert alert-info">No slider found!</div>
  <?php }?>
  </div>
</div>


    <div class="modal fade" id="add_web_slider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Website Slide</h4>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label>Select Product</label>
                                <select class="form-control" name="productid" oninvalid="this.setCustomValidity('Please Enter Category Name')"
 oninput="setCustomValidity('')" required>
                                  <option value="">Select Product</option>
                                  <?php foreach ($products as $product) {
	echo '<option value="' . $product->id . '">' . $product->title . '</option>';
}?>

                                </select>
                            </div>

                            <div class="form-group">
                                <label>Web Image</label>
                                <input type="file" oninvalid="this.setCustomValidity('Please Select App Image')"
 oninput="setCustomValidity('')" name="sliderfile" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="number" oninvalid="this.setCustomValidity('Please Enter Position')"
 oninput="setCustomValidity('')" min="0" name="postition" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Youtube Video ID</label>
                                <input type="text" name="youtubeurl" value="" class="form-control">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="slider_type" value="Website">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_app_slider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Application Slide</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                                <label>Select Product</label>
                                <select class="form-control" name="productid" oninvalid="this.setCustomValidity('Please Enter Category Name')"
 oninput="setCustomValidity('')" required>
                                  <option value="">Select Product</option>
                                  <?php foreach ($products as $product) {
	echo '<option value="' . $product->id . '">' . $product->title . '</option>';
}?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label>App Image</label>
                                <input type="file" oninvalid="this.setCustomValidity('Please Select App Image')"
 oninput="setCustomValidity('')" name="sliderfile" class="form-control" required>
                                <label>Image Size 400x600</label>
                            </div>
                            <div class="form-group">
                                <label>Position</label>
                                <input type="number" oninvalid="this.setCustomValidity('Please Enter Position')"
 oninput="setCustomValidity('')" min="0" name="postition" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Youtube Video ID</label>
                                <input type="text" name="youtubeurl" value="" class="form-control">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="slider_type" value="Application">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
