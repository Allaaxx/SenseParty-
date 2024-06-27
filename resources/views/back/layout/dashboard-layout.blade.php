<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <title>@yield('pageTitle')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="/images/site/{{ get_settings()->site_favicon }}" />
    {{-- google font --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    {{-- jquery --}}

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="/front/assets/css/all.min.css">
    <link rel="stylesheet" href="/front/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/front/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="/front/assets/css/style.css">
    <link rel="stylesheet" href="/front/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="/front/assets/css/animate.css">
    <link rel="stylesheet" href="/front/assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="/front/assets/css/main.css">
    <link rel="stylesheet" href="/front/assets/css/responsive.css">
    <!-- Ijabo -->
    <link rel="stylesheet" href="/extra-assets/ijabo/ijabo.min.css">
    <link rel="stylesheet" href="/extra-assets/ijaboCropTool/ijaboCropTool.min.css">

    <!-- jQuery UI -->
    <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.min.css">
    <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.structure.min.css">
    <link rel="stylesheet" href="/extra-assets/jquery-ui-1.13.2/jquery-ui.theme.min.css">
    <!-- Summernote -->
    <link rel="stylesheet" href="/extra-assets/summernote/summernote-bs4.min.css">

    <!-- Inclua os arquivos do Kropify -->
    <link rel="stylesheet" href="/vendors/mberecall/kropify/css/kropify.min.css">
    <script src="/vendors/mberecall/kropify/js/kropify.min.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="/back/vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css" />
    <script src="https://kit.fontawesome.com/ff01bd9010.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="/front/assets/css/sidebar.css">

    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>

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
    @kropifyStyles
    @livewireStyles()

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

    <!-- js -->
    

    <!-- Load jQuery first -->
    
    <script src="/back/vendors/scripts/core.js"></script>

    <!-- jQuery UI -->
    <script src="/extra-assets/jquery-ui-1.13.2/jquery-ui.min.js"></script>

    <!-- Bootstrap -->
    <script src="/back/src/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="/back/vendors/scripts/script.min.js"></script>
    <script src="/back/vendors/scripts/process.js"></script>
    <script src="/back/vendors/scripts/layout-settings.js"></script>

    <!-- Plugins -->
    <script src="/back/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/back/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="/back/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="/back/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    
    <script src="/back/src/plugins/highcharts-6.0.7/code/highcharts.js"></script>
    <script src="/back/src/plugins/highcharts-6.0.7/code/highcharts-more.js"></script>
    <script src="/back/src/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="/back/src/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    

    <!-- Ijabo and Summernote -->
    <script src="/extra-assets/ijabo/ijabo.min.js"></script>
    <script src="/extra-assets/ijaboCropTool/ijaboCropTool.min.js"></script>
    <script src="/extra-assets/summernote/summernote-bs4.min.js"></script>
    <script src="/extra-assets/ijabo/jquery.ijaboViewer.min.js"></script>
    <script>
        if (navigator.userAgent.indexOf('Firefox') != -1) {
            history.pushState(null, null, document.URL);
            window.addEventListener('popstate', function() {
                history.pushState(null, null, document.URL);
            });
        }
    </script>


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
    <script src="/front/assets/js/script.js"></script>
    @kropifyScripts
    @livewireScripts
    @stack('scripts')
</body>

</html>
