<?php $sitelogo = '';
$query = $this->db->get('value_store');
$result = $query->result_array();
$data1 = [];
foreach ($result as $key => $value) {
    $key = $value['thekey'];
    $data1[$key] = $value['value'] != '' ? $value['value'] : '';
}
$sitelogo = $data1['sitelogo'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= $description ?>">
        <title><?= $title ?></title>
        <link href="<?= base_url(
            'assets/css/bootstrap.min.css'
        ) ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url(
            'assets/bootstrap-select-1.12.1/bootstrap-select.min.css'
        ) ?>">
        <link href="<?= base_url(
            'assets/css/custom-admin.css'
        ) ?>" rel="stylesheet">


        <link href="<?= base_url('assets/central') ?>/datatable/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/central') ?>/datatable/dataTables.responsive.css" rel="stylesheet" type="text/css"> 
        <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"> 
        

        <link rel="stylesheet" href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css">
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/blue.css"> -->
        

        <link href='https://fonts.googleapis.com/css?family=Inconsolata' rel='stylesheet' type='text/css'>
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            <div id="content">
                <?php if ($this->session->userdata('logged_in')) { ?>
                    <nav class="navbar navbar-default">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <i class="fa fa-lg fa-bars"></i>
                            </button>
                        </div>
                        <div id="navbar" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                            	<!-- <li><img style="height: 50px;width: 100px;" src="<?= base_url(
                                 'assets/imgs/rangrasiyalogo.png'
                             ) ?>"></li> -->
                            	<li><img style="height: 50px;width: 100px;" src="<?= base_url(
                                 'attachments/site_logo/' . $sitelogo
                             ) ?>"></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                            	<li>
                                    <a href="javascript:void(0);" class="h-settings"><i class="fa fa-key" aria-hidden="true"></i> Pass Change</a>
                                    <div class="relative">
                                        <div class="settings">
                                            <div class="panel panel-primary" >
                                                <div class="panel-heading">
                                                    <div class="panel-title">Security</div>
                                                </div>
                                                <div class="panel-body">
                                                    <label>Change my password</label> <span class="bg-success" id="pass_result">Changed!</span>
                                                    <form class="form-inline" role="form">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control new-pass-field" placeholder="New password" name="new_pass">
                                                        </div>
                                                        <a href="javascript:void(0);" onclick="changePass()" class="btn btn-sm btn-primary">Update</a>
                                                        <hr>
                                                        <span>Password Strength:</span>
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0;">
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-default generate-pwd">Generate Password</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="<?= base_url(
                                    'admin/logout'
                                ) ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div>
                    </nav>
                <?php } ?>
                <div class="container-fluid">
                    <div class="row">
                        <?php if ($this->session->userdata('logged_in')) {
                            $adminid = $this->session->userdata(
                                'logged_roledata'
                            ); ?>
                            <div class="col-sm-3 col-md-3 col-lg-2 left-side navbar-default">
                                <div class="show-menu">
                                    <a id="show-xs-nav" class="visible-xs" href="javascript:void(0)">
                                        <span class="show-sp">
                                            Show menu
                                            <i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i>
                                        </span>
                                        <span class="hidde-sp">
                                            Hide menu
                                            <i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </div>
                                <ul class="sidebar-menu">
    <?php if (
        in_array('addproduct', $adminid) ||
        in_array('editproduct', $adminid) ||
        in_array('deleteproduct', $adminid) ||
        in_array('addcat', $adminid) ||
        in_array('editcat', $adminid) ||
        in_array('deletecat', $adminid) ||
        in_array('addprelaunch', $adminid) ||
        in_array('editprelaunch', $adminid) ||
        in_array('deleteprelaunch', $adminid) ||
        in_array('addattribute', $adminid) ||
        in_array('deleteattribute', $adminid)
    ) { ?>
                                    <li><a href="<?= base_url(
                                        'admin'
                                    ) ?>"><i class="fa fa-home"></i> Dashboard</a></li>
                                    <li class="header">Catalogue</li>
                                    <?php } ?>
                                    <?php if (
                                        in_array('addproduct', $adminid) ||
                                        in_array('editproduct', $adminid) ||
                                        in_array('deleteproduct', $adminid)
                                    ) { ?>
                                    <li><a href="<?= base_url(
                                        'admin/products'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/products'
    ? 'class="active"'
    : '' ?>><i class="fa fa-database" aria-hidden="true"></i> Products</a></li>
                                    <?php } ?>

     <?php if (
         in_array('addcat', $adminid) ||
         in_array('editcat', $adminid) ||
         in_array('deletecat', $adminid)
     ) { ?>
                                    <li><a href="<?= base_url(
                                        'admin/listcategories'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/listcategories'
    ? 'class="active"'
    : '' ?>><i class="fa fa-list-alt" aria-hidden="true"></i> Categories</a></li>
                                    <?php } ?>
                                  

                                    <?php if (
        in_array('addattributes', $adminid) ||
        in_array('editattributes', $adminid) ||
        in_array('deleteattributes', $adminid) ||
        in_array('listattributes', $adminid)
    ) { ?>
                                <li><a href="<?= base_url(
                                        'admin/listattributes'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/listattributes'
    ? 'class="active"'
    : '' ?>><i class="fa fa-list-alt" aria-hidden="true"></i> Attributes</a></li>
<?php } ?>

