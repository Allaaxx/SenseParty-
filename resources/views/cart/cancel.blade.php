@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Sense Party')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Cancelamento do Checkout</div>
                <div class="card-body">
                    <p>Seu checkout foi cancelado. <a href="{{ route('checkout') }}">Tente novamente</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection