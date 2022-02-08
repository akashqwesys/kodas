<?php $sitelogo = '';
$query = $this->db->get('value_store');
$result = $query->result_array();
$data = [];
foreach ($result as $key => $value) {
    $key = $value['thekey'];
    $data[$key] = $value['value'] != '' ? $value['value'] : '';
}
$sitelogo = $data['sitelogo'];
$facebook = $data['footerSocialFacebook'];
$youtube = $data['footerSocialYoutube'];
$instagram = $data['footerSocialInstagram'];
$pinterest = $data['footerSocialPinterest'];
$linkedin = $data['footerSocialLinkedin'];
$twitter = $data['footerSocialTwitter'];
$footercopyright = $data['footercopyright'];
?>
<!-- Footer Start-->
<div class="container">
    <div class="row justify-content-center" style="margin-bottom: 15px !important;margin-top: 10px !important">
        <li class="header-toolbar__item">
            <a href="https://play.google.com/store/apps/details?id=com.ramrasiya" class="header-toolbar__btn">
                <img src="<?= base_url() ?>webassets/img/android.png">
            </a>
        </li>
        <li class="header-toolbar__item">
            <a href="https://apps.apple.com/in/app/ramrasiya/id1545907020" class="header-toolbar__btn">
                <img src="<?= base_url() ?>webassets/img/apple.png">
            </a>
        </li>
    </div>
</div>
<footer class="footer">
    <div class="footer-top bg-color ptb--50" data-bg-color="#f6f6f6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 text-center">
                    <div class="footer-widget mb--50">
                        <div class="textwidget">
                            <img src="<?= base_url(
                                'attachments/site_logo/' . $sitelogo
                            ) ?>" alt="Logo" width="250px">
                        </div>
                    </div>
                    <div class="footer-widget mb--50 pb--1">
                        <ul class="footer-menu">
                            <li><a href="aboutus">About Us</a></li>
                            <!-- <li><a href="">Terms &amp; Conditions</a></li> -->
                            <!-- <li><a href="">Policy</a></li> -->
                            <li><a href="catalog">Catalogue</a></li>
                            <li><a href="contactus">Contact Us</a></li>
                            <li><a href="privacypolicy">Privacy Policy</a></li>
                            <li><a href="termandservices">Term & Services</a></li>
                            <li><a href="refundpolicy">Refund Policy</a></li>
                        </ul>
                    </div>
                         <div class="footer-widget">
                        <ul class="social">
							<?php if (!empty($facebook)) { ?>
                            <li class="social__item">
                                <a href="<?= $facebook ?>" class="social__link facebook">
                                    <span>facebook</span>
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
							<?php } ?>

							<?php if (!empty($instagram)) { ?>
                            <li class="social__item">
                                <a href="<?= $instagram ?>" class="social__link pinterest">
                                    <span>Instagram</span>
                                    <i class="fa fa-instagram"></i>
                                </a>
                            </li>
							<?php } ?>
							<?php if (!empty($twitter)) { ?>
                            <li class="social__item">
                                <a href="<?= $twitter ?>" class="social__link twitter">
                                    <span>Twitter</span>
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
							<?php } ?>
							<?php if (!empty($pinterest)) { ?>
                            <li class="social__item">
                                <a href="<?= $pinterest ?>" class="social__link pinterest">
                                    <span>pinterest</span>
                                    <i class="fa fa-pinterest"></i>
                                </a>
                            </li>
							<?php } ?>
							<?php if (!empty($linkedin)) { ?>
                            <li class="social__item">
                                <a href="<?= $linkedin ?>" class="social__link linkedin">
                                    <span>LinkedIn</span>
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
							<?php } ?>
							<?php if (!empty($youtube)) { ?>
                            <li class="social__item">
                                <a href="<?= $youtube ?>" class="social__link pinterest">
                                    <span>youtube</span>
                                    <i class="fa fa-youtube"></i>
                                </a>
                            </li>
							<?php } ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom bg-color ptb--25" data-bg-color="#e7e7e7">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-6 text-sm-left text-center mb-xs--10">
                    <p class="copyright-text"><a href=""><?= $footercopyright ?></a> </p>
                </div>
                <div class="col-sm-6 text-sm-right text-center">
                    <p class="copyright-text"><a href="https://premware.services" target="_blank">Developed By Premware Services India LLP</a></p>
                    <!--   <figure>
                        <img src="assets/img/others/payment.png" alt="payment">
                    </figure> -->
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End-->
<!-- Global Overlay Start -->
<div class="zakas-global-overlay"></div>
<!-- Global Overlay End -->
</div>
<!-- Main Wrapper End -->
<!-- ************************* JS Files ************************* -->
<!-- jQuery JS -->
<script src="<?php echo base_url(); ?>webassets/js/vendor.js"></script>
<!-- Main JS -->
<script src="<?php echo base_url(); ?>webassets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js"></script>
<script src="<?php echo base_url(); ?>webassets/js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA==" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){
if ($.cookie('popup') != '1') {
$('#fancybox-container-1').show();
$.cookie('popup', '1');
}else{
$('#fancybox-container-1').hide();
}
$("#close").click(function(){
$('#fancybox-container-1').hide();
});
});
</script>
</body>
</html>
