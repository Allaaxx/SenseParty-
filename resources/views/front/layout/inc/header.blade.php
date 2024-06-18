<!-- header -->
<div class="top-header-area" id="sticker">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-sm-12 text-center">
        <div class="main-menu-wrap">
          <!-- logo -->
          <div class="site-logo">
            <a href="{{ route('home-page') }}">
              <img style="max-height: 64px" src="/images/site/{{ get_settings()->site_favicon }}" alt="">
            </a>
          </div>
          <!-- logo -->

          <!-- menu start -->
          <nav class="main-menu">
            <ul>
              <li class="current-list-item"><a href="{{ route('home-page') }}">Início</a></li>
              <li><a href="#">Categorias</a>
                @if (count(get_categories()) > 0)
                @foreach  (get_categories() as $category)
                    
                <ul class="sub-menu">
                  <li class="hover-sub"><a href="#" class="categoria">
                    <img src="/images/categories/{{ $category->category_image}}" alt="">
                    
                    <h6>{{ $category->category_name}}</h6>
                    
                    @if( count($category->subcategories) > 0)
                     
                    @endif
                  </a>
                  @if( count($category->subcategories) > 0)
                     <i class="fa fa-angle-down"></i>
                 
                    <div>
                      <ul class="sub-menu-2">
                        @foreach ($category->subcategories as $subcategory)
                        @if ($subcategory->is_child_of == 0)

                        <li class="menu-item"><a href="#"><h6>{{ $subcategory->subcategory_name}}</h6></a>
                          @if (count($subcategory->children) > 0)
                              
                          
                          <ul>
                            @foreach ($subcategory->children as $child_subcategory)
                            <li  class="menu-item">
                              <a href="javascript:void(0)">{{ $child_subcategory->subcategory_name }}</a>
                            </li>
                            @endforeach
                          </ul>
                          @endif
                        </li>
                        @endif
                        @endforeach
                      </ul>
                    </div>

                    @endif
                  </li>
                </ul>
                @endforeach
                @endif
              </li>
              <li><a href="{{ route('contact-page')}}">Contato</a></li>
              <li><a href="{{ route('shop-page') }}">Loja</a></li>
                
              </li>
              <li>
                <div class="header-icons">
                  <!-- Ícone do Carrinho com Contador -->
                  <a class="shopping-cart" href="{{ route('cart.index')}}">
                    <span class="fa-layers fa-fw">
                      <i class="fas fa-shopping-cart"></i>
                      <span class="fa-layers-counter cart-counter">0</span>
                    </span>
                  </a>
                  <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                </div>
              </li>
              

            </ul>
          </nav>
          <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
          <div class="mobile-menu"></div>
          <!-- menu end -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end header -->

<!-- JavaScript para atualizar dinamicamente o contador do carrinho -->
@push('scripts')
<script>
  // Função para atualizar o contador de itens no carrinho
  function updateCartCounter(count) {
    var cartCounter = document.querySelector('.cart-counter');
    if (cartCounter) {
      cartCounter.textContent = count;
      cartCounter.style.display = count > 0 ? 'inline-block' : 'none'; // Exibe o contador apenas se houver itens no carrinho
    }
  }

  // Chamada inicial para exibir o número atual de itens no carrinho
  updateCartCounter({{ count(session('cart', [])) }});

  // Exemplo de como você pode atualizar o contador após adicionar/remover itens
  // Aqui você deve implementar a lógica real para atualizar dinamicamente
  // o contador baseado nas interações do usuário

</script>
@endpush
