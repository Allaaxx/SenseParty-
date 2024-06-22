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
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-image">Produto</th>
                                    <th class="product-name">Nome</th>
                                    <th class="product-price">Preço</th>
                                    <th class="product-quantity">Quantidade</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @forelse ($cartItems as $cartItem)
                                    @php
                                        $product = isset($products[$cartItem->id]) ? $products[$cartItem->id] : null;
                                        $subtotal = $cartItem->price * $cartItem->qty;
                                        $total += $subtotal;
                                    @endphp
                                    <tr class="table-body-row">
                                        <td class="product-remove">
                                            <form class="remove-from-cart-form"
                                                  action="{{ route('cart.remove', ['id' => $cartItem->rowId]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $cartItem->id }}">
                                                <button type="submit" class="btn"><i class="far fa-window-close"></i></button>
                                            </form>
                                        </td>
                                        <td class="product-image">
                                            @if ($product && $product->product_image)
                                                <img src="{{ asset('images/products/' . $product->product_image) }}" alt="{{ $product->name }}">
                                            @else
                                                <span>Imagem não disponível</span>
                                            @endif
                                        </td>
                                        <td class="product-name">{{ $product ? $product->name : 'Produto não encontrado' }}</td>
                                        <td class="product-price">$ {{ $cartItem->price }}</td>
                                        <td class="product-quantity">{{ $cartItem->qty }}</td>
                                        <td class="product-total">$ {{ $subtotal }}</td>
                                    </tr>
                                @empty
                                    <tr class="table-body-row">
                                        <td colspan="6">Seu carrinho está vazio!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
                                        <td>R$ {{ $total + 45 }}</td> <!-- Ajuste dinâmico conforme seu cálculo -->
                                    </tr>
                                    <tr class="total-data">
                                        <td colspan="2">
                                            <form method="GET" action="{{ route('checkout') }}">
                                                @csrf <!-- Adiciona o token CSRF -->
                                                <!-- Outros campos do formulário aqui -->
                                                <button type="submit" class="btn btn-primary">Checkout com Stripe</button>
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

