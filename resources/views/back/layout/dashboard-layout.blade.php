<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>@yield('pageTitle')</title>
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="/images/site/{{ get_settings()->site_favicon }}" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/front/assets/css/all.min.css">
    <link rel="stylesheet" href="/front/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/front/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="/front/assets/css/style.css">
    <link rel="stylesheet" href="/front/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/front/assets/css/animate.css">
    <link rel="stylesheet" href="/front/assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="/front/assets/css/main.css">
    <link rel="stylesheet" href="/front/assets/css/responsive.css">
    <link rel="stylesheet" href="/extra-assets/ijabo/ijabo.min.css">
    <link rel="stylesheet" href="/extra-assets/ijaboCropTool/ijaboCropTool.min.css">
    <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.min.css">
    <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="/extra-assets/summernote/summernote-bs4.min.css">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/back/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />
    <script src="https://kit.fontawesome.com/ff01bd9010.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/front/assets/css/sidebar.css">

    <style>
        .boxed-btn {
            font-family: 'Poppins', sans-serif;
            display: inline-block;
            background-color: var(--color-primary);
            color: var(--color-white);
            padding: 10px 20px;
            border: none;
        }
    </style>
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


    <div class="breadcrumb-section breadcrumb-bg" style="height:30%; ">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        
                    </div>
                </div>
            </div>
        </div>
    </div> 

    
    <div class="container-user">
        @livewire('sidebar-user')

        {{-- content --}}
        @yield('content')
    </div>
    

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
        $(document).ready(function() {
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
                            } else {
                                showToastr('error', response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            showToastr('error',
                                'Erro ao adicionar o produto ao carrinho. Por favor, tente novamente.'
                            );
                        }
                    });
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $(".menu > ul > li").click(function(e) {
                    e.preventDefault(); // Prevenir comportamento padrão do link

                    // Remover a classe active dos irmãos e adicionar ao elemento clicado
                    $(this).toggleClass("active").siblings().removeClass("active");

                    // Toggle para abrir ou fechar o submenu do item clicado
                    $(this).children("ul").slideToggle();

                    // Fechar os submenus dos outros itens se estiverem abertos
                    $(this).siblings().children("ul").slideUp();

                    // Remover a classe active dos itens do submenu dos irmãos
                    $(this).siblings().find("li").removeClass("active");
                });

                $(".menu-btn").click(function(e) {
                    e.preventDefault(); // Prevenir comportamento padrão do botão

                    // Adicionar ou remover a classe active do menu lateral
                    $(".sidebar").toggleClass("active");
                });
            });
        </script>

        <script src="/front/assets/js/script.js"></script>
    @endpush
    @livewireScripts
    @stack('scripts')
</body>

</html>
