 <!-- Main Content Wrapper Start -->
    <div  class="main-content-wrapper">
        <div class="shop-page-wrapper ptb--80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 order-lg-2 mb-md--50">
                        <div class="shop-toolbar mb--50">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <div class="shop-toolbar__right d-flex justify-content-md-end justify-content-start flex-sm-row flex-column">
                                        <p class="product-pages">Showing Result  <?php echo $currentcatalogs; ?> Among  <?php echo $totalcatalogs; ?> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shop-products">
                            <div class="row">
                                <?php foreach ($catalogs as $item): ?>
                                <div class="col-xl-3 col-sm-6 mb--50">
                                    <div class="zakas-product">
                                        <div class="product-inner">
                                            <figure class="product-image">
                                                <a href="catalogdetail?catalog_id=<?php echo $item->Id; ?>">
                                                    <img src="<?php echo base_url() . '/attachments/shop_images/' . $item->image; ?>" alt="Products">
                                                </a>
                                                <!-- <div class="zakas-product-action">
                                                    <div class="product-action d-flex">
                                                        <a href="" data-toggle="modal" class="action-btn quick-view">
                                                            <i class="flaticon flaticon-eye"></i>
                                                        </a>
                                                    </div>
                                                </div> -->
                                                 <!--  <span class="product-badge"><?php if ($item->price) {echo "Price: ";}?><?php echo !empty($item->price) ? $item->price : NULL; ?></span>
 -->                                            </figure>
                                            <div class="product-info">
                                                <h3 class="product-title mb--25">
                                                    <a href="catalogdetail?catalog_id=<?php echo $item->Id; ?>"><?php echo strtoupper($item->title); ?></a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach?>
                            </div>
                        </div>
                        <nav class="pagination-wrap">
                            <ul class="pagination">
                                <li><a href="catalog?page=<?php echo $page - 1 ?>" class="prev page-number"><i class="fa fa-angle-double-left"></i></a></li>
                                <?php for ($i = 1; $i <= $total_pages; $i++) {?>
                            	<?php if ($page == $i) {?>
                            		<li><a href="catalog?page=<?php echo $i ?>" class="current page-number"><?php echo $i ?></a></li>
                            	<?php } else {?>
                            		<li><a href="catalog?page=<?php echo $i ?>" class="page-number"><?php echo $i ?></a></li>
                            	<?php }?>
                            <?php }?>
                                <li><a href="catalog?page=<?php if ($page + 1 < $total_pages) {echo $page + 1;} else {echo $total_pages;}?>" class="next page-number"><i class="fa fa-angle-double-right"></i></a></li>
                            </ul>
                        </nav>
                    </div>
                   <!--  <div class="col-xl-3 col-lg-4 order-lg-1">
                        <aside class="shop-sidebar">
                            <div class="shop-widget mb--40">
                                <h3 class="widget-title mb--25">Category</h3>
                                <ul class="widget-list category-list">
                                    <li>
                                        <a href="shop.html">
                                            <span class="category-title">Winter Collection</span>
                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.html">
                                            <span class="category-title">Women’s Clothes</span>
                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.html">
                                            <span class="category-title">Men’s Clothes</span>
                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.html">
                                            <span class="category-title">Kid’s Clothes</span>
                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.html">
                                            <span class="category-title">Uncategorized</span>
                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.html">
                                            <span class="category-title">Accessories</span>
                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.html">
                                            <span class="category-title">New Arrival</span>
                                            <i class="fa fa-angle-double-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-widget mb--40">
                                <h3 class="widget-title mb--25">Price</h3>
                                <ul class="widget-list price-list">
                                    <li>
                                        <a href="shop.html">
                                            <span>Low - Medium</span>
                                            <strong class="font-weight-medium">$10.00 - $45.00</strong>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.html">
                                            <span>Medium - High</span>
                                            <strong class="font-weight-medium">$45.00 - $60.00</strong>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.html">
                                            <span>High - Avobe</span>
                                            <strong class="font-weight-medium">$60.00 - $200</strong>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="shop-widget mb--40">
                                <h3 class="widget-title mb--25">Brand</h3>
                                <ul class="widget-list brand-list">
                                    <li>
                                        <a href="shop.html">
                                            <span>Walmart</span>
                                            <strong class="color--red font-weight-medium">10</strong>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.html">
                                            <span>Yellow</span>
                                            <strong class="color--red font-weight-medium">50</strong>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.html">
                                            <span>H &amp; M</span>
                                            <strong class="color--red font-weight-medium">46</strong>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="shop.html">
                                            <span>Black &amp; White</span>
                                            <strong class="color--red font-weight-medium">46</strong>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
<!-- Main Content Wrapper Start -->
