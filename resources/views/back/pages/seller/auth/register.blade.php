@extends('back.layout.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title here')
@section('content')
    
<div class="login-box bg-white box-shadow border-radius-10">
    <div class="login-title">
        <h2 class="text-center text-primary">Seja um "Arquiteto de Sonhos"</h2>
    </div>
    <form action="{{ route('seller.create')}}" method="POST">
        @csrf
        <x-alert.form-alert/>

        <div class="form-group">
            <label for="">Nome Completo: </label>
            <input type="text" class="form-control" placeholder="Digite o nome completo" name="name" value="{{old ('name') }}">
            @error('name')
                <span class="text-danger ml-2">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="">E-mail: </label>
            <input type="text" class="form-control" placeholder="Digite o endereço de e-mail" name="email" value="{{old ('email') }}">
            @error('email')
                <span class="text-danger ml-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Senha: </label>
            <input type="text" class="form-control" name="password" placeholder="Digite sua senha">
            @error('password')
                <span class="text-danger ml-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="">Confirmar Senha: </label>
            <input type="text" class="form-control" name="confirm_password" placeholder="Digite sua senha">
            @error('confirm_password')
                <span class="text-danger ml-2">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-0">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Criar conta</button>
                </div>
                <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373" style="color:rgb(112, 115, 115)">OU</div>
                <div class="input-group mb-0">
                    <a href="{{ route('seller.login')}}" class="btn btn-outline-primary btn-lg btn-block">Conectar-se</a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection