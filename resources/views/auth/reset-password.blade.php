{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


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
             <form class="login100-form validate-form p-l-55 p-r-55 p-t-178" method="POST" action="{{ route('password.store') }}">
               @csrf
                        <!-- Password Reset Token -->
                       <input type="hidden" name="token" value="{{ $request->route('token') }}">


					<span class="login100-form-title">
                    إعادة تعيين كلمة المرور
					</span>

                    <!-- Email Address -->
                    <div class="wrap-input100 validate-input">
                        <x-text-input id="email" class="input100" type="email" name="email" :value="old('email')" required autofocus placeholder="أدخل بريدك الألكتروني" />
                        {{-- <x-text-input  id="email" class="input100" type="hidden" name="token" value="{{ $request->route('token') }}"/> --}}

                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    @if ($errors->has('email'))
                    <div class="alert alert-danger mt-2">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <!-- Password -->
                <div class="wrap-input100 validate-input">
                    <x-text-input id="password" class="input100"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="كلمة السر" />
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />


                     <!-- Confirm Password -->
                    <div class="wrap-input100 validate-input">
                            <!-- {{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" /> --}} -->
                            <x-text-input id="password_confirmation" class="input100"
                                            type="password"
                                            name="password_confirmation" required a
                                            utocomplete="new-password"
                                            placeholder="تأكيد كلمة السر " />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="font-size: 15px;">
                         إعادة تعيين كلمة المرور
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
