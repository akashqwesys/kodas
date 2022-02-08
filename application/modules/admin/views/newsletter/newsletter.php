<div id="products">
<?php if ($this->session->flashdata('result_delete')) {?> <hr> <div class="alert alert-success"> <?=$this->session->flashdata('result_delete')?> </div> <hr> <?php }
if ($this->session->flashdata('result_publish')) {?> <hr> <div class="alert alert-success"> <?=$this->session->flashdata('result_publish')?> </div> <hr> <?php }?>

  <h1><img src="<?=base_url('assets/imgs/list-user.png')?>" class="header-img" style="margin-top:-2px;"> All Subscribers</h1>
  <hr>
  <div class="row">
    <div class="col-xs-12">
        <?php if ($newsletterlist) {
	?>
        <form method="POST" action="">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Email</th>
                  <th>Suscribe Date</th>
                  <th class="text-right">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($newsletterlist as $row) {
		?>
                <tr>
                  <td><?=$row->id;?></td>
                  <td><?=$row->email;?></td>
                  <td><?=date('d-m-Y H:i A', strtotime($row->dateadded));?>

                  </td>
                  <td> <a href="<?=base_url('admin/newsletter?delete=' . $row->id)?>"  class="btn btn-danger confirm-delete">Delete</a> </div> </td>
               </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
            </form>
            <?=$links_pagination?>
          </div>
          <?php } else {?> <div class ="alert alert-info">No Subscriber Found!</div> <?php }?>
        </div>