<?php if (
        in_array('addattributesgroup', $adminid) ||
        in_array('editattributesgroup', $adminid) ||
        in_array('deleteattributesgroup', $adminid) ||
        in_array('listattributesgroup', $adminid)
    ) { ?>
                                <li><a href="<?= base_url(
                                        'admin/listattributesgroup'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/listattributesgroup'
    ? 'class="active"'
    : '' ?>><i class="fa fa-list-alt" aria-hidden="true"></i> Attribute Groups</a></li>
<?php } ?>

<?php if (
        in_array('addpackagingtype', $adminid) ||
        in_array('editpackagingtype', $adminid) ||
        in_array('deletepackagingtype', $adminid) ||
        in_array('listpackagingtype', $adminid)
    ) { ?>
                                <li><a href="<?= base_url(
                                        'admin/listpackagingtype'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/listpackagingtype'
    ? 'class="active"'
    : '' ?>><i class="fa fa-list-alt" aria-hidden="true"></i>Packaging Type</a></li>
<?php } ?>



<?php if (
    in_array('vieworder', $adminid) ||
    in_array('viewdirectorder', $adminid)
) { ?>
                                    <li class="header">Sales</li>
                                    <?php } ?>
                                    <?php if (
                                        in_array('vieworder', $adminid)
                                    ) { ?>
                                    <li><a href="<?= base_url(
                                        'admin/orders'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/orders'
    ? 'class="active"'
    : '' ?>><i class="fa fa-money" aria-hidden="true"></i> Orders
<?php
$this->db->where('orders.viewed ', 0);
$ordercount = $this->db->count_all_results('orders');
?>
     <span class="badge badge-danger" style="background: #d9534f;"><?= $ordercount ?></span>
  <span class="sr-only"></span>
                                    </a></li>
                                    <?php } ?>
                                    <?php if (
                                        in_array('viewdirectorder', $adminid)
                                    ) { ?>
                                    <li>
                                        <a href="<?= base_url(
                                            'admin/directorders'
                                        ) ?>" <?= urldecode(uri_string()) ==
