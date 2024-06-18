@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Contato')
@section('content')



@include('front.layout.inc.contact')

@endsection


