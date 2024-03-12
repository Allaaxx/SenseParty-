<?php
// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
$stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

$stripe->accounts->create(['type' => 'standard']);

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
$stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

$stripe->accountLinks->create([
  'account' => '{{CONNECTED_ACCOUNT_ID}}',
  'refresh_url' => 'https://example.com/reauth',
  'return_url' => 'https://example.com/return',
  'type' => 'account_onboarding',
]);

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
$stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

$stripe->checkout->sessions->create(
  [
    'mode' => 'payment',
    'line_items' => [
      [
        'price' => '{{PRICE_ID}}',
        'quantity' => 1,
      ],
    ],
    'payment_intent_data' => ['application_fee_amount' => 123],
    'success_url' => 'https://example.com/success',
    'cancel_url' => 'https://example.com/cancel',
  ],
  ['stripe_account' => '{{CONNECTED_ACCOUNT_ID}}']
);

// https://docs.stripe.com/connect/enable-payment-acceptance-guide?platform=web&shell=true&api=true&resource=account_links&action=create#create-standard-account
?>