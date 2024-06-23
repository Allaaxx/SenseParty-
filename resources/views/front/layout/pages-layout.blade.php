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

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/front/assets/css/all.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/front/assets/bootstrap/css/bootstrap.min.css">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="/front/assets/css/owl.carousel.css">

    <!-- Botão -->
    <link rel="stylesheet" href="/front/assets/css/style.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="/front/assets/css/magnific-popup.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="/front/assets/css/animate.css">

    <!-- Mean Menu CSS -->
    <link rel="stylesheet" href="/front/assets/css/meanmenu.min.css">

    <!-- Main Style -->
    <link rel="stylesheet" href="/front/assets/css/main.css">

    <!-- Responsive -->
    <link rel="stylesheet" href="/front/assets/css/responsive.css">

    <!-- Ijabo -->
    <link rel="stylesheet" href="/extra-assets/ijabo/ijabo.min.css">

    <!-- Ijabo Crop Tool -->
    <link rel="stylesheet" href="/extra-assets/ijaboCropTool/ijaboCropTool.min.css">

    <!-- jQuery UI -->
    <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.min.css">
    <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.theme.min.css">

    <!-- Summernote -->
    <link rel="stylesheet" href="/extra-assets/summernote/summernote-bs4.min.css">

    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/ff01bd9010.js" crossorigin="anonymous"></script>

    <!-- Livewire Styles -->
    @livewireStyles()

    <!-- Stylesheets Stack -->
    @stack('stylesheets')
</head>

<body>

    <!-- header -->
    @include('front.layout.inc.header')

    <!-- search area -->
    @include('front.layout.inc.search-area')



    {{-- content --}}
    @yield('content')









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

    <!-- js -->
    <script src="/back/vendors/scripts/core.js"></script>
    <script src="/back/vendors/scripts/script.min.js"></script>
    <script src="/back/vendors/scripts/process.js"></script>
    <script src="/back/vendors/scripts/layout-settings.js"></script>
    <script>
        if (navigator.userAgent.indexOf('Firefox') != -1) {
            history.pushState(null, null, document.URL);
            window.addEventListener('popstate', function() {
                history.pushState(null, null, document.URL);
            });
        }
    </script>

    <script src="/extra-assets/ijabo/ijabo.min.js"></script>
    <script src="/extra-assets/ijabo/jquery.ijaboViewer.min.js"></script>
    <script src="/extra-assets/ijaboCropTool/ijaboCropTool.min.js"></script>
    <script src="/extra-assets/jquery-ui-1.13.2/jquery-ui.min.js"></script>
    <script src="/extra-assets/summernote/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.summernote').summernote({
                height: 200,

            });
        });
    </script>
    <script>
        window.addEventListener('showToastr', function(event) {
            toastr.remove();
            if (event.detail[0].type === 'info') {
                toastr.info(event.detail[0].message);
            } else if (event.detail[0].type === 'success') {
                toastr.success(event.detail[0].message);
            } else if (event.detail[0].type === 'error') {
                toastr.error(event.detail[0].message);
            } else if (event.detail[0].type === 'warning') {
                toastr.warning(event.detail[0].message);
            } else {
                return false;
            }
        });
    </script>

    <!-- Scripts específicos da página -->
@push('scripts')
<script>
    $(document).ready(function() {
        // Função para exibir notificações Toastr
        function showToastr(type, message) {
            toastr.remove();
            toastr[type](message);
        }

        // Manipula o envio do formulário de adicionar ao carrinho
        $('#addToCartForm').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        showToastr('success', response.message);
                        // Aqui você pode adicionar lógica adicional após o sucesso da adição, se necessário
                    } else {
                        showToastr('error', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    showToastr('error', 'Erro ao adicionar o produto ao carrinho. Por favor, tente novamente.');
                }
            });
        });
    });
</script>
@endpush
    @livewireScripts
    @stack('scripts')
</body>

</html>
