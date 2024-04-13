@extends('layouts.login')

@section('content')
    <div class="d-flex justify-content-center flex-row bg-danger" style="position: relative">
        <div style="position: absolute">
            <img src="images/imagem_login.jpg" alt="imagem background" style="width:100%">
        </div>
        <div class="formulario-login">
            <div class="row justify-content-center align-items-center" style="height: 100vh">
                <div class="col-12 row justify-content-center align-items-center">
                    <div class="card" style="width:400px">
                        <div class="card-body">
                            <div class="card-image d-flex justify-content-center">
                                <img src="images/logo.jpg" alt="Logo opção do bolo" width="100">
                            </div>
                            <div class="text-center mb-5">
                                <h1 class="fw-bold">LOGIN</h1>
                                <h3>Acesse o sistema</h3>
                            </div>
                            <form method="POST" action="{{ route('login') }}" >
                                @csrf

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('E-mail') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary px-5" style="border-radius:20px!important">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
