<?php

$conn = new mysqli('localhost','root','','parafi')

if($conn -> connect_errno){
    echo"Deu erro";
}else{
    echo"Conexão efetuada";
}

?>