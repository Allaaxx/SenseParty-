<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Pegue & Monte</p>
                    <h1>Locação</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="featured" class="my-5 py-5">
    
   {{-- <div class="row mx-auto container">
        @foreach($produtos as $produto)
        <div onclick="window.location.href='{{ route('single-product') }}';" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="/images/products/{{ $produto-> product_image }}" alt="produto">
            <div class="star">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>

            <h5 class="p-name">{{ $produto-> name }}</h5>
            <h4 class="p-price">{{ $produto-> price }}</h4>
            <h4 class="p-name">{{ $produto-> created_at }}</h4>


        </div>
        @endforeach  --}}

        <!-- Exibir os produtos paginados -->
        <div class="row">
            @foreach($produtosPaginados as $produto)
            <div  class="product text-center col-lg-3 col-md-4 col-sm-12">
                <div class="h-100">
                <img class="img-fluid mb-3" src="/images/products/{{ $produto-> product_image }}" alt="produto">
                    <div class="card-body">
                        <div class="breadcrumb-text">
                            <p class="card-title">{{ $produto->name }}</p>
                        </div>
                        <h4 class="card-text">R$ {{ $produto->price }}</h4>
                        <a href="{{ route('single-product', ['id' => $produto->id]) }}"><button class="buy-btn">Locar Agora</button></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{ $produtosPaginados->onEachSide(0)->links() }}

</section>
