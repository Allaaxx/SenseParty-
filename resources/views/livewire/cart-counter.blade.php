<a class="shopping-cart" href="{{ route('cart.index') }}">
    <span class="fa-layers fa-fw">
      <i class="fas fa-shopping-cart"></i>
      <span class="fa-layers-counter cart-counter"> {{\Gloudemans\Shoppingcart\Facades\Cart::content()->count()}}</span>
    </span>
  </a>