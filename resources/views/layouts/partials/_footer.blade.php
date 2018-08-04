<footer class="section__footer">
    <div class="container">
        <div class="footer__body">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-sm-push-4 col-md-6 col-md-push-3">
                    <div class="footer__item">
                        <h2 class="brand__logo">{{ substr(env('HOTEL_NAME'),0,strrpos(env('HOTEL_NAME'),' ')) }}</h2>
                        <p class="brand__sublogo">{{ explode(' ', env('HOTEL_NAME'))[count(explode(' ', env('HOTEL_NAME'))) - 1] }}</p>
                        <ul class="social__icons">
                            <li class="social-icons__item"><a href="#"><i class="icon ion-social-twitter" aria-hidden="true"></i></a></li>
                            <li class="social-icons__item"><a href="#"><i class="icon ion-social-facebook" aria-hidden="true"></i></a></li>
                            <li class="social-icons__item"><a href="#"><i class="icon ion-social-googleplus" aria-hidden="true"></i></a></li>
                        </ul> <!-- .social__icons -->
                    </div> <!-- .footer__item -->
                </div>
                <div class="col-xs-12 col-sm-4 col-sm-pull-4 col-md-3 col-md-pull-6">
                    <div class="footer__item">
                        <ul class="footer__links">
                            <li><a href="#">About</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                        </ul> <!-- .footer__links -->
                    </div> <!-- .footer__item -->
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <div class="footer__item">
                        <h3 class="newsletter__title">Newsletter</h3>
                        <p class="newsletter__subtitle">Subscribe to our email newsletter to receive updates and news.</p>

                        <!-- Newsletter form -->
                        <div id="mc_embed_signup">
                            <form class="newsletter__form validate" method="get" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" novalidate="">
                                <div id="mc_embed_signup_scroll">
                                    <div class="mc-field-group form-group">
                                        <label for="mce-EMAIL" class="sr-only">E-mail address</label>
                                        <input type="email" value="" name="EMAIL" class="required email form-control newsletter_input" id="mce-EMAIL" placeholder="Email address">
                                    </div>
                                    <div id="mce-responses" class="clear">
                                        <div class="response"></div>
                                        <div class="response" id="mce-success-response"></div>
                                    </div>
                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                    <div aria-hidden="true" id="mce-hidden-input">
                                        <input type="text" name="b_507744bbfd1cc2879036c7780_4523d25e1b" tabindex="-1" value="">
                                    </div>
                                    <div class="clear">
                                        <button type="submit" class="btn btn-default btn-newsletter" id="mc-embedded-subscribe">
                                            <i class="icon ion-paper-airplane"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> <!-- #mc_embed_signup -->

                    </div> <!-- .footer__item -->
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .footer__body -->
        <div class="footer__copyright">
            <div class="row">
                <div class="col-xs-12">
                    <hr>
                    <p class="footer_copyright__text">&#169; {{ date('Y') }} {{ env('HOTEL_NAME') }}. All rights reserved.</p>
                </div>
            </div> <!-- / .row -->
        </div> <!-- / .footer__copyright -->

    </div> <!-- / .container -->
</footer> <!-- .section__footer -->