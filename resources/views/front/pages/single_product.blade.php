@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Sense Party')
@section('content')


{{-- content --}}

@include('front.layout.inc.single_product')


{{-- Related Products --}}


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
@endsection