<!-- header -->
<div class="top-header-area" id="sticker">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-sm-12 text-center">
        <div class="main-menu-wrap">
          <!-- logo -->
          <div class="site-logo">
            <a href="{{ route('home-page') }}">
              <img style="max-height: 64px;" src="/images/site/{{ get_settings()->site_favicon }}"
                alt="Site Logo">
            </a>
          </div>
          <!-- logo -->

          <!-- menu start -->
          <nav class="main-menu">
            <ul>
              <li><a href="{{ route('home-page') }}">Início</a></li>


              <li><a href="#">Categorias</a>
                <ul class="sub-menu text-left">
                  @if (count(get_categories()) > 0)
                  @foreach (get_categories() as $category)
                  <li>
                    <img src="/images/categories/{{ $category->category_image }}" alt="">
                    <a href="#">{{ $category->category_name }}</a>
                  
                  </li>
                  @endforeach
                  @endif
                </ul>
              </li>
              <li><a href="{{ route('contact-page') }}">Contato</a></li>
              <li><a href="{{ route('shop-page') }}">Loja</a></li>
              </li>
              <li>
                <div class="header-icons">
                  @livewire('cart-counter')
                  <a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                  <a class="mobile-show" href="{{route('seller.auth')}}"><i class="fas fa-user"></i></a>
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