<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Fale Conosco</p>
                    <h1>Sense Party</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact-from-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="form-title">
                    <h2>Tem alguma pergunta?</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur, ratione! Laboriosam est,
                        assumenda. Perferendis, quo alias quaerat aliquid. Corporis ipsum minus voluptate? Dolore, esse
                        natus!</p>
                </div>
                <div id="form_status"></div>
                <div class="contact-form">
                    <form type="POST" id="fruitkha-contact" onsubmit="return valid_datas( this );">
                        <p>
                            <input type="text" placeholder="Nome" name="name" id="name">
                            <input type="email" placeholder="Email" name="email" id="email">
                        </p>
                        <p>
                            <input type="tel" placeholder="Telefone" name="phone" id="phone">
                            <input type="text" placeholder="Assunto" name="subject" id="subject">
                        </p>
                        <p>
                            <textarea name="message" id="message" cols="30" rows="10" placeholder="Mensagem"></textarea>
                        </p>
                        <input type="hidden" name="token" value="FsWga4&amp;@f6aw">
                        <p><input type="submit" value="Enviar"></p>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="contact-form-wrap">
                    <div class="contact-form-box">
                        <h4><i class="fas fa-map"></i> Endereço da Loja</h4>
                        <p>{{ get_settings()->site_address }}</p>
                    </div>
                    <div class="contact-form-box">
                        <h4><i class="far fa-clock"></i> Horário da Loja</h4>
                        <p>SEG - SEX: 8h às 21h <br> SÁB - DOM: 10h às 20h </p>
                    </div>
                    <div class="contact-form-box">
                        <h4><i class="fas fa-address-book"></i> Contato</h4>
                        <p>Telefone: {{ get_settings()->site_phone }} <br> Email: {{ get_settings()->site_email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="find-location blue-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <p> <i class="fas fa-map-marker-alt"></i> Encontre nossa localização</p>
            </div>
        </div>
    </div>
</div>

<div class="embed-responsive embed-responsive-21by9">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3653.359939365258!2d-46.77154302466556!3d-23.698837078705626!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce526d6e3c9793%3A0x489ce1287256b98f!2sEstr.%20da%20Baronesa%2C%2013%20A%20-%20Parque%20do%20Lago%2C%20S%C3%A3o%20Paulo%20-%20SP%2C%2004941-175!5e0!3m2!1spt-BR!2sbr!4v1718231075740!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

