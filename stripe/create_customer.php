<?php
    require_once 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

    $stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');


    $customer = $stripe->customers->create([
    'email' => 'customer@example.com',], 
    ['stripe_account' => 'acct_1OtwLfPAA6eSZJb3']);

echo "Customer ID: " . $customer->id . "\n";
echo "Email: " . $customer->email . "\n";
?>