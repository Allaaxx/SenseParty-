<!-- área do rodapé -->
<div class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="footer-box about-widget">
                    <h2 class="widget-title">Sobre nós</h2>
                    <img style="height: 60px;" src="/images/site/{{ get_settings()->site_logo }}" alt="logo">
                    <p class="pt-3">{{ get_settings()->site_meta_description }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-box get-in-touch">
                    <h2 class="widget-title">Entre em contato</h2>
                    <ul>
                        <li>
                            <a href="https://maps.google.com/maps?q={{ urlencode(get_settings()->site_address) }}"
                                style="text-decoration: none;" target="_blank">
                                <p>{{ get_settings()->site_address }}</p>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:{{ get_settings()->site_email }}" style="text-decoration: none;">
                                <p>{{ get_settings()->site_email }}</p>
                            </a>
                        </li>
                        <li>
                            <p>{{ get_settings()->site_phone }}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-box pages">
                    <h2 class="widget-title">Páginas</h2>
                    <ul>
                        <li><a href="index.html">Início</a></li>
                        <li><a href="about.html">Sobre</a></li>
                        <li><a href="services.html">Loja</a></li>
                        <li><a href="news.html">Notícias</a></li>
                        <li><a href="contact.html">Contato</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-box subscribe">
                    <h2 class="widget-title">Inscreva-se</h2>
                    <p>Inscreva-se na nossa lista de e-mails para receber as últimas atualizações.</p>
                    <form action="index.html">
                        <input type="email" placeholder="Email">
                        <button type="submit"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fim do rodapé -->

<!-- direitos autorais -->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <p>Direitos autorais &copy; 2026 - <a href="#">Sense Party</a>, Todos os direitos reservados.</p>
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
<!-- fim dos direitos autorais -->
