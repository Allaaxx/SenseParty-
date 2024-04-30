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
    <!-- fontawesome -->
	<link rel="stylesheet" href="/front/assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="/front/assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="/front/assets/css/owl.carousel.css">
	<!-- botão -->
    <link rel="stylesheet" href="/front/assets/css/style.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="/front/assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="/front/assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="/front/assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="/front/assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="/front/assets/css/responsive.css">
    <script src="https://kit.fontawesome.com/ff01bd9010.js" crossorigin="anonymous"></script>
    @livewireStyles()
    @stack('stylesheets')
</head>

<body>

    <!-- header -->
    @include('front.layout.inc.header')

    <!-- search area -->
    @include('front.layout.inc.search-area')

  
    
    {{-- content --}}
    @yield('content')

    {{-- testimonail --}}
    @include('front.layout.inc.testimonail')

    <!-- logo carousel -->
    @include('front.layout.inc.logos')

    

    


    <!-- Footer-->
    @include('front.layout.inc.footer')




   
	
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
	<script src="/front/assets/js/login-register.js"></script>
    @livewireScripts()
    @stack('scripts')
</body>

</html>
