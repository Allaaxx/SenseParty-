<?php
require_once('vendor/autoload.php');

$token = $_POST['stripeToken'];

$stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');
$account = $stripe->accounts->create([
    'type' => 'standard']);

// echo '<pre>';    
// print_r($account->id);
// echo '</pre>';

$stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

$accountLink = $stripe->accountLinks->create([
    'account' => $account->id,
    'refresh_url' => 'https://example.com/reauth',
    'return_url' => 'https://example.com/return',
    'type' => 'account_onboarding',
]);
header('Location: ' . $accountLink->url);
?>
