<div id="products">
<h1 style="text-transform: capitalize;"><img src="<?=base_url('assets/imgs/list-user.png')?>" class="header-img" style="margin-top:-2px;"> Product Image Review </h1>
<hr>
<?php //echo '<pre>'; print_r($productinfo); exit; ?>
<div class="row">
  <div class="col-xs-12">
    <?php
if ($productimglist) {
	?>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Image</th>
            <th>Like</th>
            <th>Dislike</th>
          </tr>
        </thead>
        <tbody>
          <?php $ij = 0;
	foreach ($productimglist as $row) {
		?>
          <tr>
            <td><img src="<?=$row['Image'];?>" alt="" height="100" width="100"></td>
            <td><button class="btn btn-primary" data-toggle="modal" data-target="#LikeuserData<?=$ij;?>"> <i class="fa fa-thumbs-up" style="font-size: 18px;"></i> <span class="badge badge-light">
              <?=$row['LikeStatus'];?>
              </span> </button>

              <div class="modal fade" id="LikeuserData<?=$ij;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Like User Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              </div>
              <div class="modal-body">
                <table class="table table-bordered">
                  <thead>
                    <th>Name</th>
                    <th>MobileNumber</th>
                  </thead>
                  <tbody>

                    <?php if (!empty($row['LikeUserData'])) {foreach ($row['LikeUserData'] as $likerow) {?>
                      <tr>
                    <td><?=$likerow['Name'];?></td>
                    <td><?=$likerow['MobileNumber'];?></td>
                    </tr>
                    <?php }}?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
            </td>
            <td><button class="btn btn-primary" data-toggle="modal" data-target="#DisLikeuserData<?=$ij;?>"> <i class="fa fa-thumbs-down" style="font-size: 18px;"></i> <span class="badge badge-light">
              <?=$row['DisLikeStatus'];?>
              </span> </button>

              <div class="modal fade" id="DisLikeuserData<?=$ij;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Like User Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              </div>
              <div class="modal-body">
                <table class="table table-bordered">
                  <thead>
                    <th>Name</th>
                    <th>MobileNumber</th>
                  </thead>
                  <tbody>
                    <?php if (!empty($row['DisLikeUserData'])) {foreach ($row['DisLikeUserData'] as $dislikerow) {?>
                    <tr>
                      <td><?=$likerow['Name'];?></td>
                      <td><?=$likerow['MobileNumber'];?></td>
                    </tr>
                    <?php }}?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
            </td>
          </tr>
          <!-- Modal -->
        <?php $ij++;
	}?>
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
<style type="text/css" media="screen">
              .modal-header {
                display: -webkit-box;
                display: -ms-flexbox;
                display: flex;
                -webkit-box-align: start;
                -ms-flex-align: start;
                align-items: flex-start;
                -webkit-box-pack: justify;
                -ms-flex-pack: justify;
                justify-content: space-between;
                padding: 1rem;
                border-bottom: 1px solid #e9ecef;
                border-top-left-radius: .3rem;
                border-top-right-radius: .3rem;
            }
            .modal-title {
                margin-bottom: 0;
                line-height: 1.5;
                font-size: 2.25rem;
                font-family: inherit;
                font-weight: bold;
                color: #000;
            }
            .close:not(:disabled):not(.disabled) {
                cursor: pointer;
            }
            .modal-header .close {
                padding: 1rem;
                margin: -1rem -1rem -1rem auto;
            }
            button.close {
                padding: 0;
                background-color: transparent;
                border: 0;
                -webkit-appearance: none;
            }
      </style>
