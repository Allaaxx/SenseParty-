@extends('front.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Sense Party')

@section('content')
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Cart</h1>
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
                    <div class="total-section">
                        <table class="total-table">
                            <thead class="total-table-head">
                                <tr class="table-total-row">
                                    <th>Total</th>
                                    <th>Preço</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0; // Inicializa a variável $total
                                @endphp
                                @if (!$cartItems->isEmpty())
                                    <tr class="total-data">
                                        <td><strong>Subtotal: </strong></td>
                                        <td>R$ {{ $total }}</td>
                                    </tr>
                                    <tr class="total-data">
                                        <td><strong>Frete: </strong></td>
                                        <td>R$ 45</td> <!-- Ajuste dinâmico conforme seu cálculo -->
                                    </tr>
                                    <tr class="total-data">
                                        <td><strong>Total: </strong></td>
                                        <td>R$ {{ $total + 45 }}</td>
                                        <!-- Ajuste dinâmico conforme seu cálculo -->
                                    </tr>
                                    <tr class="total-data">
                                        <td colspan="2">
                                            <form method="GET" action="{{ route('checkout') }}">
                                                @csrf <!-- Adiciona o token CSRF -->
                                                <!-- Outros campos do formulário aqui -->
                                                <button type="submit" class="btn btn-primary">Checkout com
                                                    Stripe</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>


                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        // Configuração padrão do Toastr
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: 'toast-top-right',
            preventDuplicates: true,
            timeOut: 3000 // Tempo padrão de exibição (3 segundos)
        };

        // Função para exibir notificações Toastr
        function showToastr(type, message) {
            toastr[type](message);
        }
    </script>
@endpush
