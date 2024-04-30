<!-- footer -->
<div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-box about-widget">
                    <h2 class="widget-title">About us</h2>
                    <img style="height: 60px;" src="/images/site/{{ get_settings()->site_logo }}" alt="logo">
                    <p class="pt-3">{{ get_settings()->site_meta_description }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-box get-in-touch">
                    <h2 class="widget-title">Get in Touch</h2>
                    <ul>
                        <li>
                            <a href="https://maps.google.com/maps?q={{ urlencode(get_settings()->site_address) }}"
                                style="text-decoration: none;" target="_blank">
                                <p>{{ get_settings()->site_address }}</p>
                            </a></li>
                        <li>
                            
                            <a href="mailto:{{ get_settings()->site_email }}" style="text-decoration: none;">
                                <p>{{ get_settings()->site_email }}</p>
                            </a>
                        </li>
                        <li>
                            <p>{{ get_settings()->site_phone }}</p></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-box pages">
                    <h2 class="widget-title">Pages</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="services.html">Shop</a></li>
                        <li><a href="news.html">News</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-box subscribe">
                    <h2 class="widget-title">Subscribe</h2>
                    <p>Subscribe to our mailing list to get the latest updates.</p>
                    <form action="index.html">
                        <input type="email" placeholder="Email">
                        <button type="submit"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end footer -->

<!-- copyright -->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <p>Copyrights &copy; 2026 - <a href="#">Sense Party</a>, All Rights Reserved.</p>
            </div>
            <div class="col-lg-6 text-right col-md-12">
                <div class="social-icons">
                    <ul>
                        <li><a href="{{ get_social_network()->facebook_url }}" target="_blank"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li><a href="{{ get_social_network()->twitter_url }}" target="_blank"><i
                                    class="fab fa-twitter"></i></a></li>
                        <li><a href="{{ get_social_network()->instagram_url }}" target="_blank"><i
                                    class="fab fa-instagram"></i></a></li>
                        <li><a href="{{ get_social_network()->linkedin_url }}" target="_blank"><i
                                    class="fab fa-linkedin"></i></a></li>
                        <li><a href="{{ get_social_network()->youtube_url }}" target="_blank"><i
                                    class="fab fa-youtube"></i></a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end copyright -->
