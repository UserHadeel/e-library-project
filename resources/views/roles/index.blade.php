<!DOCTYPE html>
 <html lang="en" dir="rtl">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('bookstyle/css/popupStyle.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('role/css/role-index.css')}}">
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">>
    <title>الصلاحيات</title>
    <script>
        var popupRoute = '{{ route("roles.store") }}';
    </script>
 </head>
 <body>

            <div>
                @include('pro.nav-and-header')
            </div>

 <main>
    <div class="container">
    <section class="table_header">

            <span class="Title">إدارة الصلاحيات</span>
            @can('انشاء-صلاحية')
            <a class="create"  href="{{ route('roles.create') }}" >إضافة صلاحية جديدة</a>
            @endcan

            @if ($message= Session::get('success'))
                <div class="flash-message">
                   <p>{{ $message }}</p>
               </div>
           @endif
<section class="table_body">
    <table >
        <thead>
            <tr>
                <th style="display: none;">ID</th>
                <th>#</th>
                <th>الأسم</th>
                <th >عرض</th>
                <th > تعديل</th>
                <th >حذف</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $key => $role)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <a class="show" href="{{ route('roles.show',$role->id) }}"><i class="fas fa-eye" ></i></a>
                    </td>
                    <td>
                        @can('تعديل-صلاحية')
                            <a onclick="configurePopup(false, this); show();"  href="{{ route('roles.edit',$role->id) }}" class="edit-icon"><i class="fas fa-pencil-alt icon-edit"></i>
                            </a>
                        @endcan
                    </td>
                    <td>
                        @can('حذف-صلاحية')

                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذه الصلاحية؟')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="delete-icon"><i class="fas fa-trash-alt icon" ></i>
                                </button>
                            </form>

                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
     </section>
 </table>
    <!-- {!! $roles->render() !!} -->
</body>
</html>
