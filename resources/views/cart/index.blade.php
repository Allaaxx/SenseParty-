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
                            @if(session('cart'))
                                @foreach(session('cart') as $id => $details)
                                    @php
                                        $product = \App\Models\Product::find($id);
                                    @endphp
                                    <tr class="table-body-row">
                                        <td class="product-remove">
                                            <form class="remove-from-cart-form" action="{{ route('cart.remove', ['id' => $id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $id }}">
                                                <button type="submit" class="btn "><i class="far fa-window-close"></i> </button>
                                            </form>
                                        </td>
                                        <td class="product-image"><img src="/images/products/{{ $product->product_image }}" alt=""></td>
                                        <td class="product-name">{{ $details['name'] }}</td>
                                        <td class="product-price">${{ $details['price'] }}</td>
                                        <td class="product-quantity">{{ $details['quantity'] }}</td>
                                        <td class="product-total">${{ $details['price'] * $details['quantity'] }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="table-body-row">
                                    <td colspan="6">Seu carrinho Está vazio!</td>
                                </tr>
                            @endif
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
                            <tr class="total-data">
                                <td><strong>Subtotal: </strong></td>
                                <td>R$ 500</td> 
                            </tr>
                            <tr class="total-data">
                                <td><strong>Frete: </strong></td>
                                <td>R$ 45</td>
                            </tr>
                            <tr class="total-data">
                                <td><strong>Total: </strong></td>
                                <td>R$ 545</td> 
                            </tr>
                        </tbody>
                    </table>
                    <form action="{{ route('checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="boxed-btn black">Check Out</button>
                    </form>
                </div>

                <div class="coupon-section">
                    <h3>Apply Coupon</h3>
                    <div class="coupon-form-wrap">
                        <form action="index.html">
                            <p><input type="text" placeholder="Coupon"></p>
                            <p><input type="submit" value="Apply"></p>
                        </form>
                    </div>
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
        timeOut: 3000  // Tempo padrão de exibição (3 segundos)
    };

    // Função para exibir notificações Toastr
    function showToastr(type, message) {
        toastr[type](message);
    }

    // Manipula o envio do formulário de remoção do carrinho
    $(document).ready(function() {
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
                        form.closest('.table-body-row').remove();  // Remover a linha da tabela após a remoção bem-sucedida
                    } else {
                        showToastr('error', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    showToastr('error', 'Erro ao remover o produto do carrinho. Por favor, tente novamente.');
                }
            });
        });
    });
</script>
@endpush
