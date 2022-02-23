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
  <h1><img src="<?=base_url('assets/imgs/list-user.png')?>" class="header-img" style="margin-top:-2px;"> Customers <a href="<?=base_url('admin/adduser');?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;float:right"><b>+</b> Add Customer</a></h1>
  <hr>
  
  <form class="form-horizontal" action="<?=base_url('admin/addbulkuser');?>" role="form" method="post" enctype="multipart/form-data">
    <div class="col-md-2">
      <div class="form-group">
        <div class="col-sm-4">
          <input type="file" id="csvfile" name="csvfile" required>
        </div>
      </div>
    </div>
    <div class="col-md-1">
      <div class="form-group">
        <div class="col-sm-4">
          <input type="submit" class="btn btn-primary btn-md" style="padding: 2px;" name="submit" value="Import">
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <div class="col-sm-4">
          <a href="<?php echo base_url() ?>Kodas-customers.csv" download="Kodas-customers.csv"  style="padding: 2px;" class="btn btn-primary btn-md">Download Sample CSV File</a>
        </div>
      </div>
    </div>
  </form>
  <div class="row">
    <div class="col-xs-12">
      <div class="well hidden-xs">
        <div class="row">
          <form method="GET" id="searchProductsForm" action="">
            <div class="col-sm-4">
              <label>Status:</label>
              <select name="order_by" class="form-control selectpicker change-products-form">
                <option <?=isset($_GET['order_by']) && $_GET['order_by'] == '' ? 'selected=""' : ''?> value="">All</option>
                <option <?=isset($_GET['order_by']) && $_GET['order_by'] == 'true' ? 'selected=""' : ''?> value="true">Active</option>
                <option <?=isset($_GET['order_by']) && $_GET['order_by'] == 'false' ? 'selected=""' : ''?> value="false">Deactive</option>
                <option <?=isset($_GET['order_by']) && $_GET['order_by'] == '0' ? 'selected=""' : ''?> value="0">Pending</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label>Search:</label>
              <div class="input-group">
                <input class="form-control" placeholder="Search" type="text" value="<?=isset($_GET['search_title']) ? $_GET['search_title'] : ''?>" name="search_title">
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
      <?php /*?><div class="well hidden-xs">
<div class="row">
<form method="GET" id="searchProductsForm" action="">
<div class="col-sm-4">
<label>Order:</label>
<select name="order_by" class="form-control selectpicker change-products-form">
<option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'id=desc' ? 'selected=""' : '' ?> value="id=desc">Newest</option>
<option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'id=asc' ? 'selected=""' : '' ?> value="id=asc">Latest</option>
<option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'quantity=asc' ? 'selected=""' : '' ?> value="quantity=asc">Low Quantity</option>
<option <?= isset($_GET['order_by']) && $_GET['order_by'] == 'quantity=desc' ? 'selected=""' : '' ?> value="quantity=desc">High Quantity</option>
</select>
</div>
<div class="col-sm-4">
<label>Title:</label>
<div class="input-group">
<input class="form-control" placeholder="Product Title" type="text" value="<?= isset($_GET['search_title']) ? $_GET['search_title'] : '' ?>" name="search_title">
<span class="input-group-btn">
<button class="btn btn-default" type="submit" value=""> <i class="fa fa-search"></i> </button>
</span> </div>
</div>
<div class="col-sm-4">
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
</div>
</form>
</div>
</div>
<hr><?php */?>
        <?php
