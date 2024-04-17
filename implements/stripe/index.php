<html>
  <head>
    <title>Checkout</title>
  </head>
  <body>
    <form action="create-checkout-session.php" method="POST">
      <button type="submit">Logar Stripe</button>
    </form>


    <form action="product-create.php" method="post" enctype="multipart/form-data"> <!-- Adicione enctype="multipart/form-data" para permitir o upload de arquivos -->
      
      <input type="text" name="name" placeholder="Nome do Produto">
      <input type="text" name="price" placeholder="Preço do Produto">
      
      <button type="submit">Create product</button>
    </form>

    <form action="deleteall.php">
      <input type="submit" value="Deletar todas as contas restritas">
    </form>

    <form action="session-payments.php">
      <input type="submit" value="Pagamento de sessão">
    </form>
  </body>
</html>

<?php
    
    session_start(); // Inicia a sessão
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verifica se os campos 'name' e 'price' estão definidos no formulário
        if(isset($_POST['name']) && isset($_POST['price'])) {
            $productName = $_POST['name'];
            $price = $_POST['price'];
    
            // Garante que 'price' seja um valor numérico válido
            if (!is_numeric($price)) {
                echo "Price must be a numeric value.";
                exit;
            }
    
            // Calcula o preço em centavos
            $priceInCents = $price * 100;
    
            // ID da conta para a qual você quer criar o produto
            $accountId = 'acct_1Ov1oQPB0zZS1YTs';
    
            // Salva as variáveis na sessão
            $_SESSION['accountId'] = $accountId;
            $_SESSION['priceInCents'] = $priceInCents;
            $_SESSION['productName'] = $productName;
    
            // Redireciona o usuário para outro arquivo PHP após o processamento do formulário
            header("Location: product-create.php");
            exit;
        } else {
            echo "Name and price fields are required.";
        }
    }

     
     
    ?>
