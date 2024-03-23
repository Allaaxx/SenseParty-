<?php
require_once('vendor/autoload.php'); // Caminho para o autoload.php fornecido pela Stripe

\Stripe\Stripe::setApiKey('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

try {
    // Crie um pagamento para uma conta conectada específica
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => 1000, // Montante em centavos
        'currency' => 'BRL', // Moeda
        'payment_method_types' => ['card'], // Métodos de pagamento aceitos
        'application_fee_amount' => 100, // Taxa da aplicação em centavos
        'transfer_data' => [
            'destination' => 'acct_1Ov1oQPB0zZS1YTs', // ID da conta conectada
        ],
    ]);

    // O ID do pagamento estará em $paymentIntent->id
    echo "ID do pagamento: " . $paymentIntent->id;
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Trate os erros da API da Stripe
    echo 'Erro ao criar o pagamento: ' . $e->getMessage();
}


?>
