
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('userstyle/css/userEdit.css')}}">
    <title> تعديل مستخدم</title>
</head>
<body>
        <div>
            @include('pro.nav-and-header')
        </div>
    <main>
    <div class="container">
            <section class="table_title">
                <span class="Title"> تعديل بيانات مستخدم</span>
            </section>

        <form action="/users-update/{{ $user->id }}" method="POST" >
        @csrf
        @method('POST')
           <div class="table-responsive">
                <table width="70%">
                    <thead>
                    <tr>
                        <td>أسم المستخدم</td>
                        <td>صلاحية المستخدم</td>
                        <td>حالةالمستخدم</td>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td disabled="none">{{$user->name}}</td>
                        <td>{!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}</td>
                        <td>
                            <input onsubmit="toggleState()" type="checkbox" name="active" value="1" {{ $user->active ? 'checked' : '' }} >
                                <span id="statusText">{{ $user->active ? 'نشط ' : ' نشط ' }} </span>
                        </td>
                    </tr>
                    <tr >
                        <td class="s">
                            <button type="submit" class="sbtn">حفظ</button>
                        </td>
                    </tr>
                    </tbody>

        </form>
    </main>

<script>
        function toggleState() {
            if (confirm) {
                console.log("reached this point...");
                const checkbox = document.querySelector('input[name="active"]');
                const statusText = document.getElementById('statusText');

                if (checkbox.checked) {
                    statusText.textContent = 'نشط';
                } else {
                    statusText.textContent = 'نشط';
                }
            }
        }
    </script>
</body>
</html>

