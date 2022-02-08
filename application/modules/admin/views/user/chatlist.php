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
  <h1><img src="<?=base_url('assets/imgs/list-user.png')?>" class="header-img" style="margin-top:-2px;"> Chat List</h1>
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
              <!-- <th class="text-right">Action</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
foreach ($userlist as $row) {
		?>
            <tr>
              <td style="cursor: pointer;" onclick="mychatroom(<?=$row->id;?>,'<?=$row->name;?>');"><?=$row->name;?>
                <span class="badge badge-danger" style="background: #d9534f;color: #fff; float: right;">
                <?=$row->readstatus;?>
                </span></td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
      <!-- <?=$links_pagination?> -->
    </div>
    <div class="col-md-9">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title" id="mycustommsgtitle"><i class="fa fa-info-circle"></i> Chat Message </h3>
        </div>
        <div class="tbl-header">
          <div class="col-sm-3">Username</div>
          <div class="col-sm-3">Message</div>
          <div class="col-sm-3">Audio</div>
          <div class="col-sm-3">Date & Time</div>
        </div>
        <div class="panel-body">
          <table class="table table-bordered" cellpadding="4">
            <!-- <thead>
        <tr>
          <td class="text-center">Username</td>
          <td class="text-left">Message</td>
          <td class="text-center">Audio</td>
          <td class="text-center">Date & Time</td>
        </tr>
      </thead> -->
            <tbody id="msgdata">
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"> Send Message</h3>
            </div>
            <form style="padding: 10px 20px;" method="post">
              <div class="form-group">
                <input type="hidden" name="sender_id" id="sender_id" value="1" />
                <input type="hidden" name="receiver_id" id="receiver_id" value="" />
                <textarea class="form-control" name="commentmsg" id="commentmsg"></textarea>
                <div id="sucessmsg" style="color: green;margin: 10px 5px;"></div>
              </div>
              <button type="button" name="sendmessagechat" class="sendmsgtochat btn btn-primary">Send</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
} else {
	?>
<div class ="alert alert-info">No user found!</div>
<?php }?>
</div>
<style type="text/css" media="screen">
.table-fixed{
  width: 100%;
  background-color: #f3f3f3;
}
.table-fixed tbody{
  height:620px;
  overflow-y:auto;
  width: 100%;
}
.table-fixed thead,.table-fixed tbody,.table-fixed tr,.table-fixed td,.table-fixed th{
  display:block;
}
.tbl-header .col-sm-3 {
  background: #3333;
  padding: 10px;
  border-bottom: 2px solid #3333;
  color: #33333;
  font-weight: 600;
  text-align: center;
}
.panel-body {
  /*padding: 15px;*/
  padding-top: 0;
  padding-right: 0;
  padding-left: 0.1px;
  max-height: 395px;
  height: 395px;
  overflow: auto;
}
td.text-left {
  width: 275px;
  text-align: center;
}
#content {
    padding-bottom: 50px;
}
</style>