if ($userlist) {
	?>
        <form method="POST" action="">
          <div class="row" style="margin-bottom: 15px;">
            <div class="col-sm-4">
              <select name="selectuserstatus" class="form-control selectpicker" required>
                <option value="">Select Change Status</option>
                <option value="true">Active</option>
                <option value="false">Deactive</option>
                <option value="0">Pending</option>
              </select>
            </div>
            <div class="col-sm-4">
              <label></label>
              <input type="submit" name="changestatuseuser" class="btn btn-primary changestatuseuser" value="Go">
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th align="center" style="text-align:center;"><input type="checkbox" class="onebyonecheckbox" onclick="toggle(this);"></th>
                  <th>Name</th>
                  <th>MobileNumber</th>
                  <th>Emaild</th>
                  <th>Business Name</th>
                  <th>Status</th>
                  <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
foreach ($userlist as $row) {
		$this->db->where('wpn_chatmessenger.sender_id ', $row->id);
		$this->db->where('wpn_chatmessenger.read_status ', 0);
		$this->db->where('wpn_chatmessenger.usertype !=', 'admin');
		$colorscount = $this->db->count_all_results('wpn_chatmessenger');

		$this->db->where('users.id ', $row->approvedby);
		$printname = $this->db->get('users');
		$row1 = $printname->row_array();


    $active_inactive_badge='';
    if($row->isverified=='true'){
        $active_inactive_badge='<span class="badge badge-success badge-status-'.$row->id.'">Active</span>';
    }
    if($row->isverified=='false'){
        $active_inactive_badge='<span class="badge badge-danger badge-status-'.$row->id.'">inActive</span>';
    }  
    if($row->isverified==0){
      $active_inactive_badge='<span class="badge badge-warning badge-status-'.$row->id.'">Pending</span>';
    }            
    if($row->isverified=='true'){
        $str='Inactive';
        $class="btn-danger";
        $status='false';
    }
    if($row->isverified=='false' || $row->isverified==0){
        $str='Active';
        $class="btn-success";
        $status='true';
    }
    $edit_url=base_url('admin/editagent/'). $row->id;
    $alocate_url=base_url('admin/allocate-user/'). $row->id;
    $history_url=base_url('admin/agent-history/'). $row->id;
    $actionBtn = '<button class="btn '.$class.' active_inactive_customer" data-id="' . $row->id . '" data-status="' . $status . '" data-table="user_app" data-wherefield="id" data-updatefield="isverified" data-module="user_app">'.$str.'</button>';


		?>
                <tr>
                  <td align="center"><input type="checkbox" class="onebyonecheckbox" name="usercheck[]" value="<?=$row->id;?>"></td>
                  <td><?=$row->name;?></td>
                  <td><?=$row->mobilenumber;?></td>
                  <td><?=$row->emailid;?></td>
                  <td><?=$row->businessname;?></td>
                  <td><?php

            

// $status = "";
// 		$color = "";
// 		if ($row->isverified == 'true') {
// 			$color = 'label-success';
// 			$status = 'Active';
// 		}
// 		if ($row->isverified == 'false') {
// 			$color = 'label-danger';
// 			$status = 'Deactivate';
// 		}
// 		if ($row->isverified == '0') {
// 			$color = 'label-warning';
// 			$status = 'Pending';
// 		}

		?>
                    <!-- <span style="font-size:12px;" class="label <?//=$color?>"> -->
                      <?=$active_inactive_badge;?>
                    </span>
                    <?=!empty($row1['username']) ? '<div style="margin-top: 7px;"> By ' . $row1['username'] . '</div>' : '';?></td>
                    <td>
                      <!-- <div class="pull-left">
                        <a href="<?php //base_url('admin/adduser/' . $row->id)?>" class="btn btn-success">
                          Message <span class="badge badge-danger" style="background: #d9534f;color: #fff;"><?php //$colorscount;?></span>
                          <span class="sr-only"></span>
                        </a>
                      </div> -->
                      <div class="pull-right"><?= $actionBtn; ?> <a href="<?=base_url('admin/customer-history/' . $row->id)?>" class="btn btn-primary">History</a> <a href="<?=base_url('admin/adduser/' . $row->id)?>" class="btn btn-info">Edit</a> <a href="<?=base_url('admin/listuser?delete=' . $row->id)?>"  class="btn btn-danger confirm-delete">Delete</a> </div></td>
                    </tr>
                    <?php
}
	?>
                  </tbody>
                </table>
              </div>
            </form>
            <?=$links_pagination?>
          </div>
          <?php
} else {
	?>
          <div class ="alert alert-info">No user found!</div>
          <?php }?>
        </div>
        <script type="text/javascript">
        function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
          for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
          }
        }




        $(document).ready(function() {
          $(document).on('click', '.active_inactive_customer', function() {
                var self = $(this);
                var table = self.attr('data-table');
                var updatefield = self.attr('data-updatefield');
                var wherefield = self.attr('data-wherefield');
                var status = self.attr('data-status');
                if (!confirm('Are you sure want to update?'))
                    return;
                self.attr('disabled', 'disabled');
                var data = {
                    'table_id': self.data('id'),
                    'status': status,
                    'table': table,
                    'updatefield': updatefield,
                    'wherefield': wherefield
                };
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('admin/active-inactive-customer') ?>",
                    data: data,
                    success: function(res) {
                        var res = $.parseJSON(res);
                        if (res.suceess) {
                            var title = 'Click to Active';
                            var class_ = 'active_inactive_customer btn btn-success';
                            var text = "Active";
                            var isactive = 'true';
                            var class_badge = '';
                            var text_badge = '';
                            if (status == 'true') {
                                title = 'Click To inActive';
                                class_ = 'active_inactive_customer btn btn-danger';
                                text = "inActive";
                                isactive = 'false';
                                class_badge = 'badge badge-success badge-status-' + self.data('id');
                                text_badge = "Active";
                            }
                            if (status == 'false') {
                                class_badge = 'badge badge-danger badge-status-' + self.data('id');
                                text_badge = "inActive";
                            }
                            $(".badge-status-" + self.data('id')).html(text_badge);
                            $(".badge-status-" + self.data('id')).removeClass().addClass(class_badge);
                            self.removeClass().addClass(class_);
                            self.attr({
                                'data-status': isactive,
                                'title': title
                            });
                            self.removeAttr('disabled');
                            self.html(text);
                        }
                    }
                });
            });
        });
        </script>