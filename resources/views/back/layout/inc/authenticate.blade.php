<div class="containerr">
    <div class="container-auth">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="{{ route('seller.login-handler') }}" method="POST" class="sign-in-form">
                    @csrf
                    <x-alert.form-alert />

                    <h2 class="title">Entrar</h2>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Email / Username" name="login_id" value="{{ old('login_id') }}">
                    </div>

                    @error('login_id')
                    <div class="d-block text-danger" style="margin-bottom: 15px;">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Senha" name="password">
                    </div>

                    @error('password')
                    <div class="d-block text-danger" style="margin-bottom: 15px;">
                        {{ $message }}
                    </div>
                    @enderror

                    <input type="submit" value="Entrar" class="btn solid" />

                    <p class="social-text">Ou entre com plataformas sociais</p>
                    <div class="social-media">
                        <a href="{{route('facebook-auth') }}" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="{{ route('google-auth')}}" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>

                    <div class="forgot-password text-center mt-3">
                        <a href="{{ route('seller.forgot-password') }}" style="color: #333; text-decoration: none;">Esqueceu a senha?</a>
                    </div>
                </form>

                <form action="{{ route('seller.create') }}" method="POST" class="sign-up-form">
                    @csrf
                    <x-alert.form-alert />

                    <h2 class="title">Cadastrar</h2>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nome completo" name="name" value="{{ old('name') }}">
                    </div>

                    @error('name')
                    <div class="text-danger ml-2">{{ $message }}</div>
                    @enderror

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="E-mail" name="email" value="{{ old('email') }}">
                    </div>

                    @error('email')
                    <div class="text-danger ml-2">{{ $message }}</div>
                    @enderror

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Senha" name="password">
                    </div>

                    @error('password')
                    <div class="text-danger ml-2">{{ $message }}</div>
                    @enderror

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Confirmar senha" name="confirm_password">
                    </div>

                    @error('confirm_password')
                    <div class="text-danger ml-2">{{ $message }}</div>
                    @enderror

                    <input type="submit" class="btn" value="Cadastrar" />

                    <p class="social-text">Ou cadastre-se com plataformas sociais</p>
                    <div class="social-media">
                        <a href="{{route('facebook-auth') }}" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="{{ route('google-auth')}}" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Novo aqui?</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis, ex ratione. Aliquid!</p>
                    <button class="btn transparent" id="sign-up-btn">Cadastrar</button>
                </div>
                <img src="/front/assets/imgs/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Já tem uma conta?</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum laboriosam ad deleniti.</p>
                    <button class="btn transparent" id="sign-in-btn">Entrar</button>
                </div>
                <img src="/front/assets/imgs/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>
</div>
