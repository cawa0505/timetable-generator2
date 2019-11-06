<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Styles -->
		@include('partials.styles')
		@yield('styles')

		<title>Sign In | Timetable</title>
    </head>

    <body class="login-page">
        <div class="container">
            <div class="row">
                @include('partials.banner')
            </div>
            <div class="row ">
                <div class="col-xs-12 col-md-4 col-sm-8 col-lg-4 col-md-offset-4 col-sm-offset-2 col-lg-offset-4">
                    <div id="login-form-container">
                        <div class="login-form-header">
                            <h3 class="text-center">{{env('APP_NAME')}}</h3>
                        </div>
                        <div class="login-form-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                     <form method="POST" action="{{ URL::to('/login') }}">
                                        {!! csrf_field() !!}
                                         <div class="form-group">
                                             <label for="login">Login</label>
                                             <input type="text" id = "login" class="form-control {{$errors->has('login')?'is-invalid':''}}" placeholder="Login" name="login">
                                             @if($errors->has('login'))
                                            <div class="invalid-feedback">{{implode(',',$errors->get('login'))}}</div>
                                             @endif
                                            </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control {{$errors->has('password')?'is-invalid':''}}" placeholder="Password" name="password">
                                            @if($errors->has('password'))
                                            <div class="invalid-feedback">{{implode(',',$errors->get('password'))}}</div>
                                             @endif
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" id="password" name="submit" value="SIGN IN" class="btn btn-lg btn-block btn-custom from-control">
                                        </div>

                                        <div class="form-group">
                                            <a href="/request_reset" class="btn btn-lg btn-block btn-primary">Forgot Password?</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scripts -->
        @include('partials.scripts')
        @yield('scripts')
    </body>
</html>