<div id="products">
    <?php
if ($this->session->flashdata('result_delete')) {
	?>
        <hr>
        <div class="alert alert-success"><?=$this->session->flashdata('result_delete')?></div>
        <hr>
        <?php
}
if ($this->session->flashdata('result_publish')) {
	?>
        <hr>
        <div class="alert alert-success"><?=$this->session->flashdata('result_publish')?></div>
        <hr>
        <?php
}

?>
    <h1><img src="<?=base_url('assets/imgs/products-img.png')?>" class="header-img" style="margin-top:-2px;"> Products</h1>
    <hr>
    <a href="<?=base_url('admin/publish');?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add Products</a>
    <div class="row">
        <div class="col-xs-12">
            <div class="well hidden-xs">
                <div class="row">
                    <form method="GET" id="searchProductsForm" action="">
                        <?php /*?><div class="col-sm-4">
<label>Order:</label>
<select name="order_by" class="form-control selectpicker change-products-form">
<option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'id=desc' ? 'selected=""' : '' ?> value="id=desc">Newest</option>
<option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'id=asc' ? 'selected=""' : '' ?> value="id=asc">Latest</option>
<option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'quantity=asc' ? 'selected=""' : '' ?> value="quantity=asc">Low Quantity</option>
<option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'quantity=desc' ? 'selected=""' : '' ?> value="quantity=desc">High Quantity</option>
</select>
</div><?php */?>
                        <div class="col-sm-4">
                            <label>Title:</label>
                            <div class="input-group">
                                <input class="form-control" placeholder="Product Title" type="text" value="<?=isset($_GET['search_title']) ? $_GET['search_title'] : ''?>" name="search_title">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" value="">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <?php /*?><div class="col-sm-4">
<label>Category:</label>
<select name="category" class="form-control selectpicker change-products-form">
<option value="">None</option>
<?php foreach ($shop_categories as $key_cat => $shop_categorie) { ?>
<option <?= isset($_GET['category']) && $_GET['category'] == $key_cat ? 'selected=""' : '' ?> value="<?= $key_cat ?>">
<?php
foreach ($shop_categorie['info'] as $nameAbbr) {
if ($nameAbbr['abbr'] == $this->config->item('language_abbr')) {
echo $nameAbbr['name'];
}
}
?>
</option>
<?php } ?>
</select>
</div><?php */?>
                    </form>
                </div>
            </div>
            <hr>
            <?php
if ($products) {
	?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 20%;">Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Pcs</th>
                                <th>Guest Count</th>
                                <th>User Count</th>
                                <?php /*?><th>Quantity</th>
	<th>Vendor</th>
	<th>Position</th><?php */?>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
foreach ($products as $row) {
		$u_path = 'attachments/shop_images/';
		if ($row->image != null && file_exists($u_path . $row->image)) {
			$image = base_url($u_path . $row->image);
		} else {
			$image = base_url('attachments/no-image.png');
		}
		?>

                                <tr>
                                    <td>
                                        <a href="<?=base_url('admin/likedislikeproimg/' . $row->id);?>">
                                        <img src="<?=$image?>" alt="No Image" class="img-thumbnail" style="height:100px;">
                                        <button class="btn btn-primary">Like Dislike</button>
                                    </a>
                                    </td>
                                    <td>
                                        <?=$row->title;?>
                                    </td>
                                    <td>
                                        <?=$row->price;?>
                                    </td>
                                    <td>
                                        <?=$row->product_pcs;?>
                                    </td>
                                    <td>
                                        <?=$row->view_count;?>
                                    </td>
                                    <td>
                                        <?php
$this->db->where('productid', $row->id);
		?>
        <a href="<?=base_url('admin/viewproduct/' . $row->id);?>" style="text-decoration: underline;font-weight: bold;font-size: 14px;    text-align: center;">

                                    <?=$this->db->count_all_results('userviewproduct');?>
                                    </a>
                                    </td>
                                    <?php /*?><td>
		<?php
		if ($row->quantity > 5) {
		$color = 'label-success';
		}
		if ($row->quantity <= 5) {
		$color = 'label-warning';
		}
		if ($row->quantity == 0) {
		$color = 'label-danger';
		}
		?>
		<span style="font-size:12px;" class="label <?= $color ?>">
		<?= $row->quantity ?>
		</span>
		</td>
		<td><?= $row->vendor_id > 0 ? '<a href="?show_vendor=' . $row->vendor_id . '">' . $row->vendor_name . '</a>' : 'No vendor' ?></td>
		<td><?= $row->position ?></td><?php */?>
                                    <td>
                                        <div class="pull-right">
                                            <a href="<?=base_url('admin/publish/' . $row->id)?>" class="btn btn-info">Edit</a>
                                            <a href="<?=base_url('admin/products?delete=' . $row->id)?>"  class="btn btn-danger confirm-delete">Delete</a>
                                        </div>
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
            <div class ="alert alert-info">No products found!</div>
        <?php }?>
    </div>

<style type="text/css" media="screen">
      a:hover{text-decoration: none;}
</style>