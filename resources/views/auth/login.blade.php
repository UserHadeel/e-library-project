<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
	<title>صفحة تسجيل الدخول</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('loginpage/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('loginpage/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('loginpage/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('loginpage/ivendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('loginpage/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('loginpage/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('loginpage/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('loginpage/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>



	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">


				<form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
					@csrf
					<span class="login100-form-title">
						تسجيل الدخول
					</span>

                    <div class="wrap-input100 validate-input" >
                        <x-text-input id="email" class="input100" type="email" name="email" :value="old('email')" required autofocus  autocomplete="username" placeholder="البريد الألكتروني"  />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>

                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />


                    <div class="wrap-input100 validate-input" >
                        <x-text-input id="password" class="input100"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" placeholder="كلمة السر" />
                        <span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />

					<div>
                    @if (session('error'))
                    <div class="alert alert-danger">
                    {{ session('error') }}
                    </div>
                     @endif
                    </div>


					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							تسجيل الدخول
						</button>
					</div>

                    <div class="text-center p-t-12" >
                        @if (Route::has('password.request'))
                            <a class="txt2" href="{{ route('password.request') }}">
                                {{ __('هل نسيت كلمة السر؟') }}
                            </a>
                        @endif
                    </div>

					<div class="text-center p-t-136">
						<a class="txt2" href="{{ route('register') }}">
                                ليس لديك حساب
							<i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>

				<div class="login100-pic js-tilt" data-tilt>
					<img src="{{asset('loginpage/images/img-01.png')}}" alt="IMG">
				</div>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="{{asset('loginpage/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('loginpage/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('loginpage/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('loginpage/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('loginpage/vendor/tilt/tilt.jquery.min.js')}}"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('loginpage/js/main.js')}}"></script>

</body>
</html>