'admin/directorders'
    ? 'class="active"'
    : '' ?>>
                                            <i class="fa fa-money" aria-hidden="true"></i> Direct Orders
                                            <?php
                                            $this->db->where(
                                                'photoordercreate.viewed ',
                                                0
                                            );
                                            $photoordercount = $this->db->count_all_results(
                                                'photoordercreate'
                                            );
                                            ?>
     <span class="badge badge-danger" style="background: #d9534f;"><?= $photoordercount ?></span>
  <span class="sr-only"></span>
                                            <?php
                                        /*?><?php if ($numNotPreviewOrders > 0) { ?>
		<img src="<?= base_url('assets/imgs/exlamation-hi.png') ?>" style="position: absolute; right:10px; top:7px;" alt="">
		<?php } ?><?php */
                                        ?>
                                        </a>
                                    </li>
                                    <?php } ?>

    <?php if (
        in_array('addcustomer', $adminid) ||
        in_array('editcustomer', $adminid) ||
        in_array('delcustomer', $adminid)
    ) { ?>
                                    <li class="header">Customer</li>
                                    <li><a href="<?= base_url(
                                        'admin/listuser'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/listuser'
    ? 'class="active"'
    : '' ?>><i class="fa fa-user" aria-hidden="true"></i> Customers
<?php
$this->db->where('user_app.isverified ', '0');
$colorscount = $this->db->count_all_results('user_app');
?>
     <span class="badge badge-danger" style="background: #d9534f;"><?= $colorscount ?></span>
  <span class="sr-only"></span>
                                    </a></li>
 <?php } ?>


 <?php if (
        in_array('addagent', $adminid) ||
        in_array('editagent', $adminid) ||
        in_array('deleteagent', $adminid) ||
        in_array('listagent', $adminid)
    ) { ?>
                                <li><a href="<?= base_url(
                                        'admin/listagent'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/listagent'
    ? 'class="active"'
    : '' ?>><i class="fa fa-user-secret" aria-hidden="true"></i> Agents</a></li>
<?php } ?>

 <li><a href="<?= base_url('admin/chatlist') ?>" <?= urldecode(uri_string()) ==
'admin/chatlist'
    ? 'class="active"'
    : '' ?>><i class="fa fa-comment" aria-hidden="true"></i> Chat With Customer
<?php
$this->db->where('wpn_chatmessenger.read_status ', '0');
$this->db->where('wpn_chatmessenger.usertype !=', 'admin');
$colorscount = $this->db->count_all_results('wpn_chatmessenger');
?>
     <span class="badge badge-danger" style="background: #d9534f;"><?= $colorscount ?></span>
  <span class="sr-only"></span>
                                    </a></li>




                                    
                                    <li><a href="<?= base_url('admin/chatlistagent') ?>" <?= urldecode(uri_string()) ==
'admin/chatlistagent'
    ? 'class="active"'
    : '' ?>><i class="fa fa-comment" aria-hidden="true"></i> Chat With Agent
<?php
$this->db->where('wpn_chatmessenger1.read_status ', '0');
$this->db->where('wpn_chatmessenger1.usertype !=', 'admin');
$colorscount = $this->db->count_all_results('wpn_chatmessenger1');
?>
     <span class="badge badge-danger" style="background: #d9534f;"><?= $colorscount ?></span>
  <span class="sr-only"></span>
                                    </a></li>

                                
                                     <li>
                                        <a href="<?= base_url(
                                            'admin/newsletter'
                                        ) ?>" <?= urldecode(uri_string()) ==
