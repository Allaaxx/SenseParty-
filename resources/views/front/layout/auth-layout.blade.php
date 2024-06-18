<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- title -->
    <title>@yield('pageTitle')</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="/images/site/{{ get_settings()->site_favicon }}" />
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <!-- bootstrap -->
    <link rel="stylesheet" href="/front/assets/bootstrap/css/bootstrap.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="/front/assets/css/animate.css">
    <!-- mean menu css -->
    <link rel="stylesheet" href="/front/assets/css/meanmenu.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="/front/assets/css/main.css">
    <!-- responsive -->
    <link rel="stylesheet" href="/front/assets/css/responsive.css">
    <script src="https://kit.fontawesome.com/ff01bd9010.js" crossorigin="anonymous"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --color-black: #000000;
            --color-primary: #f0739f;
            --color-secondary: #ebaabd;
            --color-dark: #F53377;
            --color-white: #ffffff;
            --linear-grad: linear-gradient(90deg, var(--color-dark), var(--color-secondary));
        }

        html {
            overflow: hidden;
        }

        body {
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .auth_container {
            position: relative;
            width: 70vw;
            height: 80vh;
            background: #fff;


        }

        .auth_container::before {
            border-radius: 80px 10px;
            content: "";
            position: absolute;
            top: 0;
            left: -50%;
            width: 100%;
            height: 100%;
            background: var(--linear-grad);
            z-index: 6;
            transform: translateX(100%);
            transition: 1s ease-in-out;
        }

        .signin-signup {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
            z-index: 5;
        }

        form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 40%;
            min-width: 238px;
            padding: 0 10px;
        }

        form.sign-in-form {
            opacity: 1;
            transition: 0.5s ease-in-out;
            transition-delay: 1s;
        }

        form.sign-up-form {
            opacity: 0;
            transition: 0.5s ease-in-out;
            transition-delay: 1s;
        }

        .title {
            font-size: 35px;
            color: black;
            margin-bottom: 10px;
        }


        .input-field {
            position: relative;
            width: 100%;
            height: 50px;
            background: #f0f0f0;
            margin: 10px 0;
            border-radius: 50px;
            display: flex;
            align-items: center;
        }



        .input-field::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 2%;
            width: 0;
            height: 2px;
            background-color: var(--color-dark);
            transition: width 1000ms ease;
            /* Transição para animar a largura */
            transform-origin: bottom;
            /* Define a origem da transformação como a parte inferior do pseudoelemento */
        }

        .input-field:focus-within::before {
            width: calc(100% - 20px);
            /* Aumenta a largura para estender até ambas as pontas */
            transform: scaleX(1);
            /* Escala a largura para 1 */
        }




        .input-field i {
            flex: 1;
            text-align: center;
            color: #666;
            font-size: 18px;
        }

        .input-field input {
            flex: 5;
            background: none;
            border: none;
            outline: none;
            width: 100%;
            font-size: 18px;
            font-weight: 600;
            color: #444;
        }

        #sign-up-btn {
            background: transparent;
            border: 2px solid white;
        }

        #sign-up-btn:hover {
            scale: 1.2;
            transition: all 400ms ease;
        }

        #sign-in-btn {
            background: transparent;
            border: 2px solid white;
        }

        #sign-in-btn:hover {
            scale: 1.2;
            transition: all 400ms ease;
        }

        .btn {
            width: 150px;
            height: 50px;
            border: none;
            border-radius: 50px;
            background: var(--color-dark);
            color: #fff;
            font-weight: 600;
            margin: 10px 0;
            text-transform: uppercase;
            cursor: pointer;
        }


        .btn:hover {
            background: var(--color-secondary);
        }

        .social-text {
            margin: 10px 0;
            font-size: 16px;
        }

        .social-media {
            display: flex;
            justify-content: center;
        }

        .social-icon {
            height: 45px;
            width: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #444;
            border: 1px solid #444;
            border-radius: 50px;
            margin: 0 5px;
        }

        a {
            text-decoration: none;
        }

        .social-icon:hover {
            color: var(--color-secondary);
            border-color: var(--color-dark);
        }

        .panels-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        .panel {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-around;
            width: 35%;
            min-width: 238px;
            padding: 0 10px;
            text-align: center;
            z-index: 6;
        }

        .left-panel {
            pointer-events: none;
        }

        .content {
            color: #fff;
            transition: 1.1s ease-in-out;
            transition-delay: 0.5s;
        }

        .panel h3 {
            font-size: 24px;
            font-weight: 600;
        }

        .panel p {
            font-size: 15px;
            padding: 10px 0;
        }

        .image {
            width: 100%;
            transition: 1.1s ease-in-out;
            transition-delay: 0.4s;
        }

        .left-panel .image,
        .left-panel .content {
            transform: translateX(-200%);
        }

        .right-panel .image,
        .right-panel .content {
            transform: translateX(0);
        }

        .account-text {
            display: none;
        }

        /*Animation*/
        .auth_container.sign-up-mode::before {
            transform: translateX(0);
        }

        .auth_container.sign-up-mode .right-panel .image,
        .auth_container.sign-up-mode .right-panel .content {
            transform: translateX(200%);
        }

        .auth_container.sign-up-mode .left-panel .image,
        .auth_container.sign-up-mode .left-panel .content {
            transform: translateX(0);
        }

        .auth_container.sign-up-mode form.sign-in-form {
            opacity: 0;
        }

        .auth_container.sign-up-mode form.sign-up-form {
            opacity: 1;
        }

        .auth_container.sign-up-mode .right-panel {
            pointer-events: none;
        }

        .auth_container.sign-up-mode .left-panel {
            pointer-events: all;
        }

        h2 {
            display: flex;
            flex-direction: column;
            justify-content: center;
            display: center;
        }

        .star {
            position: absolute;
            z-index: 8;
            justify-content: space-around;

        }

        #star1 {
            position: fixed;
            left: 5%;
            top: -60%;
            width: 50px;
            height: 850px;
        }

        #star2 {

            left: -6%;
            top: -80%;
            width: 50px;
            height: 850px;
        }

        #star3 {
            left: -9%;
            top: -95%;
            width: 50px;
            height: 850px;
        }

        #star4 {
            left: 110%;
            top: -120%;
            width: 50px;
            height: 1000px;
        }

        #star5 {
            left: 76.8%;
            top: -63%;
            width: 50px;
            height: 550px;
        }

        #star6 {
            left: 84%;
            top: -84%;
            width: 50px;
            height: 650px;
        }

        #star7 {
            position: absolute;
            left: 90%;
            top: -100%;
            width: 50px;
            height: 850px;
        }

        #star8 {
            left: 100%;
            top: -108%;
            width: 50px;
            height: 850px;
        }

        .confete {
            position: absolute;
            z-index: 6;
            justify-content: space-around;
        }

        #confete1 {
            left: 87%;
            width: 10%;
            height: auto;
        }

        #confete2 {
            left: 80%;
            top: 86%;
            width: 13%;
            height: auto;
        }


        #confete3 {
            left: 1%;
            top: 60%;
            width: 15%;
            height: auto;
        }

        /*Responsive*/
        @media (max-width:779px) {
            .star {
                display: none;
            }

            .confete {
                display: none;
            }

            .auth_container {
                width: 100vw;
                height: 100vh;
            }
        }

        @media (max-width:635px) {
            .star {
                display: none;
            }

            .confete {
                display: none;
            }

            .auth_container::before {
                display: none;
            }

            form {
                width: 80%;
            }

            form.sign-up-form {
                display: none;
            }

            .auth_container.sign-up-mode2 form.sign-up-form {
                display: flex;
                opacity: 1;
            }

            .auth_container.sign-up-mode2 form.sign-in-form {
                display: none;
            }

            .panels-container {
                display: none;
            }

            .account-text {
                display: initial;
                margin-top: 30px;
            }
        }

        @media (max-width:320px) {
            form {
                width: 90%;
            }

            .star {
                display: none;
            }

            .confete {
                display: none;
            }
        }

        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --color-black: #000000;
    --color-primary: #f0739f;
    --color-secondary: #ebaabd;
    --color-dark: #F53377 ;
    --color-white: #ffffff;
    --color-gray: #d8d8d8;
}



