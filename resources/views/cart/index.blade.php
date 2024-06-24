@extends('front.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Sense Party')

@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                            <p>seu</p>
                        <h1>Carrinho</h1>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        @livewire('products-table')

                    </div>
                </div>
                <div class="col-lg-4">
                    @livewire('cart-totals')
                    
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        $(document).ready(function() {
            // Função para exibir notificações Toastr
            function showToastr(type, message) {
                toastr.remove();
                toastr[type](message);
            }

            // Manipula o envio do formulário de adicionar ao carrinho
            $(document).ready(function() {
                function showToastr(type, message) {
                    toastr.remove();
                    toastr[type](message);
                }

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

                // Script para remover do carrinho
                $('.remove-from-cart-form').submit(function(e) {
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
                                'Erro ao remover o produto do carrinho. Por favor, tente novamente.'
                            );
                        }
                    });
                });
            });
        });
    </script>
@endpush
