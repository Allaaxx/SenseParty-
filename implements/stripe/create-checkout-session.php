<?php
require_once 'vendor/autoload.php';

$stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');
$account = $stripe->accounts->create([
    'type' => 'standard'
]);

// Corrigir as URLs de redirecionamento
$refresh_url = 'https://senseparty.netlify.app/404%20erro%20e%20avi%C3%A3o%20de%20papel%20tcc/src/index.html';
$return_url = 'https://dashboard.stripe.com/test/dashboard';

$accountLink = $stripe->accountLinks->create([
    'account' => $account->id,
    'refresh_url' => $refresh_url,
    'return_url' => $return_url,
    'type' => 'account_onboarding',
]);

// Redirecionar para a URL fornecida pelo Stripe
header('Location: ' . $accountLink->url);

?>