h1{
    font-size: 2.5rem;
    font-weight: 700;
}

h2{
    font-size: 1.8rem;
    font-weight: 600;
}

h3{
    font-size: 1.5rem;
    font-weight: 800;
}

h4{
    font-size: 1.2rem;
    font-weight: 600;
}

h5{
    font-size: 1rem;
    font-weight: 400;
}

h6{
   color:var(--color-gray);
}

button{
    font-size: 0.8rem;
    font-weight: 900;
    outline: none;
    border: none;
    background-color: var(--color-black);
    color: var(--color-white);
    padding: 13px 30px;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.5s ease;
}
button:hover{
    background-color: var(--color-primary);

}
#home{
    background-image: url('../imgs/back1.jpg');
    width: 100%;
    height: 100vh;
    background-size: cover;
    background-position-x: 120;
    background-position-y: 0px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
}

#home span{
    color: var(--color-primary);
    background-color: #00000071;
    
}


#new .one img{
    width: 100%;
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size:cover ;

}

#new .one{
    position: relative;
}

#new .one .details{
    position: absolute;
    top: 0;
    left: 0;
    color: var(--color-primary);
    font-weight: bold;
    transition: 0.4s ease;
    opacity: 0.5;
    background-color: #000000b7;
    width: 100%;
    height: 100%;
}

