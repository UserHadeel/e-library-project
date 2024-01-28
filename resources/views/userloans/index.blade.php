<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/Loan/css/loan.css')}}">
 <title>الاستعارات</title>
</head>
<body>
    @php use Carbon\Carbon; @endphp
    <div>
        @include('bookpage.nav-side-book')
    </div>

    <header class="Top-main">

<div class="r1">
<a class="link" href="{{ route('newbooks') }}"><img class="img" src="{{asset('dash/img/f.svg')}}" style="width: 64px; height: 63px;" ><br>
<span >الكتب الجديدة</span></a>
</div>

<div class="r2">
<a class="link" href="{{ route('mostborrowed') }}"><img class="img" src="{{asset('dash/img/s.svg')}}" style="width: 64px; height: 63px;" ><br>
<span class="Famous">الكتب الأكثر استعارة</span></a>
</div>

@if (!Auth::user()->isAdmin())
<div class="r3">
<a class="link-active" href="{{ route('userloans.index') }}"><img class="img" src="{{ asset('dash/img/n.svg') }}" style="width: 64px; height: 63px;"><br>
<span class="S">سجل الاستعارة</span></a>
</div>
@endif
@if (Auth::user()->isAdmin())
<div class="r3">
<a class="link-active" href="{{ route('loans.index') }}">
<img class="img" src="{{ asset('dash/img/n.svg') }}" style="width: 64px; height: 63px;"><br>
<span class="S">سجل الاستعارة</span>
</a>
</div>
@endif

</header>

    <main>
        <div class="containerloan">
            <div class="table_header">
            @if ($message= Session::get('success'))
                <div class="flash-message">
                <p>{{ $message }}</p>
            </div>
            @endif
                <span class="title">الكتب المستعاره</span>
        </div>
            <div>
                <div class="">

                    @if($loans->count() > 0)
                    <section class="table_body">
                        <table >
                            <thead>
                            <tr>
                                <td>#</td>
                                <td> عنوان الكتاب</td>
                                <td> رقم الاستعارة</td>
                                <td> اسم المستعير</td>
                                <td> البريد الالكتروني</td>
                                <td> تاريخ الارجاع</td>
                                <td>العملية</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($loans as $loan)
                                <tr>
                                    <td >{{ $loop->index + 1 }}</td>
                                    <td >
                                        <div >
                                            <div>
                                                {{$loan->book->title ?? ''}}
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div>{{$loan->number_borrowed}}</div>
                                    </td>
                                    <td >
                                        <div >
                                            <div>
                                                {{ $loan->user->name ?? ''}}
                                            </div>
                                        </div>
                                    </td>
                                    <td >
                                        <div >
                                            <div>
                                                {{ $loan->user->email ?? ''}}
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        {{Carbon::parse($loan->return_date)->format('l jS F, Y')}}
                                    </td>
                                    <td>
                                        <a href="{{ route('userloans.terminate', ['loan' => $loan->id]) }}">ارجاع الكتاب</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </section>
                    @else
                    <p>لايوجد عمليات استعارة نشطة.<p>
                    @endif
                </div>
            </div>
        </div>



        <div class="containerProjectloan">
            <div class="table_header">
                <span class="title">  مشاريع التخرج المستعاره</span>


        </div>
            <div>
                <div class="">

                    @if($projectloan->count() > 0)
                    <section class="table_body">
                        <table >
                            <thead>
                            <tr>
                                <td>#</td>
                                <td> عنوان الكتاب</td>
                                <td> رقم الاستعارة</td>
                                <td> اسم المستعير</td>
                                <td> البريد الالكتروني</td>
                                <td> تاريخ الارجاع</td>
                                <td>العملية</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projectloan as $projectLoan)
                                <tr>
                                    <td >{{ $loop->index + 1 }}</td>
                                    <td >
                                        <div >
                                            <div>
                                                {{$projectLoan->graduation_projects->title ?? ''}}
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div>{{$projectLoan->number_borrowed}}</div>
                                    </td>
                                    <td >
                                        <div >
                                            <div>
                                                {{ $projectLoan->user->name ?? ''}}
                                            </div>
                                        </div>
                                    </td>
                                    <td >
                                        <div >
                                            <div>
                                                {{ $projectLoan->user->email ?? ''}}
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        {{Carbon::parse($projectLoan->return_date)->format('l jS F, Y')}}
                                    </td>
                                    <td>
                                    <a href="{{ route('projectuserloans.terminate', ['projectLoan' => $projectLoan->id]) }}">ارجاع المشروع</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </section>
                    @else
                    <p>لايوجد عمليات استعارة نشطة.<p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </main>
    <!-- <script>
        // استهدف العنصر
        const statusMessage = document.getElementById('status-message');

// إظهار العنصر
        statusMessage.classList.remove('hidden');

// التأكد من اختفاء العنصر بعد 5 ثوانٍ
        setTimeout(function() {
        statusMessage.classList.add('hidden');
        }, 5000);
    </script> -->
</body>
</html>
