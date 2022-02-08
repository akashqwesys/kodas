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
$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
?>
<h1><img src="<?=base_url('assets/imgs/list-user.png')?>" class="header-img" style="margin-top:-2px;">
<?php
if (isset($usertype) && $usertype == 'top') {
	echo 'Ordering Customer Report';
} elseif (isset($usertype) && $usertype == 'bottom') {
	echo 'Non Ordering Customer Report';
}
?>
</h1>
<hr>

<?php
if ($userlist) {
	?>

  <div class="row">
    <div class="col-md-3">
      <div class="table-responsive">
      <table class="table table-bordered table-fixed">
        <thead>
          <tr>
            <th>Name</th>
            <th>Business Name</th>
            <?=!empty($usertype) && $usertype == 'top' ? '<th>Price</th>' : ''?>
            <!-- <th class="text-right">Action</th> -->
          </tr>
        </thead>
        <tbody>
          <?php
//  echo '<pre>';
	// print_r($userlist);

	foreach ($userlist as $row) {
		?>
          <tr>
            <td><?=$row->name;?> </td>
            <td><?=$row->businessname;?> </td>
            <?=!empty($usertype) && $usertype == 'top' ? '<td>' . $fmt->formatCurrency($row->finaltotal, "INR") . '</td>' : ''?>
          </tr>
          <?php
}
	?>
        </tbody>
      </table>
    </div>
    <!-- <?=$links_pagination?> -->
    </div>
    </div>
  </div>


  </div>
  <?php

} elseif ($changedevice) {
	?>

  <div class="row">
    <div class="col-md-3">
      <div class="table-responsive">
      <table class="table table-bordered table-fixed">
        <thead>
          <tr>
            <th>Name</th>
            <th>Count</th>
            <!-- <th class="text-right">Action</th> -->
          </tr>
        </thead>
        <tbody>
          <?php
foreach ($changedevice as $row) {
		?>
          <tr>
            <td><?=$row->name;?> </td>
            <td><?=$row->devicecount;?> </td>
          </tr>
          <?php
}
	?>
        </tbody>
      </table>
    </div>
    <!-- <?=$links_pagination?> -->
    </div>
    </div>
  </div>


  </div>
  <?php

} else {?>
  <div class ="alert alert-info">No user found!</div>
  <?php }?>
</div>