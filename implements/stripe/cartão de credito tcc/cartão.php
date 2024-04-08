<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartão</title>
    <script src="https://js.stripe.com/v3/"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        #card-element{
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Payment form</h3>
                    </div>
                    <div class="card-body">
                        <form action="submit.php" method="post" id="payment-form">
                            <div class="form-row">
                                <label for="card-element">
                                Credit or debit card
                                </label>
                            <div id="card-element">
                            <!-- A Stripe Element will be inserted here. -->
                            </div>

                                <!-- Used to display Element errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>

                            <button>Submit Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const stripe = Stripe('pk_test_51OsUkmAB5JWK6wD3KcfHRNOVjOLDejmHHt6ZPaCV0iNonzclf4JHojHyM9VNaimWlskmYQ8Hib6jsasmXRFqmhW400acWVK5q0');
        const elements = stripe.elements();
    
        const style = {
        base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            color: '#32325d',
        },
        };

        // Create an instance of the card Element.
        const card = elements.create('card', {style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');


        // Create a token or display an error when the form is submitted.
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const {token, error} = await stripe.createToken(card);

        if (error) {
            // Inform the customer that there was an error.
            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
        } else {
            // Send the token to your server.
            stripeTokenHandler(token);
        }
        });
        const stripeTokenHandler = (token) => {
        // Insert the token ID into the form so it gets submitted to the server
        const form = document.getElementById('payment-form');
        const hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
        }   
    </script>
       
</body>
</html>