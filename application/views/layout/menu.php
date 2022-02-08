   <?php $sitelogo = "";
$query = $this->db->get('value_store');
$result = $query->result_array();
$data = array();
foreach ($result as $key => $value) {
	$key = $value['thekey'];
	$data[$key] = ($value['value'] != '') ? $value['value'] : '';
}

$sitelogo = $data['sitelogo'];

?>

    <!-- Main Wrapper Start -->
    <div class="wrapper">
        <!-- Header Start -->
        <header class="header">
            <div class="header-inner fixed-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-12 col-lg-12 col-3">
                            <nav class="main-navigation">
                                <div class="site-branding">
                                    <a href="<?=base_url();?>" class="logo">
                                        <figure class="logo--transparent">
                                            <img src="<?=base_url('attachments/site_logo/' . $sitelogo)?>" alt="Logo" width="140px">
                                        </figure>
                                        <figure class="logo--normal">
                                            <img src="<?=base_url('attachments/site_logo/' . $sitelogo)?>" alt="Logo" width="140px">
                                        </figure>
                                    </a>
                                </div>
                                <div class="mainmenu-nav d-none d-lg-block">
                                    <ul class="mainmenu">
                                        <li class="mainmenu__item menu-item-has-children">
                                            <a href="<?=base_url();?>" class="mainmenu__link">
                                                <span class="mm-text">Home</span>
                                            </a>
                                            <a href="catalog" class="mainmenu__link">
                                                <span class="mm-text">Catalogue </span>
                                            </a>
                                         <li class="mainmenu__item">
                                            <a href="aboutus" class="mainmenu__link">
                                                <span class="mm-text">About Us</span>
                                            </a>
                                        </li>
                                        <li class="mainmenu__item">
                                            <a href="contactus" class="mainmenu__link">
                                                <span class="mm-text">Contact Us</span>
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mobile-menu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header End -->