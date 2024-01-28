 <!DOCTYPE html>
<html lang="en">
<head>
	<title>Add book</title>
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

				<form action="{{route('book.store')}}" method="post">
                    @csrf
					<span class="login100-form-title">
						Add Book
					</span>

                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="title"
                                        required placeholder="Title" />
                    </div>

                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="author"
                                        required placeholder="Author" />
                    </div>

                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="publisher"
                                        required placeholder="Publisher" />
                    </div>


                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="description"
                                        required placeholder="Description" />
                    </div>

                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="serial_number"
                                        required placeholder="Serial_number" />
                    </div>

                    <div class="wrap-input100 validate-input">
                        <x-text-input class="input100"
                                        type="text"
                                        name="available_quantity"
                                        required placeholder="Available_quantity" />
                    </div>
                    <div class="wrap-input100 validate-input">
                        <select class="input100" name="category_name" required>
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btnCancel" >
                            <a href="{{route('book.index')}}">Cancel</a>
						</button>
					</div>

                    <div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btnCreate" >
                            <a href="{{route('book.store')}}">Create</a>
						</button>
                    </div>
				</form>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	 <script src="{{asset('loginpage/js/main.js')}}"></script>

</body>
</html>


