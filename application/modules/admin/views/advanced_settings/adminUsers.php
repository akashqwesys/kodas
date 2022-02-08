<div id="users">
    <h1><img src="<?=base_url('assets/imgs/admin-user.png')?>" class="header-img" style="margin-top:-3px;"> Admin Users</h1>
    <hr>
    <?php if (validation_errors()) {?>
        <hr>
        <div class="alert alert-danger"><?=validation_errors()?></div>
        <hr>
        <?php
}
if ($this->session->flashdata('result_add')) {
	?>
        <hr>
        <div class="alert alert-success"><?=$this->session->flashdata('result_add')?></div>
        <hr>
        <?php
}
if ($this->session->flashdata('result_delete')) {
	?>
        <hr>
        <div class="alert alert-success"><?=$this->session->flashdata('result_delete')?></div>
        <hr>
        <?php
}
?>
    <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_users" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add new user</a>
    <div class="clearfix"></div>
    <?php
if ($users->result()) {
	?>
        <div class="table-responsive">
            <table class="table table-striped custab">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <?php /*?><th>Notifications</th><?php */?>
                        <th>Last login</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <?php foreach ($users->result() as $user) {?>
                    <tr>
                        <td><?=$user->id?></td>
                        <td><?=$user->username?></td>
                        <td><b>hidden ;)</b></td>
                        <td><?=$user->email?></td>
                        <?php /*?><td><?= $user->notify ?></td><?php */?>
                        <td><?=date('d.m.Y - H:i:s', $user->last_login)?></td>
                        <td class="text-center">
                            <div>
                                <a href="?delete=<?=$user->id?>" class="confirm-delete">Delete</a>
                                <a href="?edit=<?=$user->id?>">Edit</a>
                            </div>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </div>
    <?php } else {?>
        <div class="clearfix"></div><hr>
        <div class="alert alert-info">No users found!</div>
    <?php }?>

    <!-- add edit users -->
    <div class="modal fade" id="add_edit_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Administrator</h4>
                    </div>
                    <div class="modal-body">
                          <ul id="myTabs" class="nav nav-pills nav-justified" role="tablist" data-tabs="tabs">
                            <li class="active"><a href="#Profilepage" data-toggle="tab">Profile</a></li>
                            <li><a href="#Permissionpage" data-toggle="tab">Permission</a></li>
                          </ul>
                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="Profilepage">
                                <input type="hidden" name="edit" value="<?=isset($_GET['edit']) ? $_GET['edit'] : '0'?>">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="<?=isset($_POST['username']) ? $_POST['username'] : ''?>" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="" id="password">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" value="<?=isset($_POST['email']) ? $_POST['email'] : ''?>" id="email">
                        </div>
                        <div class="form-group">
                            <label for="notify" style="display:none;">Notifications</label>
                            <input type="hidden" name="notify" class="form-control" value="<?=isset($_POST['notify']) ? $_POST['notify'] : ''?>" placeholder="Get notifications by email: 1 / 0 (yes or no)" id="notify">
                        </div>
                        <div class="form-group">
                            <label for="notify">User Role</label>
                            <select name="adminrole" class="form-control customroleadd" required>
                                <option value="">Select Role</option>
                                <option value="1" <?php if (isset($_POST['adminrole']) && $_POST['adminrole'] == 1) {echo 'selected=""';}?>>Super Admin</option>
                                <option value="2" <?php if (isset($_POST['adminrole']) && $_POST['adminrole'] == 2) {echo 'selected=""';}?>>Admin</option>
                                <option value="3" <?php if (isset($_POST['adminrole']) && $_POST['adminrole'] == 3) {echo 'selected=""';}?>>Employee</option>
                            </select>
                        </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="Permissionpage">

                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <label for="notify">User Status : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="adminstatus" <?php if (isset($_POST['adminstatus']) && $_POST['adminstatus'] == 1) {echo 'checked';}?> value="1"> Active
                            </label>
                            </div>
                        </div>
                        <?php
