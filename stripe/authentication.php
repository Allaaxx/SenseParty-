<?php 
    require_once 'vendor/autoload.php';

    \Stripe\Stripe::setApiKey('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

    $stripe = new \Stripe\StripeClient();


    $deletedCustomer = \Stripe\Customer::retrieve('cus_PjP5zXF7T5Aa20')->delete();

    echo \Stripe\Customer::all();
    
    echo \Stripe\Customer::retrieve('cus_PjRhoJrrCrlSqf', [
      'stripe_account' => 'acct_1OtwLfPAA6eSZJb3'
    ]);
?>