<p>Querido {{ $seller->name }}</p>
<br>
<p>Sua senha na {{get_settings()->site_name}} foi alterada com sucesso.
    Aqui está suas novas credenciais:
    <br>
    <b>Login ID: </b>{{ isset($seller->username) ? $seller->username.' or ' : '' }}{{
    $seller->email }}
    <br>
    <b>Password: </b>{{ $new_password }}

</p>    

<br>
Por favor, Deixe suas credenciais em um lugar seguro para sua segurança. Seu usuario e senha são suas credenciais de acesso a {{get_settings()->site_name}} e você jamais deve compartilhar-las.

<p>
    Obrigado por escolher a {{get_settings()->site_name}}.
</p>
<br>
-------------------------------------------------
<p>
    Esse email foi enviado automaticamente pelo Sistema {{get_settings()->site_name}}. Por favor, não responda a esse email.
</p>