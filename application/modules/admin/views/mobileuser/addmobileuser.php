<script src="<?=base_url('assets/ckeditor/ckeditor.js')?>"></script>
<h1>Mobile User</h1>
<hr>
<?php
$timeNow = time();
if (validation_errors()) {
	?>
<hr>
<div class="alert alert-danger">
    <?=validation_errors()?>
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
<?php }?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-file"></i> User Details</h3>
            </div>
            <form method="POST" action="" enctype="multipart/form-data">
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 5%;"><a data-toggle="tooltip" title="" class="btn btn-info btn-xs">Name</a></td>
                            <td style="width: 30%;"><input type="text" required id="name" name="name"
                                    placeholder="Enter Name" autocomplete="off"
                                    value="<?=!empty($singlemobileuserlist['name']) ? $singlemobileuserlist['name'] : '';?>"
                                    class="form-control"></td>
                            <td style="width: 5%;"><a data-toggle="tooltip" title="" class="btn btn-info btn-xs">Mobile Number</a></td>
                            <td style="width: 30%;"><input type="text" required id="mobilenumber" name="mobilenumber"
                                    placeholder="Mobile Number" autocomplete="off"
                                    value="<?=!empty($singlemobileuserlist['mobilenumber']) ? $singlemobileuserlist['mobilenumber'] : '';?>"
                                    class="form-control"></td>
                            <td style="width: 5%;"><a data-toggle="tooltip" title="" class="btn btn-info btn-xs">Password</a></td>
                            <td style="width: 30%;"><input type="password" name="passwordm" class="form-control" value="" id="password"></td>
                            <td class="text-left">
                                <input type="hidden" name="pviewcount" placeholder="" value="500" class="form-control">
                                <?php if (!empty($singlemobileuserlist)) {?>
                                <input type="hidden" name="updateid"
                                    value="<?=!empty($singlemobileuserlist['id']) ? $singlemobileuserlist['id'] : '';?>">
                                <button type="submit" class="btn btn-default" name="update"
                                    value="update">Update</button>
                                <?php } else {?>
                                <button type="submit" name="submit"
                                    class="btn btn-lg btn-default btn-addcoupan">Save</button>
                                <?php }?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <?php if ($mobileuserlist) {?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th class="text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mobileuserlist as $row) {?>
                    <tr>
                        <td><?=$row->name;?></td>
                        <td><?=$row->mobilenumber;?></td>
                        <td>
                            <div class="pull-left">
                              <a href="<?=base_url('admin/addmobileuser/?edit=' . $row->id)?>" class="btn btn-info">Edit</a>
                              <a href="<?=base_url('admin/addmobileuser?delete=' . $row->id)?>" class="btn btn-danger confirm-delete">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <?=$links_pagination?>
    </div>
    <?php } else {?>
    <div class="alert alert-info">No Mobileuser found!</div>
    <?php }?>
</div>