#new .one:hover .details{
   opacity: 0.8;
}

#new .one:nth-child(1) .details{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: flex-start;
    text-align: flex-start;
}


#new .one:nth-child(2) .details{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    text-align: center;
}


#new .one:nth-child(3) .details{
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: flex-end;
    text-align: flex-end;
}

/* Product  */

.product{
    cursor: pointer;
}
.product img{
    width: 100%;
    height: auto;
    box-sizing: border-box;
    object-fit: cover;
    transition: 300ms all;
}



.product:hover img{
    opacity: 0.5;
    transform: scale(1.1);
}

.product .buy-btn{
    background-color: var(--color-primary);
    transform: translatey(50px);
    opacity: 0;
    transition: 0.3 all;
}

.product:hover .buy-btn{
    transform: translatey(0px);
    opacity: 1;

}

hr{
    width: 30px;
    height: 3px !important;
    opacity: 1 !important;
    background-color: var(--color-primary);
}

.star{
    padding: 10px 0;
}

.star i {
    
    font-size: 0.9rem;
    color: goldenrod;
}

#banner{
    background-image: url('../imgs/back2.jpg');
    width: 100%;
    height: 60vh;
    background-size: cover;
    background-position-x: center;
    background-position-y: 80px;
    background-repeat:no-repeat;
    background-attachment: fixed;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
}

#banner h1{
    color: var(--color-primary);
}

#banner button{
    background-color: var(--color-primary);

}

#banner button:hover{
    background-color: var(--color-black);
}

footer{
    background-color: var(--color-black);
}

footer h5{
    color: var(--color-white);
    font-weight: 700;
    font-size: 1.2rem;
}

footer li{
    list-style: none;
    padding-bottom: 4px;
}

footer li a{
    font-size: 0.8rem;
    color: var(--color-white);
    text-decoration: none;
}

footer li a:hover{
    color: var(--color-primary);
}

footer .copyright a{
    color: var(--color-primary);
    height: 40px;
    width: 40px;
    background-color: var(--color-white);
    display: inline-block;
    text-align: center;
    line-height: 40px;
    border-radius: 50%;
    transition: 0.3s ease;
    margin: 0 5px;
    
}

footer .copyright a:hover{
    background-color: var(--color-primary);
    color: var(--color-white);
}

footer p{
    color: var(--color-white);
}

footer .copyright img{
    width: 35%;
}


.logo{
    width: 40px;
    height: 40px;
}

.logo:hover {
    transform: rotate(360deg) scale(1.5); /* Aplicando ambas as transformações ao mesmo tempo */
    transition: transform 0.7s ease-in-out; /* Aplicando a transição apenas para a transformação */
}

.small-img-group{
    display: flex;
    justify-content: space-between;
}

.small-img-col{
    flex-basis: 25%;
    cursor: pointer;
}
.single-product input{
    width: 50px;
    height: 40px;
    padding-left: 10px;
    font-size: 16px;
    margin-right: 10px;
}
.single-product input:focus{
    outline: none;
}

.single-product .buy-btn{
    background-color: var(--color-primary);
    opacity: 1;
    transition: 0.4s all;
}

.single-product .buy-btn:hover{
    background-color: var(--color-black);
}



/* Cart */
.cart table{
    width: 100%;
    border-collapse:collapse;
}

.cart .product-info{
    display: flex;
    flex-wrap: wrap;
}

.cart th{
    text-align: left;
    padding: 5px 10px;
    color: var(--color-white);
    background-color: var(--color-primary);
}

.cart td{
    padding: 10px 20px;
    
}

.cart td img{
    width: 80px;
    height: 80px;
    margin-right: 10px;
}

