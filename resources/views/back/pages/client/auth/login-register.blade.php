@extends('front.layout.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Sense Party')
@section('content')


{{-- content --}}
@include('front.layout.inc.login-register')

@endsection