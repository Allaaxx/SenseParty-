<p>Eae o seu viado conhecido como <span style="color: #4FA3B0">{{ $admin->name}}</span></p>

<p>
    Nós recebemos um pedido para redefinir a sua senha da Sense Party Associado ao email {{$admin->email}}. 
    Para redefinir a sua senha, clique no botão abaixo.
    <br>
    <a href="{{ $actionLink }}" target="_blank" style="
    color:#fff; 
    border-color:#4FA3B0; 
    boder-style:solid;
    border-width:5px 10px; 
    background-color:#4FA3B0; 
    padding:10px 20px; 
    text-decoration:none; 
    display:inline-block; 
    border-radius:5px;
    box-shadow:0 2px 3px rgba(0,0,0,0.16);
    -webkit-text-size-adjust:none;
    box-sizing:border-box;
    " >Redefinir Senha</a>

    <br>
    <b>NB:</b>Esse link será valido por 15 minutos

    Se você não fez esse pedido, por favor, ignore este e-mail.

</p>