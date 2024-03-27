<?php 
require_once 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

try {
    $account = \Stripe\Account::create([
        'type' => 'standard',
        'country' => 'BR',
        'email' => 'erick.pais12@etec.sp.ogv.br',
        'business_profile' => [
            'mcc' => 8999,
            'name' => 'Erick Pais Shop',
            'product_description' => 'Construindo e realizando seus sonhos!',
            'support_address' => [
                'city' => 'São Paulo', 
                'country' => 'BR',
                'line1' => 'Rua do Decorador, 123',
                'line2' => 'Apto 456',
                'postal_code' => '01234-567',
                'state' => 'SP'
            ],
            'support_email' => 'erick.pais12@etec.sp.ogv.br',
            'support_phone' => '11999999999',
            'support_url' => 'senseparty.netlify.app',
            'url' => 'senseparty.netlify.app'
        ],
        'metadata' => [
            'order_id' => '6735'
        ]
    ]);

    echo "Conta Connect criada com sucesso.\n";
    echo "ID da Conta: " . $account->id . "\n";
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo 'Erro ao criar conta Connect: ' . $e->getMessage();
}
?>
