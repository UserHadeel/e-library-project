<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit book</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('bookstyle/style.css')}}">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="layout">

				<form action="{{route('GraduationProjects.update',$Project->id)}}" method="post">
                    @method('PUT')
                    @csrf
					<span class="login100-form-title">
						Edit project
					</span>

                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="title"
                                        value="{{$Project->title}}"
                                        required placeholder="Title" />
                    </div>

                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="student_name"
                                        value="{{$Project->student_name}}"
                                        required placeholder="student_name" />
                    </div>

                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="supervisor_name"
                                        value="{{$Project->supervisor_name}}"
                                        required placeholder="supervisor_name" />
                    </div>

                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="year"
                                        value="{{$Project->year}}"
                                        required placeholder="year" />
                    </div>

                    {{-- <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="name"
                                        value="{{$category->name}}"
                                        required placeholder="Title" />
                    </div> --}}

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btnCancel" >
                            <a href="{{route('GraduationProjects.index')}}">Cancel</a>
						</button>
					</div>

                    <div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btnCreate" >
                            <a href="{{route('GraduationProjects.update',$Project->id)}}">update</a>
						</button>
                    </div>
				</form>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	{{-- <script src="{{asset('loginpage/js/main.js')}}"></script> --}}

</body>
</html>


