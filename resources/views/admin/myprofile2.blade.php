<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>لوحة التحكم</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">
</head>
<body>

    <div>
        @include('pro.nav-and-header')
    </div>


    <div class="main-content">
    <main>
        <div class="cards">
        <div class="card-single">
            <div>
                <h1> {{$countMember}}</h1>
                <span>المستخدمين</span>
            </div>
            <div>
                <span class="las la-users"></span>
            </div>
            </div>
        <div class="card-single">
            <div>
                <h1> {{$countbook}}</h1>
                <span>اجمالي الكتب</span>
            </div>
            <div>
                <span class="las la-book"></span>
            </div>
        </div>

        <div class="card-single">
            <div>
                <h1> {{$countGraduationProjects}}</h1>
                <span>اجمالي مشاريع التخرج</span>
            </div>
            <div>
                <span class="las la-book"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1> {{$countscientificJournals}}</h1>
                <span>اجمالي المجلات العلمية</span>
            </div>
            <div>
                <span class="las la-book"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>{{$count}}</h1>
                <span>اجمالي الكتب المستعارة</span>
            </div>
            <div>
                <span class="las la-book"></span>
            </div>
        </div>
        <div class="card-single">
            <div>
                <h1>{{$pcount}}</h1>
                <span>اجمالي المشاريع المستعارة</span>
            </div>
            <div>
                <span class="las la-book"></span>
            </div>
        </div>
        </div>

        <div class="recent-grid">
        <div class="projects">
        <div class="card">
        <div class="card-header">
                <h2>الكتب الاخيرة</h2>
                <button><a href="/book">إظهار الكل  <span class="la la-arrow-left"></span></a></button>
        </div>
        <div class="card-body">
        <div class="table-responsive">
                <table width="100%">
                    <thead>
                        <tr>
                            <td> #</td>
                            <td>عنوان الكتاب</td>
                            <td>القسم</td>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($lastbook as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->cat_name}}</td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
        </div>
        </div>
        </div>

        <div class="card">
        <div class="card-header">
                <h2>مشاريع التخرج الاخيرة</h2>
                <button><a href="/GraduationProjects">إظهار الكل  <span class="la la-arrow-left"></span></a></button>
        </div>
        <div class="card-body">
        <div class="table-responsive">
                <table width="100%">
                    <thead>
                        <tr>
                            <td> #</td>
                            <td>عنوان المشروع</td>
                            <td>القسم</td>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($lastproject as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->dep_name}}</td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>
        </div>
        </div>
        </div>

        <div class="card">
        <div class="card-header">
                <h2>المجلات العلمية الاخيرة</h2>
                <button><a href="/scientificJournals">إظهار الكل  <span class="la la-arrow-left"></span></a></button>
        </div>
        <div class="card-body">
        <div class="table-responsive">
                <table width="100%">
                    <thead>
                        <tr>
                            <td> #</td>
                            <td>عنوان المجلة</td>
                            <td> دار النشر</td>

                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($lastJournals as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->publishing }}</td>

                        </tr>
                            @endforeach
                    </tbody>
                </table>
        </div>
        </div>
        </div>
        </div>

        <div class="member">
        <div class="card">
        <div class="card-header">
                <h2>المستخدمين الجدد</h2>
                <button><a href="{{ route('user.index') }}">اظهار الكل</a><span class="la la-arrow-left">
                </span></button>
        </div>
        <div class="card-body">
        <div class="customer">
        <div class="info">
                <table width="100%">
                    <tbody>
                            @foreach ($lastuser as $user)
                        <tr>
                            <td>{{ $user->name }}  <small> المستخدمين </small></td>
                            <td>{{ $user->email }}</td>
                        </tr>
                            @endforeach
                    </tbody>
                </table>

        </div>
        </div>
        </div>
        </div>
    </main>
    </div>
</body>
</html>
