<?php
// index.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cardNumber = $_POST["card_number"];
    $cardHolder = $_POST["card_holder"];
    $cardMonth = $_POST["cardMonth"];
    $cardYear = $_POST["cardYear"];
    $cardCvv = $_POST["cardCvv"];

    // Imprime os valores das variáveis
    echo "Número do cartão: " . $cardNumber . "<br>";
    echo "Titular do cartão: " . $cardHolder . "<br>";
    echo "Mês de validade: " . $cardMonth . "<br>";
    echo "Ano de validade: " . $cardYear . "<br>";
    echo "CVV: " . $cardCvv . "<br>";
}
?>
