<?php
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

try {
    // Lista de todas as contas em estado "restricted"
    $accounts = \Stripe\Account::all(['limit' => 100]); // Limite definido como 100, você pode ajustar conforme necessário

    // Iterar sobre cada conta restrita e deletá-las
    foreach ($accounts->data as $account) {
        // Verificar se a conta está em estado "restricted"
        if ($account->charges_enabled === false && $account->payouts_enabled === false) {
            // Deletar a conta
            $deletedAccount = \Stripe\Account::retrieve($account->id)->delete();

            // Verificar se a conta foi deletada com sucesso
            if ($deletedAccount->deleted) {
                echo "Conta deletada com sucesso: " . $account->id . "\n";
                echo '<br>';
                echo '<pre>';
            } else {
                echo "Erro ao deletar a conta: " . $account->id . "\n";
                echo '<br>';
                echo '<pre>';
            }
        }
    }
    // ... Restante do código
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Tratar erros da API do Stripe
    echo 'Erro: ' . $e->getMessage();
}
?>
