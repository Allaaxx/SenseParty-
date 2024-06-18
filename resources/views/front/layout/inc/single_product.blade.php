<!-- Single Product -->

<div class="breadcrumb-section breadcrumb-bg" style="height: 200px; padding: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 m-5">
                <div class="breadcrumb-text">
                    <p style="margin-top: 80px ">{{ $single_produto-> name }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="container single-product my-5 pt-5">
    <div class="row mt-5">
        <div class="col-lg-5 col-md-6 col-sm-12">
            <img src="/images/products/{{ $single_produto->product_image }}" class="img-fluid w-100 pb-1" alt="produto" id="mainImg">
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="/images/products/default-produto.svg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="/images/products/default-produto.svg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col"> 
                    <img src="/images/products/default-produto.svg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="/images/products/default-produto.svg" width="100%" class="small-img" alt="">
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <h2>{{ $single_produto->name }}</h2>
            <div class="breadcrumb-text">
                <p style="margin-top: 80px ">Nome da loja</p>
            </div>
            <h3 class="py-4">R$ {{ $single_produto->price }}</h3>

            <form id="addToCartForm" action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $single_produto->id }}">
                <input type="number" name="quantity" value="1" min="1">
                <button type="submit" class="buy-btn">Adicionar ao Carrinho</button>
            </form>

            <h4 class="my-5">Product details</h4>
            <span>Os detalhes desse produto serão mostrados resumidamente
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit officia rerum veritatis perspiciatis nisi culpa maiores maxime eum, molestiae fuga consequuntur autem dolor fugiat nam vel repellat ea, quam optio?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum, repellat aspernatur. Possimus voluptate a harum, consequuntur nemo, quisquam debitis neque recusandae repellendus soluta accusamus hic consectetur, id nesciunt voluptatum sint?
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolor, assumenda sed voluptatibus, adipisci id molestiae repellendus earum aliquid est ducimus enim nesciunt voluptates sit eos, ad optio delectus nisi laudantium.
            </span>
        </div>
    </div>
</section>

<!-- Related Products -->

<div class="container text-center mt-5 py-5">
    <h3>Produtos Relacionados</h3>
    <hr class="mx-auto">
    <br>
    <div class="row">
        @foreach($produtoPagSingle as $produto)
        <div class="product col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
            <div class="text-center h-100">
                <img class="card-img-top img-fluid mb-3" src="/images/products/{{ $produto->product_image }}" alt="produto">
                <div class="card-body">
                    <div class="star mb-2">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <h5 class="p-name card-title">{{ $produto->name }}</h5>
                    <h4 class="p-price card-text">R$ {{ $produto->price }}</h4>
                    <a href="{{ route('single-product', ['id' => $produto->id]) }}"><button class="buy-btn">Comprar Agora</button></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $produtoPagSingle->onEachSide(0)->links() }}
    </div>
</div>



