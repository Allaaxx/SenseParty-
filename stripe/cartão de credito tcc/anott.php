<?php
require_once 'vendor/autoload.php';


// <!-- static methods -->
// globally set API key

//  \Stripe\Stripe::setApiKey('
//  sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

//    echo \Stripe\Customer::all();

// per request 
// \Stripe\Stripe::setApiKey('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

// echo \Stripe\Customer::retrieve('cus_Pj4SFclwL9dhiH',[
//   'api_key'=> 'sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l'
// ]);

// With connect
//  \Stripe\Stripe::setApiKey('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

// echo \Stripe\Customer::retrieve(['cus_Pj4SFclwL9dhiH'], ['stripe_account' => 'acct_1OtwLfPAA6eSZJb3']);


// Client services
// Globally set API Key

// with connect
// \Stripe\Stripe::setApiKey('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');
// echo $stripe->customers->retrieve('cus_cus_Pj4SFclwL9dhiH', ['stripe_account' => 'acct_1OtwLfPAA6eSZJb3']);


// define a variavel $stripe como um novo objeto da classe StripeClient

//  $stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

// cria um novo cliente
//  $stripe = new \Stripe\StripeClient();

// $customer = \Stripe\Customer::retrieve('cus_Pj4SFclwL9dhiH'); 
// // retrieve é pra algum especifico

//  $customer2 = \Stripe\Customer::all('');
// all é para todos os clientes

// echo $customer;

// echo $customer2;

// echo $stripe->customers->retrieve('cus_Pj4SFclwL9dhiH');

// echo $stripe->customers->retrieve(
//   'cus_Pj4SFclwL9dhiH',
//   [],
//   ['api_key' => 'sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l']
// );

// // WITH CONNECT
//  $stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');


// \Stripe\Stripe::setApiKey('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

// $stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');


// $customer = $stripe->customers->create([
//     'email' => 'customer@example.com', 
// ], [
//     'stripe_account' => 'acct_1OtwLfPAA6eSZJb3' 
// ]);

// echo "Customer ID: " . $customer->id . "\n";
// echo "Email: " . $customer->email . "\n";


 