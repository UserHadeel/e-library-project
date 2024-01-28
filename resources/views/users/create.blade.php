
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>إنشاء مستخدم جديد</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>

        </div>

    </div>

</div>


@if (count($errors) > 0)

  <div class="alert alert-danger">

    <strong>Whoops!</strong> There were some problems with your input.<br><br>

    <ul>

       @foreach ($errors->all() as $error)

         <li>{{ $error }}</li>

       @endforeach

    </ul>

  </div>

@endif



{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}

<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Name:</strong>

            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Email:</strong>

            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Password:</strong>

            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Confirm Password:</strong>

            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Role:</strong>

            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</div>

{!! Form::close() !!}


<p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>


{{--
<!DOCTYPE html>
<html lang="en">
<head>
	<title>creat user</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('bookstyle/css/popupStyle.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('bookstyle/style.css')}}">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="layout">

				<form action="{{route('user.store')}}" method="post">
                    @csrf
					<span class="login100-form-title">
                        <h2>Create New User</h2>
					</span>
                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="name"
                                        required placeholder="Name" />
                    </div>
                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="email"
                                        required placeholder="Email" />
                    </div>

                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="Password"
                                        required placeholder="Password" />
                    </div>

                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="password"
                                        name="confirm-password"
                                        required placeholder="confirm-password" />
                    </div>



					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btnCancel" >
                            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
						</button>
					</div>

                    <div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btnCreate" >
                            <a href="{{route('user.store')}}">Create</a>
						</button>
                    </div>
				</form>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	 <script src="{{asset('loginpage/js/main.js')}}"></script>

</body>
</html> --}}


