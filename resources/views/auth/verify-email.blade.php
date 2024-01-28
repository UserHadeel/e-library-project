
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
                    <div class="login100-form validate-form p-l-55 p-r-55 p-t-178" >
                        @csrf

					<span class="login100-form-title">
                        التحقق من عنوان البريد الإلكتروني
    				</span>
                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                        <p>شكرا لتسجيلك! قبل البدء، هل يمكنك التحقق من عنوان بريدك الإلكتروني عن طريق النقر على الرابط الذي أرسلناه إليك للتو عبر البريد الإلكتروني؟ إذا لم تتلق رسالة البريد الإلكتروني، فسنرسل لك بكل سرور رسالة أخرى.</p>
                        {{-- {{ __('شكرا لتسجيلك! قبل البدء، هل يمكنك التحقق من عنوان بريدك الإلكتروني عن طريق النقر على الرابط الذي أرسلناه إليك للتو عبر البريد الإلكتروني؟ إذا لم تتلق رسالة البريد الإلكتروني، فسنرسل لك بكل سرور رسالة أخرى.') }} --}}
                    </div>
					<div class="container-login100-form-btn">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf

                            <div>
                                <button class="login100-form-btn" style="font-size: 15px;">
                                    {{ __('إعادة ارسال بريد التحقق') }}
                                </button>

                            </div>
                        </form>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" style="
                            margin: 30px;">
                                {{ __('تسجيل الخروج') }}
                            </button>
                        </form>

					</div>
				</div>
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
