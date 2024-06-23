@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Sense Party')
@section('content')
    <div class="breadcrumb-section breadcrumb-bg" style="height:30%; ">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Sense Party</p>
                        <h1>Nova senha </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="login-box "
        style="background-image: url('/front/assets/imgs/forgot.svg');
        background-size: content; 
        background-repeat: no-repeat;
        background-position: left;
        width: auto; 
        height: 100vh; ">

        <div class="containerr">

            <div class="signin-signup" style="background-color: #07212e; height: 400px; border-radius: 3%; width:  500px">
                <form action="{{ route('seller.reset-password-handler')}}" method="POST" class="sign-in-form"
                    style="justify-content: center;">
                    @csrf
                    <x-alert.form-alert />

                    <input type="hidden" name="token" value="{{ request()->token }}">

                    <h2 class="title" style="color: #f53377;">Nova senha </h2>

                    <div class="input-field">
                        <i class="fa-solid fa-lock" aria-hidden="true"></i>
                        <input type="password" class="form-control form-control-lg" placeholder="Nova Senha"
                            style="margin-top: 0.5rem;" name="new_password" value="{{ old('new_password') }}">
                    </div>

                    @error('new_password')
                        <div class="d-block text-danger" style="margin-top:5px;margin-bottom:5px">{{ $message }}</div>
                    @enderror


                    <div class="input-field">
                        <i class="fa-solid fa-lock" aria-hidden="true"></i>
                        <input style="margin-top: 0.5rem;" type="password" class="form-control form-control-lg"
                            placeholder="Confirme nova senha" name="confirm_new_password"
                            value="{{ old('confirm_new_password') }}">
                    </div>

                    @error('confirm_new_password')
                        <div class="d-block text-danger" style="margin-top:5px;margin-bottom:15px">{{ $message }}</div>
                    @enderror

                    <input type="submit" value="Enviar" class="btn solid">

                </form>

            </div>


        </div>

    </div>

@endsection

