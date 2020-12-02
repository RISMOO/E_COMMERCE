<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{asset('img/shop.png')}}" />
        <title>Shop</title>
        <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.png')}}"/>
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
        <!--===============================================================================================-->
            <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
            <link rel="icon" type="image/png" href="images/icons/favicon.png"/>
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('fonts/iconic/css/material-design-iconic-font.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('fonts/linearicons-v1.0.0/icon-font.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}})">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/MagnificPopup/magnific-popup.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
            <!--===============================================================================================-->
                <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
                <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">



        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->

    </head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header">Merci de vous identifier </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="col-md-6 offset-md-4 align-items mt-3">
                                    <div class="form-check mr-2">
                                        <input class="form-check-input mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Se souvenir de moi') }}
                                        </label>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <button type="submit" class="btn btn-success btn-block mt-2">
                                            {{ __('S\'identifier') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link mt-2" href="{{ route('password.request') }}">
                                                {{ __('Mot de passe oublié ?') }}
                                            </a>
                                        @endif
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('S\'enregistrer') }}</a>
                                            
                                        </li>

                                    </div>
                                </div>

                            </div>
                        </div>



                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>

