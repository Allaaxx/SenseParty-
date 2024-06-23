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

        <!-- Exibir os produtos paginados -->
        <div class="row">
            @if($pesquisaResultados->isEmpty())
                <h1 style="margin-left: 500px">Nenhum produto encontrado.</h1>
            @else
            @foreach($pesquisaResultados as $produto)


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
        @endif

</section>