'admin/newsletter'
    ? 'class="active"'
    : '' ?>><i class="fa fa-bullhorn" aria-hidden="true"></i> SUBSCRIBERS </a> </li>
                                    <?php if (
                                        in_array('addcoupan', $adminid) ||
                                        in_array('editcoupan', $adminid) ||
                                        in_array('delcoupan', $adminid) ||
                                        in_array('addabout', $adminid) ||
                                        in_array('editabout', $adminid) ||
                                        in_array('delabout', $adminid) ||
                                        in_array('addslider', $adminid) ||
                                        in_array('editslider', $adminid) ||
                                        in_array('deleteslider', $adminid) ||
                                        in_array('addslider', $adminid) ||
                                        in_array('editslider', $adminid) ||
                                        in_array('deleteslider', $adminid) ||
                                        in_array('editsettings', $adminid)
                                    ) { ?>
                                        <li class="header">SETTINGS</li>
                                        <?php } ?>

                                    <?php if (
                                        in_array('addabout', $adminid) ||
                                        in_array('editabout', $adminid) ||
                                        in_array('delabout', $adminid)
                                    ) { ?>
                                    <li><a href="<?= base_url(
                                        'admin/listabout'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/listabout'
    ? 'class="active"'
    : '' ?>><i class="fa fa-info" aria-hidden="true"></i> About Us</a></li>
                                    <?php } ?>

									 <?php if (
              in_array('addterm', $adminid) ||
              in_array('editterm', $adminid) ||
              in_array('delterm', $adminid)
          ) { ?>
									<li><a href="<?= base_url('admin/listterm') ?>" <?= urldecode(uri_string()) ==
'admin/listterm'
    ? 'class="active"'
    : '' ?>><i class="fa fa-asterisk" aria-hidden="true"></i> Term & Services</a></li>
                                    <?php } ?>

									 <?php if (
              in_array('addrefund', $adminid) ||
              in_array('editrefund', $adminid) ||
              in_array('delrefund', $adminid)
          ) { ?>
									<li><a href="<?= base_url('admin/listrefund') ?>" <?= urldecode(uri_string()) ==
'admin/listrefund'
    ? 'class="active"'
    : '' ?>><i class="fa fa-reply" aria-hidden="true"></i> Refund Policy </a></li>
                                    <?php } ?>

									 <?php if (
              in_array('addprivacy', $adminid) ||
              in_array('editprivacy', $adminid) ||
              in_array('delprivacy', $adminid)
          ) { ?>
									<li><a href="<?= base_url('admin/listprivacy') ?>" <?= urldecode(
    uri_string()
) == 'admin/listprivacy'
    ? 'class="active"'
    : '' ?>><i class="fa fa-book" aria-hidden="true"></i> Privacy Policy</a></li>
                                    <?php } ?>

                                    <?php if (
                                        in_array('addcoupan', $adminid) ||
                                        in_array('editcoupan', $adminid) ||
                                        in_array('delcoupan', $adminid)
                                    ) { ?>
                                     <li><a href="<?= base_url(
                                         'admin/listcoupan'
                                     ) ?>" <?= urldecode(uri_string()) ==
'admin/listcoupan'
    ? 'class="active"'
    : '' ?>><i class="fa fa-gift" aria-hidden="true"></i> Coupon </a></li>
                                     <?php } ?>
                                     <?php if (
                                         in_array('addslider', $adminid) ||
                                         in_array('editslider', $adminid) ||
                                         in_array('deleteslider', $adminid)
                                     ) { ?>
                                    <li><a href="<?= base_url(
                                        'admin/listslider'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/listslider'
    ? 'class="active"'
    : '' ?>><i class="fa fa-picture-o" aria-hidden="true"></i> Slider</a></li>
                                    <?php } ?>
                                    <?php if (
                                        in_array('editsettings', $adminid)
                                    ) { ?>
                                    <li><a href="<?= base_url(
                                        'admin/settings'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/settings'
    ? 'class="active"'
    : '' ?>><i class="fa fa-wrench" aria-hidden="true"></i> Settings</a></li>
                                    <?php } ?>
<?php if ($this->session->userdata('logged_adminrole') == 1) { ?>
                                    <li><a href="<?= base_url(
                                        'admin/adminusers'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/adminusers'
    ? 'class="active"'
    : '' ?>><i class="fa fa-user" aria-hidden="true"></i> Admin Users</a></li>
                                    <li><a href="<?= base_url(
                                        'admin/addmobileuser'
                                    ) ?>" <?= urldecode(uri_string()) ==
'admin/addmobileuser'
    ? 'class="active"'
    : '' ?>><i class="fa fa-user" aria-hidden="true"></i> Mobile Admin User</a></li>
                                <?php } ?>

                             
                                </ul>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-10 col-sm-offset-3 col-md-offset-3 col-lg-offset-2">
                                <?php if ($warnings != null) { ?>
                                    <div class="alert alert-danger">
                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                        There are some errors that you must fix!
                                        <ol>
                                            <?php foreach (
                                                $warnings
                                                as $warning
                                            ) { ?>
                                                <li><?= $warning ?></li>
                                            <?php } ?>
                                        </ol>
                                    </div>
                                    <?php }
                        } else {
                             ?> <div> <?php
                        } ?>

