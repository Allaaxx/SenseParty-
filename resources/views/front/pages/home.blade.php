@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Sense Party')
@section('content')


{{-- content --}}
  <!-- home slider -->
@include('front.layout.inc.home')

@include('front.layout.inc.featured')

@include('front.layout.inc.banner')

@include('front.layout.inc.doces')

@endsection