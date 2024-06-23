@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Sense Party')
@section('content')

 
<div class="breadcrumb-section breadcrumb-bg" style="height:30%; >
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>Sense Party</p>
                    <h1>Autenticação</h1>
                </div>
            </div>
        </div>
    </div>
</div> 

@include('back.layout.inc.authenticate')

@endsection
