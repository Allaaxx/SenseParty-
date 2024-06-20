@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Sense Party')
@section('content')

<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Pedido #1</p>
                    <h1>Concluído com sucesso!</h1>
                    
                </div>

                <button class="button mt-5" style="background-color: black; width: 300px; height: 60px; color: white;" onclick="window.location.href='{{ route('home-page') }}'">Voltar</button>

            </div>
        </div>
    </div>
</div>



@endsection