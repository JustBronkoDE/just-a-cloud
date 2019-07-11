<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

    <!-- Auth Form Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/auth.css') }}">
</head>
<body>

<div class="auth flip">
    <div class="heading">
        <h1>Productive</h1><!-- Later Image with image background font -->
    </div>
    <div class="left">
        <form role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="wrapper">
                <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                    <i class="glyphicon glyphicon-user"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="E-Mail">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                    <i class="glyphicon glyphicon-lock"></i>
                    <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me <a href="{{ route('password.request') }}">forgot your password?</a>
                </div>
            </div>
            <button type="submit" class="button login-button">Login</button>
        </form>
    </div>
    <div class="right">
        <img src="media/auth-background.jpg" height="100%">
        <div class="content">
            <p class="title">Begleite uns auf,<br> eine Reise...</p>
            <a href="#register" class="button register-button">Sign up</a>
        </div>
        <form role="form" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="wrapper">
                <h2>Registrierung</h2>

                <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="sex" class="col-md-4 control-label">Geschlecht</label>

                    <select class="form-control" name="sex" required autofocus>
                        <option value="male">Männlich</option>
                        <option value="female">Weiblich</option>
                    </select>
                    @if ($errors->has('sex'))
                        <span class="help-block">
                            <strong>{{ $errors->first('sex') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="{{ $errors->has('name') ? ' has-error' : '' }}">
                    <i class="glyphicon glyphicon-user"></i>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="{{ $errors->has('email') ? ' has-error' : '' }}">
                    <i class="glyphicon glyphicon-envelope"></i>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="E-Mail" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                    <i class="glyphicon glyphicon-lock"></i>
                    <input id="password" type="password" name="password" placeholder="Password" required >

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="">
                    <i class="glyphicon glyphicon-lock"></i>
                    <input id="password-confirm" type="password" name="password_confirmation" placeholder="Repeat Password" required>
                </div>
                <div>
                    <input type="checkbox" name="checkbox" required> I have read and understood the <a href="#">terms of service</a>
                </div>
                <button type="submit" class="button blue wave">Register</button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    if (window.innerWidth < 900) {
        window.location.href = '/login';
    }
</script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<!-- Auth Form Js -->
<script type="text/javascript" src="{{ asset('js/auth.js') }}"></script>

</body>
</html>

