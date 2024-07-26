<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- End Required meta tags -->
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="192x192" href="/ic_launcher.png">
    <link rel="shortcut icon" href="/ic_launcher.png">
    <meta name="theme-color" content="#3063A0"><!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600" rel="stylesheet"><!-- End Google font -->
    <!-- BEGIN PLUGINS STYLES -->
    <link rel="stylesheet" href="/template/vendor/fontawesome/css/all.css"><!-- END PLUGINS STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link rel="stylesheet" href="/template/stylesheets/theme.min.css" data-skin="default">
    <link rel="stylesheet" href="/template/stylesheets/theme-dark.min.css" data-skin="dark">
    <link rel="stylesheet" href="/template/stylesheets/custom.css"><!-- Disable unused skin immediately -->
    <script>
      var skin = localStorage.getItem('skin') || 'default';
      var unusedLink = document.querySelector('link[data-skin]:not([data-skin="' + skin + '"])');
      unusedLink.setAttribute('rel', '');
      unusedLink.setAttribute('disabled', true);
    </script><!-- END THEME STYLES -->
  </head>
  <body>
    <!--[if lt IE 10]>
    <div class="page-message" role="alert">You are using an <strong>outdated</strong> browser. Please <a class="alert-link" href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</div>
    <![endif]-->
    <!-- .auth -->
    <main class="auth">
      <header id="auth-header" class="auth-header" style="background: #f6f7f9; padding-top: 0;">
        <h1>
          <img src="/logo_decor.jpeg" alt="" style="padding: 30px"> <span class="sr-only">Sign In</span>
        </h1>
        <p style="font-size: 24px; color: black; font-weight: bold;">APR Digital</p>
      </header><!-- form -->
      <form class="auth-form" method="POST" action="{{ route('login') }}">

        @csrf

        <!-- .form-group -->
        <div class="form-group">
          <div class="form-label-group">
            {{-- <input type="text" id="inputUser" class="form-control" placeholder="Username" required="" autofocus=""> <label for="inputUser">Username</label> --}}
            <input id="inputUser" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required="" autocomplete="email" autofocus="">
            <label for="inputUser">E-mail</label>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <div class="form-label-group">

            <input id="inputPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            <label for="inputPassword">Senha</label>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

          </div>
        </div><!-- /.form-group -->
        <!-- .form-group -->
        <div class="form-group">
          <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Entrar') }}</button>
        </div><!-- /.form-group -->

        <!-- .form-group -->
        <div class="form-group text-center">
          <div class="custom-control custom-control-inline custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="remember-me" name="remember" {{ old('remember') ? 'checked' : '' }}> 
            <label class="custom-control-label" for="remember-me">{{ __('Lembrar') }}</label>
          </div>
        </div><!-- /.form-group -->


        <!-- recovery links -->
        <div class="text-center pt-3">
          {{-- <a href="auth-recovery-username.html" class="link">Forgot Username?</a>  --}}
          {{-- <span class="mx-2">·</span>  --}}
          {{-- <a href="{{ route('password.request') }}" class="link">{{ __('Forgot Your Password?') }}</a> --}}
        </div><!-- /recovery links -->

      </form><!-- /.auth-form -->
      <!-- copyright -->
      {{-- <footer class="auth-footer"> © 2020 Decor Empreendimentos --}}
      </footer>
    </main><!-- /.auth -->
    <!-- BEGIN BASE JS -->
    <script src="/template/vendor/jquery/jquery.min.js"></script>
    <script src="/template/vendor/bootstrap/js/popper.min.js"></script>
    <script src="/template/vendor/bootstrap/js/bootstrap.min.js"></script> <!-- END BASE JS -->
    <!-- BEGIN PLUGINS JS -->

    <!-- BEGIN THEME JS -->
    <script src="/template/javascript/theme.min.js"></script> <!-- END THEME JS -->

  </body>
</html>