@extends('back.layout.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Meus Produtos</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('seller.home')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Meus Produtos
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a href="{{route('seller.product.add-product')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Adicionar novo produto</a>
            </div>
        </div>
    </div>
    @livewire('seller.products')
@endsection
