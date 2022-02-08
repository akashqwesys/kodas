<div id="products">
<h1 style="text-transform: capitalize;"><img src="<?=base_url('assets/imgs/list-user.png')?>" class="header-img" style="margin-top:-2px;">
  View Product User List
</h1>
<hr>
<div class="row">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><i class="fa fa-info-circle"></i> Product Info </h3>
    </div>
    <div class="panel-body">
      <table class="table table-bordered" cellpadding="4" style="width:50%;">
        <thead>
          <tr>
            <th class="text-center">Image</th>
            <th class="text-left">Title</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center"><?php if (isset($productinfo[0]['image']) && $productinfo[0]['image'] != '') {
	echo '<a href="' . base_url('attachments/shop_images/' . $productinfo[0]['image']) . '" download><img src="' . base_url('attachments/shop_images/' . $productinfo[0]['image']) . '" height="75" width="75"></a>';
}?></td>
            <td class="text-left"><?=$productinfo[0]['title'];?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="col-xs-12">
    <?php
if ($userlist) {
	?>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>MobileNumber</th>
            <th>View</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($userlist as $row) {?>
          <tr>
            <td><?=$row->name;?></td>
            <td><?=$row->mobilenumber;?></td>
            <td><?=$row->viewcount;?></td>
          </tr>
          <?php }?>
        </tbody>
      </table>
    </div>
  </div>
  <?php
} else {
	?>
  <div class ="alert alert-info">No user found!</div>
  <?php }?>
</div>
