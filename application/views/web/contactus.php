        <!-- Main Content Wrapper Start -->
        <div id="content" class="main-content-wrapper">
            <div class="page-content-inner pt--75">
                <div class="container">
                    <div class="row pb--80">
                        <div class="col-md-7 mb-sm--30">
                            <h2 class="heading__secondary mb--50 mb-md--35 mb-sm--20">Get in touch</h2>
                            <!-- Contact form Start Here -->
                            <form class="form" action="Home/sendmail" id="contact-form">
                                <div class="form__group mb--20">
                                    <input type="text" id="contact_name" name="contact_name" class="form__input form__input--2" placeholder="Your name*" required>
                                </div>
                                <div class="form__group mb--20">
                                    <input type="email" id="contact_email" name="contact_email" class="form__input form__input--2" placeholder="Email Address*" required>
                                </div>
                                <div class="form__group mb--20">
                                    <input type="text" id="contact_phone" name="contact_phone" class="form__input form__input--2" placeholder="Your Phone*" required>
                                </div>
                                <div class="form__group mb--20">
                                    <textarea class="form__input form__input--textarea" id="contact_message" name="contact_message" placeholder="Message*" required></textarea>
                                </div>
                                <div class="form__group">
                                    <button type="submut" class="btn-submit">Send Now</button>
                                </div>
                                <div class="form__output"></div>
                            </form>
                            <!-- Contact form end Here -->
                        </div>
                        <div class="col-md-5 pl--50 pl-sm--30">
                            <h2 class="heading__secondary mb--50">Contact info</h2>

                            <!-- Contact info widget start here -->
                            <div class="contact-info-widget mb--45">
                                <div class="contact-info">
                                    <h3 class="heading__tertiary">Office Address</h3>
                                    <p><?=$footerContactwAddress;?></p>
                                </div>
                            </div>
                            <!-- Contact info widget end here -->

                            <!-- Contact info widget start here -->
                           <!--  <div class="contact-info-widget mb--45">
                                <div class="contact-info">
                                    <h3 class="heading__tertiary">Zakas HQ</h3>
                                    <p>Postal Address <br> PO Box 16122 Collins Street West  <br> Victoria 8007 Australia</p>
                                </div>
                            </div> -->
                            <!-- Contact info widget end here -->

                            <!-- Contact info widget start here -->
                            <div class="contact-info-widget two-column-list sm-one-column mb--45">
                                <div class="contact-info mb-sm--35">
                                    <h3 class="heading__tertiary">Business Phone</h3>
                                    <a href="tel:<?=$footerContactPhone;?>"><?=$footerContactPhone;?></a>
                                </div>
                                <div class="contact-info">
                                    <h3 class="heading__tertiary">Business E-mail</h3>
                                    <a href="mailto:<?=$footerContactEmail;?>"><?=$footerContactEmail;?></a>
                                </div>
                            </div>

                         <!--    <ul class="social social-sharing">
                                <li class="social__item">
                                    <a href="<?=$footerSocialFacebook;?>" class="social__link facebook">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>

                                <li class="social__item">
                                    <a href="<?=$footerSocialYoutube;?>" class="social__link pinterest">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </li>
                                <li class="social__item">
                                    <a href="<?=$footerSocialInstagram;?>" class="social__link pinterest">
                                    <i class="fa fa-instagram"></i>
                                    </a>
                                </li>
                            </ul> -->

                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row no-gutters">
                        <div class="col-12">
                            <div id="google-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3720.0918128360286!2d72.840079015273!3d21.188511387680467!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f169919944d%3A0xf117d8d066b11c93!2sRamrasiya%20Sarees!5e0!3m2!1sen!2sin!4v1605184389555!5m2!1sen!2sin" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main Content Wrapper Start -->

