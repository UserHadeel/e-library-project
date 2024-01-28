
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('bookstyle/css/popupStyle.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('bookstyle/index.css')}}">
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">
    <title>المستخدمين</title>

</head>
<body>
        @can('قائمة-المستخدمين')
        <div>
            @include('pro.nav-and-header')
        </div>

    <main>
        <div class="container">
        <section class="table_header">
            <span class="Title"> قائمة المستخدمين</span>
            <!-- <a class="create" href="{{ route('users.create') }}" >اضافة مستخدم</a> -->
        </section>

        @if ($message = Session::get('success'))
            <div class="flash-message-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <section class="table_body">
            <table >
                <thead>
                    <tr>
                        <th style="display: none;">ID</th>
                        <th>الأسم</th>
                        <th>البريد الالكتروني</th>
                    @can('صلاحية-المستخدم')
                        <th>الصلاحية</th>
                    @endcan
                    @can('قائمة-المستخدمين')
                        <th>عرض</th>
                    @endcan
                    @can('تعديل-مستخدم')
                        <th>تعديل</th>
                    @endcan
                    @can('حذف-مستخدم')
                        <th>حذف</th>
                    @endcan

                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)


                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        @can('صلاحية-المستخدم')
                            <td>
                            {{ $user->role}}
                            </td>
                        @endcan
                        <td><a class="btn btn-info" href="{{route('users.show',$user->id) }}"><i class="fas fa-eye"></i></a></td>
                        @if($user->role != 'مسؤول')
                        @can('تعديل-مستخدم')
                            <td><a href="{{ route('users.edit',$user->id) }}" class="edit-icon"><i class="fas fa-pencil-alt icon-edit"></i></a></td>
                        @endcan
                        @can('حذف-مستخدم')
                            <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من رغبتك في حذف هذا المستخدم؟')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="delete-icon"><i class="fas fa-trash-alt icon" ></i>
                                </button>
                            </form>
                            </td>
                        @endcan
                        @else
                        <td>غير مسموح</td>
                        <td>غير مسموح</td>
                        </tr>
                        @endif
                        @endforeach
                </tbody>
            </table>
        </section>
            </div>
        </main>
            @endcan

</body>
 </html>
