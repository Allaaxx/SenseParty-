@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Esqueci a senha')
@section('content')


    <div class="breadcrumb-section breadcrumb-bg" style="height:30%; ">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Sense Party</p>
                        <h1>Esqueceu a senha?</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="login-box " style="background-image: url('/front/assets/imgs/forgot.svg');
            background-size: content; 
            background-repeat: no-repeat;
            background-position: left;
            width: auto; 
            height: 100vh; ">

        <div class="containerr">

            <div class="signin-signup" style="background-color: #07212e; height: 400px; border-radius: 3%; width:  500px">
                <form action="{{ route('seller.send-password-reset-link') }}" method="POST" class="sign-in-form" style="justify-content: center;">
                    @csrf
                    <x-alert.form-alert />


                    <h2 class="title" style="color: #f53377;">Esqueceu a senha?</h2>

                    <div class="input-field">
                        <i class="fas fa-user" aria-hidden="true"></i>
                        <input type="text" class="form-control form-control-lg" style="margin-top: 0.4rem;"
                            placeholder="Email" name="email" value="{{ old('email') }}">
                    </div>


                    <input type="submit" value="Enviar" class="btn solid">

                </form>

            </div>

            
        </div>
        
    </div>


@endsection
