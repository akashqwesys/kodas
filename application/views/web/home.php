        <!-- Main Content Wrapper Start -->
        <div class="main-content-wrapper">
            <!-- Slider area Start -->
            <section class="homepage-slider-wrapper mb--95">
                <div class="zakas-element-carousel homepage-slider"
                data-slick-options='{
                    "arrows": true,
                    "isCustomArrow": true,
                    "infinite": true,
                    "autoplay" : true,
                    "autoplaySpeed" : 2500,
                    "prevArrow": {"buttonClass": "slick-btn slick-prev", "iconClass": "fa fa-angle-double-left" },
                    "nextArrow": {"buttonClass": "slick-btn slick-next", "iconClass": "fa fa-angle-double-right" },
                    "appendArrows": ".slick-btn-wrapper"
                }'>

                 <?php foreach ($sliders as $item): ?>
                    <div class="single-slide slider-height bg-style d-flex align-items-center" style="background-image: url(<?=base_url('attachments/slider_img/' . $item->imagename);?>">
                    </div>
                <?php endforeach?>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="slick-btn-wrapper"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Slider area End -->

            <!-- Product Tab area Start -->
            <section class="product-tab-area mb--50">
                <div class="container">
                    <div class="row justify-content-center mb--45">
                        <div class="col-xl-6 text-center">
                            <h2 class="heading__secondary mb--10"><?=$bannerheading;?></h2>
                            <p><?=$bannersubheading;?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="product-tab tab-style-1">
                                <div class="tab-content" id="new-arrival-tab-content">
                                    <div class="tab-pane fade show active" id="new-all" role="tabpanel" aria-labelledby="new-all-tab">
                                        <div class="row">
                                          <?php foreach ($catalogs as $item): ?>
                                            <div class="col-xl-3 col-md-4 col-sm-6 mb--50">
                                                <div class="zakas-product">
                                                    <div class="product-inner">
                                                        <figure class="product-image" style="border:1px solid #000;">
                                                            <a href="catalogdetail?catalog_id=<?php echo $item->Id; ?>">
                                                                <img src="<?php echo base_url() . '/attachments/shop_images/' . $item->image; ?>" alt="Products">
                                                            </a>
                                                           <!--  <span class="product-badge"><?php if ($item->price) {echo "Price: ";}?><?php echo !empty($item->price) ? $item->price : NULL; ?></span> -->
                                                        </figure>
                                                        <div class="product-info">
                                                            <h3 class="product-title mb--15">
                                                                <a href="catalogdetail?catalog_id=<?php echo $item->Id; ?>"><?php echo strtoupper($item->title); ?></a>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Product Tab area End -->
            <!-- Banner Area Start -->

            <div class="banner-area home_01_banner_01 position-relative">
                <div class="conntainer-fluid p-0">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <div class="banner-box">
                                <a href="<?=$bannerlink1;?>" class="banner-link">
                                    <div class="banner-inner banner-bg-shape banner-info-over-img banner-info-center">
                                        <figure class="banner-image">
                                            <img src="<?=base_url('attachments/banner/' . $banner1);?>" alt="Banner">
                                        </figure>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="banner-box">
                                <a href="<?=$bannerlink2;?>" class="banner-link">
                                    <div class="banner-inner banner-bg-shape banner-info-over-img banner-info-center">
                                        <figure class="banner-image">
                                            <img src="<?=base_url('attachments/banner/' . $banner2);?>" alt="Banner">
                                        </figure>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="banner-badge-wrapper abs-center">
                            <span class="banner-badge">
                                <?=$banner;?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Banner Area End -->

            <!-- Method area Start -->
          <!--   <section class="method-area bg-color ptb--80" data-bg-color="#f6f6f6">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 mb-md--50">
                            <div class="method-box">
                                <i class="flaticon flaticon-two-circling-arrows"></i>
                                <h4>90 days return</h4>
                                <p>3 days for free return</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-md--50">
                            <div class="method-box">
                                <i class="flaticon flaticon-paper-plane"></i>
                                <h4>Free Shipping</h4>
                                <p>Free shipping on order</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 mb-xs--50">
                            <div class="method-box">
                                <i class="flaticon flaticon-support"></i>
                                <h4>Proffesional Support</h4>
                                <p>info@company.com</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="method-box">
                                <i class="flaticon flaticon-present"></i>
                                <h4>Gift Card</h4>
                                <p>Gift Card On Purchage</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            <!-- Method area End -->

        </div>
        <!-- Main Content Wrapper End -->

