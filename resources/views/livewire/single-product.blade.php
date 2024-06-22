<div class="col-lg-6 col-md-12 col-sm-12">
    <h2>{{ $single_produto->name }}</h2>
    <div class="breadcrumb-text">
        <p style="margin-top: 80px">Nome da loja</p>
    </div>
    <h3 class="py-4">R$ {{ $single_produto->price }}</h3>

    <!-- livewire/single-product.blade.php -->

    <form wire:submit.prevent="addToCart" id="addToCartForm" action="{{ route('cart.add') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $single_produto->id }}">
        <input wire:model="quantity.{{ $single_produto->id }}" type="number" name="quantity" min="1">
        <button type="submit" class="buy-btn">Adicionar ao Carrinho</button>
    </form>
    

    <h4 class="my-5">Detalhes do Produto</h4>
    <span>
        Os detalhes desse produto serão mostrados resumidamente.
        <!-- Adicione os detalhes conforme necessário -->
    </span>
</div>
