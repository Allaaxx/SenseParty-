<?php

require_once 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

try {
    $deletedAccount = \Stripe\Account::retrieve('acct_1Ov69JPEhGtp5wXV')->delete();
    
    echo "Connect account deleted successfully.";
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo 'Error deleting Connect account: ' . $e->getMessage();
}

?>