$userroll = [];
if (isset($_POST['userrole'])) {
	$userroll = explode(",", $_POST['userrole']);
}
?>
                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <label for="notify">Product : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addproduct", $userroll)) {echo 'checked';}?> value="addproduct">Add Product
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editproduct", $userroll)) {echo 'checked';}?> value="editproduct">Edit Product
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("deleteproduct", $userroll)) {echo 'checked';}?> value="deleteproduct">Delete Product
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <label for="notify">Agent : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addagent", $userroll)) {echo 'checked';}?> value="addagent">Add Agent
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editagent", $userroll)) {echo 'checked';}?> value="editagent">Edit Agent
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("deleteagent", $userroll)) {echo 'checked';}?> value="deleteagent">Delete Agent
                                </label>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <label for="notify">Attributes : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addattributes", $userroll)) {echo 'checked';}?> value="addattributes">Add Attributes
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editattributes", $userroll)) {echo 'checked';}?> value="editattributes">Edit Attributes
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("deleteattributes", $userroll)) {echo 'checked';}?> value="deleteattributes">Delete Attributes
                                </label>
                            </div>
                        </div>





                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <label for="notify">Attributes group : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addattributesgroup", $userroll)) {echo 'checked';}?> value="addattributesgroup">Add Attributes group
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editattributesgroup", $userroll)) {echo 'checked';}?> value="editattributesgroup">Edit Attributes group
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("deleteattributesgroup", $userroll)) {echo 'checked';}?> value="deleteattributesgroup">Delete Attributes group
                                </label>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <label for="notify">Packaging Type : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addpackagingtype", $userroll)) {echo 'checked';}?> value="addpackagingtype">Add Packaging Type
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editpackagingtype", $userroll)) {echo 'checked';}?> value="editpackagingtype">Edit Packaging Type
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("deletepackagingtype", $userroll)) {echo 'checked';}?> value="deletepackagingtype">Delete Packaging Type
                                </label>
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <label for="notify">Pre Product : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addprelaunch", $userroll)) {echo 'checked';}?> value="addprelaunch">Add Pre launch
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editprelaunch", $userroll)) {echo 'checked';}?> value="editprelaunch">Edit Pre launch
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("deleteprelaunch", $userroll)) {echo 'checked';}?> value="deleteprelaunch">Delete Pre launch
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                            <label for="notify">Categories : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addcat", $userroll)) {echo 'checked';}?> value="addcat">Add Categories
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editcat", $userroll)) {echo 'checked';}?> value="editcat">Edit Categories
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("deletecat", $userroll)) {echo 'checked';}?> value="deletecat">Delete Categories
                            </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                                <label for="notify">Attribute : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addattribute", $userroll)) {echo 'checked';}?> value="addattribute">Add Attribute
                                </label>
                                <label class="checkbox-inline">
                                  <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("deleteattribute", $userroll)) {echo 'checked';}?> value="deleteattribute">Delete Attribute
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                            <label for="notify">Orders : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("vieworder", $userroll)) {echo 'checked';}?> value="vieworder">View Orders
                            </label>
                            <!-- <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("showordercomment", $userroll)) {echo 'checked';}?> value="showordercomment">show order comment
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("sendordercomment", $userroll)) {echo 'checked';}?> value="sendordercomment">Send order comment
                            </label> -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                            <label for="notify">Direct Orders : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("viewdirectorder", $userroll)) {echo 'checked';}?> value="viewdirectorder">View Direct Orders
                            </label>
                            <!-- <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("showdirectordercomment", $userroll)) {echo 'checked';}?> value="showdirectordercomment">show Direct order comment
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("senddirectordercomment", $userroll)) {echo 'checked';}?> value="senddirectordercomment">Send Direct order comment
                            </label> -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                            <label for="notify">Customer : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addcustomer", $userroll)) {echo 'checked';}?> value="addcustomer">Add Customer
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editcustomer", $userroll)) {echo 'checked';}?> value="editcustomer">Edit Customer
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("delcustomer", $userroll)) {echo 'checked';}?> value="delcustomer">Delete Customer
                            </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                            <label for="notify">About : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addabout", $userroll)) {echo 'checked';}?> value="addabout">Add About
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editabout", $userroll)) {echo 'checked';}?> value="editabout">Edit About
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("delabout", $userroll)) {echo 'checked';}?> value="delabout">Delete About
                            </label>
                            </div>
                        </div>

						 <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                            <label for="notify">Term & Services : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addterm", $userroll)) {echo 'checked';}?> value="addterm">Add Term & Services
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editterm", $userroll)) {echo 'checked';}?> value="editterm">Edit Term & Services
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("delterm", $userroll)) {echo 'checked';}?> value="delterm">Delete Term & Services
                            </label>
                            </div>
                        </div>

						<div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                            <label for="notify">Refund Policy : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addrefund", $userroll)) {echo 'checked';}?> value="addrefund">Add Refund Policy
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editrefund", $userroll)) {echo 'checked';}?> value="editrefund">Edit Refund Policy
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("delrefund", $userroll)) {echo 'checked';}?> value="delrefund">Delete Refund Policy
                            </label>
                            </div>
                        </div>

						<div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                            <label for="notify">Privacy Policy : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addprivacy", $userroll)) {echo 'checked';}?> value="addprivacy">Add Privacy Policy
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editprivacy", $userroll)) {echo 'checked';}?> value="editprivacy">Edit Privacy Policy
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("delprivacy", $userroll)) {echo 'checked';}?> value="delprivacy">Delete Privacy Policy
                            </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                            <label for="notify">Coupan : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addcoupan", $userroll)) {echo 'checked';}?> value="addcoupan">Add Coupan
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editcoupan", $userroll)) {echo 'checked';}?> value="editcoupan">Edit Coupan
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("delcoupan", $userroll)) {echo 'checked';}?> value="delcoupan">Delete Coupan
                            </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                            <label for="notify">Slider : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("addslider", $userroll)) {echo 'checked';}?> value="addslider">Add Slider
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editslider", $userroll)) {echo 'checked';}?> value="editslider">Edit Slider
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("deleteslider", $userroll)) {echo 'checked';}?> value="deleteslider">Delete Slider
                            </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-3 col-md-3 col-lg-3">
                            <label for="notify">Settings : </label>
                            </div>
                            <div class="col-sm-9 col-md-9 col-lg-9">
                            <label class="checkbox-inline">
                              <input type="checkbox" class="autoselectcheck" name="userrole[]" <?php if (in_array("editsettings", $userroll)) {echo 'checked';}?> value="editsettings">Edit Settings
                            </label>
                        </div>
                        </div>
                            </div>
                          </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
<?php if (isset($_GET['edit'])) {?>
        $(document).ready(function () {
            $("#add_edit_users").modal('show');
            $( ".customroleadd" ).change(function () {
                var roleval = $(this).val();
                if(roleval === '1'){
                    $('.autoselectcheck').prop('checked', true);

                }else{
                    $('.autoselectcheck').prop('checked', false);
                }
            });
        });
<?php }?>
</script>
<style type="text/css" media="screen">
ul#myTabs > li {
    background-color: #eee;
}
.tab-content {
    padding: 15px 5px;
}
ul#myTabs li a {
    font-size: 16px;
    font-weight: bold;
}
</style>
