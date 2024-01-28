<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض مستخدم </title>
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('userstyle/css/userShow.css')}}">

</head>
<body>
        <div>
            @include('pro.nav-and-header')
        </div>
    <main>
    <div class="container">
            <section class="table_title">
                <span class="Title"> عرض بيانات المستخدم</span>
            </section>
            <section class="table_body">
                <table >
                    <thead>
                        <tr>
                            <th class="table_header">الأسم</th>
                            <th>{{ $user->name }}</th>
                        </tr>
                        <tr>
                            <th  class="table_header">البريدالالكتروني</th>
                            <th>{{ $user->email }}</th>
                        </tr>
                        <tr>
                            <th  class="table_header">الصلاحية</th>
                            <th>
                            @if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                            @endif
                            </th>
                        </tr>

</main>
</body>
</html>



