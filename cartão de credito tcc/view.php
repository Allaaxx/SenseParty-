<?php
require_once 'vendor/autoload.php';

$stripeApiKey = 'sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l';

$stripe = new \Stripe\StripeClient([
    'api_key' => $stripeApiKey
]);

$accounts = $stripe->accounts->all([]);

foreach ($accounts as $account) {
    echo "ID da Conta: " . $account->id . "\n";
    echo "Nome da Empresa: " . $account->business_profile->name . "\n";
    echo "Email da Conta: " . $account->email . "\n";
    // Adicione outras informações que você deseja exibir sobre cada conta
    echo "------------------------------------------\n";
}
?>