.cart td input{
    width: 40px;
    height: 30px;
    padding: 5px;
}

.cart td a{
    color: var(--color-primary);
}

.cart .remove-btn{
    color: var(--color-primary);
    text-decoration: none;
    font-size: 14px;
}

.cart .edit-btn{
    color: var(--color-primary);
    text-decoration: none;
    font-size: 15px;
}

.cart .product-info p{
    margin: 3px;
}

.cart-total{
    display: flex;
    justify-content: flex-end;
}

.cart-total table{
    width: 100%;
    max-width: 500px;
    border-top: 3px solid var(--color-primary);
}

td:last-child{
    text-align: right;
}

th:last-child{
    text-align: right;
}

.checkout-btn{
    background-color: var(--color-primary);
    padding: 10px 20px;
    color: var(--color-white);
    text-decoration: none;
    text-transform: uppercase;
    font-size: 14px;
    transition: 0.4s all;
}

.checkout-container{
    
    display: flex;
    justify-content: flex-end;
}


/* Account */

#account-form{
    width: 50%;
    margin: 35px auto;
    text-align: center;
    padding: 20px;
}

#account-form input{
    margin: 5px auto;
}

#account-form #change-pass-btn{
    color: var(--color-white);
    background-color: var(--color-primary);
}

.account-info #orders-btn, #logout-btn{
    color: var(--color-primary);
    background-color: none;
    text-decoration: none;
}

/* Orders */

.orders table{
    width: 100%;
    border-collapse: collapse;
}

.orders .product-info{
    display: flex;
    flex-wrap: wrap;
}

.orders th{
    text-align: left;
    padding: 5px 10px;
    color: var(--color-white);
    background-color: var(--color-primary);
    text-align: left;
}

.orders th:nth-child(2){
    text-align: right;
}
.orders td{
    padding: 10px 20px;
}

.orders td img{
    width: 80px;
    height: 80px;
    margin-right: 10px;
}


/* Checkout */

#checkout-form .checkout-small-element{
    display: inline-block;
    width: 48%;
    margin: 10px auto;
}

#checkout-form .checkout-large-element{
    width: 96%;
}

#checkout-form .checkout-btn-container{
    margin: 10px;
    text-align: right;
    margin-right: 40px;
}

#checkout-form #checkout-btn{
    color: var(--color-white);
    background-color: var(--color-primary);
}

/* Contact */

#contact span{
    color: var(--color-primary);
}
    </style>
    @livewireStyles()
    @stack('stylesheets')
</head>

<body>

    <!-- header -->
    {{-- @include('front.layout.inc.header') --}}

    <!-- search area -->
    @include('front.layout.inc.search-area')



    {{-- content --}}
    @yield('content')




    <!-- jquery -->
    <script src="/front/assets/js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="/front/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- count down -->
    <script src="/front/assets/js/jquery.countdown.js"></script>
    <!-- isotope -->
    <script src="/front/assets/js/jquery.isotope-3.0.6.min.js"></script>
    <!-- waypoints -->
    <script src="/front/assets/js/waypoints.js"></script>
    <!-- owl carousel -->
    <script src="/front/assets/js/owl.carousel.min.js"></script>
    <!-- magnific popup -->
    <script src="/front/assets/js/jquery.magnific-popup.min.js"></script>
    <!-- mean menu -->
    <script src="/front/assets/js/jquery.meanmenu.min.js"></script>
    <!-- sticker js -->
    <script src="/front/assets/js/sticker.js"></script>
    <!-- main js -->
    <script src="/front/assets/js/main.js"></script>
    {{-- login e register --}}
    <script>
        const sign_in_btn = document.querySelector("#sign-in-btn");
        const sign_up_btn = document.querySelector("#sign-up-btn");
        const container = document.querySelector(".auth_container"); 
        const sign_in_btn2 = document.querySelector("#sign-in-btn2");
        const sign_up_btn2 = document.querySelector("#sign-up-btn2");
        sign_up_btn.addEventListener("click", () => {
            container.classList.add("sign-up-mode");
        });
        sign_in_btn.addEventListener("click", () => {
            container.classList.remove("sign-up-mode");
        });
        sign_up_btn2.addEventListener("click", () => {
            container.classList.add("sign-up-mode2");
        });
        sign_in_btn2.addEventListener("click", () => {
            container.classList.remove("sign-up-mode2");
        });
    </script>
    
    @livewireScripts()
    @stack('scripts')
</body>

</html>
