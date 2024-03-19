<?php
require_once 'vendor/autoload.php';

    $stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');
    $account = $stripe->accounts->create([
        'type' => 'standard']);
    
    // echo '<pre>';    
    // print_r($account->id);
    // echo '</pre>';
    
    $accountLink = $stripe->accountLinks->create([
        'account' => $account->id,
        'refresh_url' => 'https://example.com/reauth',
        'return_url' => 'https://example.com/return',
        'type' => 'account_onboarding',
    ]);
    header('Location: ' . $accountLink->url);


    $stripe->checkout->sessions->create(
    [
        'mode' => 'payment',
        'line_items' => [
        [
            'price' => $price,
            'quantity' => $quantity,
        ],
        ],
        'payment_intent_data' => ['application_fee_amount' => 123],
        'success_url' => 'https://example.com/success',
        'cancel_url' => 'https://example.com/cancel',
    ],
    ['stripe_account' => $account->id]
    );
?>