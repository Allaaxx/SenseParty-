@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Sense Party')
@section('content')


{{-- content --}}
  <!-- home slider -->
@include('front.layout.inc.home')

@include('front.layout.inc.featured')

@include('front.layout.inc.banner')

@include('front.layout.inc.doces')

<!-- testimonail-section -->
<div class="testimonail-section mt-150 mb-150">
  <div class="container">
      <div class="row">
          <div class="col-lg-10 offset-lg-1 text-center">
              <div class="testimonial-sliders">
                  <div class="single-testimonial-slider">
                      <div class="client-avater">
                          <img src="/front/assets/imgs/avaters/client1.png" alt="">
                      </div>
                      <div class="client-meta">
                          <h3>Gabriel Câmara <span>Auxiliar Administrativo Sabesp</span></h3>
                          <p class="testimonial-body">
                              " Adorei o atendimento, a qualidade dos produtos e a pontualidade na entrega. Recomendo!"
                          </p>
                          <div class="last-icon">
                              <i class="fas fa-quote-right"></i>
                          </div>
                      </div>
                  </div>
                  <div class="single-testimonial-slider">
                      <div class="client-avater">
                          <img src="/front/assets/imgs/avaters/client2.png" alt="">
                      </div>
                      <div class="client-meta">
                          <h3>Pedro Leal <span>Desempregado</span></h3>
                          <p class="testimonial-body">
                              " Adorei a possibilidade de parcelar a compra em até 3x sem juros. Isso facilitou muito a minha vida!"
                          </p>
                          <div class="last-icon">
                              <i class="fas fa-quote-right"></i>
                          </div>
                      </div>
                  </div>
                  <div class="single-testimonial-slider">
                      <div class="client-avater">
                          <img src="/front/assets/imgs/avaters/client3.png" alt="">
                      </div>
                      <div class="client-meta">
                          <h3>Gabriel Fabricio<span>Local shop owner</span></h3>
                          <p class="testimonial-body">
                              " A Sense Party é o melhor Ecommerce para eventos . Sempre compro aqui e nunca me arrependi!"
                          </p>
                          <div class="last-icon">
                              <i class="fas fa-quote-right"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
<!-- end testimonail-section -->

@endsection
