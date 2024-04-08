<?php
session_start(); // Inicia a sessão

// Verifica se $_SESSION['priceId'] está definida e não vazia
if(isset($_SESSION['priceId'])) {
    $priceId = $_SESSION['priceId'];

    // Agora você pode usar $priceId conforme necessário
    echo "O ID do preço é: " . $priceId;
} else {
    echo "A variável de sessão 'priceId' não está definida.";
}   
require_once('vendor/autoload.php'); // Caminho para o autoload.php fornecido pela Stripe

\Stripe\Stripe::setApiKey('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

try {
    // Crie uma sessão de checkout com o Stripe Checkout
    $session = \Stripe\Checkout\Session::create([
        'mode' => 'payment',
        'line_items' => [
            [
                'price' => $priceId, // ID do preço definido na sua conta da Stripe
                'quantity' => 1,
            ],
        ],
        'payment_intent_data' => [
            'application_fee_amount' => 2000, // Taxa da aplicação em centavos
        ],
        'success_url' => 'https://senseparty.netlify.app/ecommerce%20tcc/pruduct%20page%20css/index.html',
        'cancel_url' => 'https://senseparty.netlify.app/404%20erro%20e%20avi%C3%A3o%20de%20papel%20tcc/src/index.html',
    ],
    ['stripe_account' => 'acct_1Ov1oQPB0zZS1YTs']); // Especifica a conta conectada da Stripe

    // Imprime a URL de checkout, se necessário
   

  
     $checkout_session_id = $session->id; // Obtém o ID da sessão de Checkout

    // Recupera o ID da cobrança associada ao Checkout existente
     $checkout_session = \Stripe\Checkout\Session::retrieve($checkout_session_id);
     $payment_intent_id = $checkout_session->payment_intent;

     // Instancia o cliente Stripe
     $stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

     // Processa um reembolso para a cobrança associada ao Checkout
     $stripe->refunds->create([
         'charge' => $payment_intent_id,
         'refund_application_fee' => true,
     ]);

     echo "Reembolso processado com sucesso para a cobrança associada ao Checkout!";
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Trata os erros da API da Stripe
    echo 'Erro: ' . $e->getMessage();
}
$checkout_url = $session->url;

header("Location: $checkout_url");
exit;
?>
