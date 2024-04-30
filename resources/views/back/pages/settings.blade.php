@extends('back.layout.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Configurações')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="title">
                    <h4>Configurações</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.home') }}">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Configurações
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="pd-20 card-box mb-4">
        @livewire('admin-settings')
    </div>
@endsection
@push('scripts')
    <script>
        $('input[type="file"][name="site_logo"][id="site_logo"]').ijaboViewer({
            preview: '#site_logo_image_preview',
            imageShape: 'rectangular',
            allowedExtensions: ['png', 'jpg'],
            onErrorShape: function(message, element) {
                toastr.error('A imagem deve ser Retangular(2:1)'); 
            },
            onInvalidType: function(message, element) {
                toastr.error('Por favor, selecione uma imagem. de preferência PNG ou JPG.'); 
            }
        });

        $('#change_site_logo_form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var formdata = new FormData(form);
            var inputFileVal = $(form).find('input[type="file"][name="site_logo"]').val();

            if (inputFileVal.length > 0) {
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: formdata,
                    processData: false,
                    dataType: 'json', // Corrigido para dataType
                    contentType: false,
                    beforeSend: function() {
                        toastr.remove();
                        $(form).find('span.error-text').text('');
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            toastr.success(response.msg);
                            $(form)[0].reset();
                        } else {
                            toastr.error(response.msg);
                        }
                    },
                });
            } else {
                $(form).find('span.error-text').text('Por favor, selecione uma imagem. de preferência PNG ou JPG.');
            }
        });

        $('input[type="file"][name="site_favicon"][id="site_favicon"]').ijaboViewer({
            preview: '#site_favicon_image_preview',
            imageShape: 'square',
            allowedExtensions: ['png'],
            onErrorShape: function(message, element) {
                toastr.error('Erro ao carregar a imagem deve ser quadrada(1:1)' ); // Exibir mensagem de erro usando toastr
            },
            onInvalidType: function(message, element) {
                toastr.error('Tipo de arquivo inválido aceitamos somente .png '); // Exibir mensagem de erro usando toastr
            }
        });


        $('#change_site_favicon_form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var formdata = new FormData(form);
            var inputFile = $(form).find('input[type="file"][name="site_favicon"]');

            if (inputFile[0].files.length > 0) {
                $.ajax({
                    url: $(form).attr('action'),
                    method: $(form).attr('method'),
                    data: formdata,
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        toastr.remove();
                        $(form).find('span.error-text').text('');
                    },
                    success: function(response) {
                        if (response.status == 1) {
                            toastr.success(response.msg);
                            $(form)[0].reset();
                        } else {
                            toastr.error(response.msg);
                        }
                    },
                });
            } else {
                $(form).find('span.error-text').text('Por favor, selecione uma imagem, de preferência PNG.');
            }
        });
    </script>
@endpush
