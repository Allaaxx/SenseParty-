<div>
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
            @forelse ($cartItems as $cartItem)
                @php
                    $product = $produtos->firstWhere('id', $cartItem->id);
                    $subtotal = $cartItem->price * $cartItem->qty;
                @endphp
                <tr class="table-body-row">
                    <td class="product-remove">
                        <form wire:submit.prevent="removeFromCart('{{ $cartItem->rowId }}')" class="remove-from-cart-form" method="POST" action="{{ route('cart.remove') }}">
                            @csrf
                            <input type="hidden" name="rowId" value="{{ $cartItem->rowId }}">
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
