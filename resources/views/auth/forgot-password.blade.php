<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
	<title>إعادة تعيين كلمة المرور</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('forgotpass/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('forgotpass/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('forgotpass/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('forgotpass/vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('forgotpass/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('forgotpass/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('forgotpass/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('forgotpass/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('forgotpass/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('forgotpass/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                    <form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="{{ route('password.email') }}">
                        @csrf

					<span class="login100-form-title">
                    إعادة تعيين كلمة المرور
					</span>

                    <div class="wrap-input100 validate-input">
                        <x-text-input id="email" class="input100" type="email" name="email" :value="old('email')" required autofocus placeholder="أدخل بريدك الألكتروني" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="font-size: 15px;">
                         إعادة تعيين كلمة المرور للبريد الإلكتروني
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>


<!--===============================================================================================-->
	<script src="{{asset('forgotpass/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('forgotpass/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('forgotpass/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('forgotpass/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('forgotpass/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('forgotpass/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('forgotpass/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('forgotpass/vendor/countdowntime/countdowntime.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('forgotpass/js/main.js')}}"></script>

</body>
</html>
