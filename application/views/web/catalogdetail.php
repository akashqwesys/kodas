        <!-- Main Content Wrapper Start -->
        <style type="text/css">
            ul.slides li {
                border: 1px solid #000;
                }
            .flex-direction-nav a
            {
                height: 55px;
                margin: -30px 0 0;
            }
        </style>
        <div class="main-content-wrapper">
            <div class="page-content-inner ptb--40">
                <div class="container">
                    <div class="row no-gutters">
                            <div class="col-xl-12  product-main-details text-center" style="padding: 10px">
                                <h1><?php echo strtoupper($item->title); ?></h1>
                            </div>
                        <div class="col-lg-12">
<div class="flexslider" id="slider">
            <ul class="slides">
               <?php if ($catalog_image) {?>
    	           <?php foreach ($catalog_image as $value): ?>
                      <li>
                        <img class="" src="<?php echo $value; ?>" data-zoom-image="<?php echo $value; ?>">
                      </li>
                    <?php endforeach?>
                <?php }?>
            </ul>
          </div>
          <div id="carousel" class="flexslider">
            <ul class="slides">
                 <?php if ($catalog_image) {?>
                   <?php foreach ($catalog_image as $value): ?>
                    <li>
                        <img src="<?php echo $value; ?>">
                    </li>
                    <?php endforeach?>
                <?php }?>
              <!-- items mirrored twice, total of 12 -->
            </ul>
          </div>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center mb--40">
                        <div class="col-12">
                            <div class="product-data-tab tab-style-3">
                                <div class="nav nav-tabs product-data-tab__head mb--35 mb-sm--25" id="product-tab" role="tablist">
                                    <a class="product-data-tab__link nav-link active" id="nav-description-tab" data-toggle="tab" href="#nav-description" role="tab" aria-selected="true">
                                        <span>Description</span>
                                    </a>
                                    <a class="product-data-tab__link nav-link" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab" aria-selected="true">
                                        <span>Additional Information</span>
                                    </a>
                                </div>
                                <div class="tab-content product-data-tab__content" id="product-tabContent">
                                    <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                                        <div class="product-description">
                                            <p><?php echo $item->description; ?></p>

                                            <!-- <h5 class="product-description__heading">Characteristics :</h5>
                                            <ul>
                                                <li><i class="ti-arrow-right"></i><span>Rsit amet, consectetur adipisicing elit, sed do eiusmod tempor inc.</span></li>
                                                <li><i class="ti-arrow-right"></i><span>sunt in culpa qui officia deserunt mollit anim id est laborum. </span></li>
                                                <li><i class="ti-arrow-right"></i><span>Lorem ipsum dolor sit amet, consec do eiusmod tincididu. </span></li>
                                            </ul> -->

                                        </div>
                                    </div>
                                    <div class="tab-pane" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
                                        <div class="table-content table-responsive">
                                            <table class="table" style="width: 50%">
                                                <tbody style="padding: 0px;">
                                                    <?php if ($attribute) {?>
	                                                   <?php foreach ($attribute as $key => $value): ?>
                                                            <tr>
                                                                <th style="padding: 2px;font-size:14px"><?php echo $value['Text']; ?></th>
                                                                <th style="padding: 2px;font-size:14px"><?php echo $value['Value']; ?></th>
                                                            </tr>
                                                        <?php endforeach?>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content Wrapper End -->
