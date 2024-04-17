
<?php 
session_start(); // Inicia a sessão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos 'name' e 'price' estão definidos no formulário
    if(isset($_POST['name']) && isset($_POST['price'])) {
        $productName = $_POST['name'];
        $priceValue = $_POST['price'];

        // Garante que 'price' seja um valor numérico válido
        if (!is_numeric($priceValue)) {
            echo "Price must be a numeric value.";
            exit;
        }

        // Converte o preço para centavos
        $priceInCents = $priceValue * 100; 

        require 'vendor/autoload.php';

        $stripe = new \Stripe\StripeClient('sk_test_51OsUkmAB5JWK6wD3f2b7VAOY4tflew1VxVbgLpdKFTOcEZ3SlQ79CSpLSoygEYCMIEigCZGBgqdzfQ5haxisvpPn00UUBTdp6l');

        // ID da conta para a qual você quer criar o produto e o preço
        $accountId = $_SESSION['accountId'];
 

        // Cria um produto
        $product = $stripe->products->create([
            'name' => $productName, 
        ], ['stripe_account' => $accountId]);

        // Cria um preço associado ao produto na conta especificada
        $price = $stripe->prices->create([
            'unit_amount' => $priceInCents, 
            'currency' => 'BRL', 
            'product' => $product->id, 
        ], ['stripe_account' => $accountId]);

        // Verifica se o preço foi criado com sucesso
        if ($price) {
            echo "Preço criado com sucesso!";

            // Armazena o ID do preço na sessão como uma variável global
            $_SESSION['priceId'] = $price->id;
        } else {
            echo "Erro ao criar o preço.";
        }
    } else {
        echo "Name and price fields are required.";
    }
}
?>