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

        @livewire('single-product', ['id' => $single_produto->id])

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



