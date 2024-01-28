<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('/Loan/css/loan.css')}}">
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">
    <title>الاستعارات </title>
</head>
<body>
    @php use Carbon\Carbon; @endphp
    <div>
        @include('pro.nav-and-header')
    </div>
    <main>
        <div class="container">
            <div class="table_header">
                <span class="title"> استعارات الكتب النشطة</span>

            @if ($message= Session::get('success'))
                <div class="flash-message">
                   <p>{{ $message }}</p>
               </div>
           @endif
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
                                {{-- <td>العملية</td> --}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($loans as $loan)
                                <tr>
                                    <td >{{ $loop->index + 1 }}</td>
                                    <td >
                                            <div>
                                                {{$loan->book->title ?? ''}}
                                            </div>
                                    </td>

                                    <td>
                                        <div>{{$loan->number_borrowed}}</div>
                                    </td>
                                    <td>
                                        <div> {{ $loan->user->name ?? ''}}</div>
                                    </td>
                                    <td>
                                        <div> {{ $loan->user->email ?? '' }}</div>
                                    </td>

                                    <td>
                                        {{Carbon::parse($loan->return_date)->format('l jS F, Y')}}
                                    </td>
                                    {{-- <td>
                                        <a href="{{ route('loans.terminate', ['loan' => $loan->id]) }}">ارجاع الكتاب</a>
                                    </td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </section>
                    @else
                        <p>لايوجد عمليات استعارة نشطة<p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container">
            <div class="table_header">
                <span class="title"> استعارات مشاريع التخرج النشطة</span>

            @if ($message= Session::get('success'))
                <div class="flash-message">
                   <p>{{ $message }}</p>
               </div>
           @endif
        </div>
            <div>
                <div class="">
                    @if($projectloan->count() > 0)
                    <section class="table_body">
                        <table >
                            <thead>
                            <tr>
                                <td>#</td>
                                <td> عنوان مشروع التخرج</td>
                                <td> رقم الاستعارة</td>
                                <td> اسم المستعير</td>
                                <td> البريد الالكتروني</td>
                                <td> تاريخ الارجاع</td>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projectloan as $projectLoan)
                                <tr>
                                    <td >{{ $loop->index + 1 }}</td>
                                    <td >
                                            <div>
                                                {{$projectLoan->graduation_projects->title ?? ''}}
                                            </div>
                                    </td>
                                    <td>
                                        <div>{{$projectLoan->number_borrowed}}</div>
                                    </td>
                                    <td>
                                        <div> {{$projectLoan->user->name }}</div>
                                    </td>
                                    <td>
                                        <div> {{$projectLoan->user->email }}</div>
                                    </td>
                                    <td>
                                        {{Carbon::parse($projectLoan->return_date)->format('l jS F, Y')}}
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </section>
                    @else
                        <p>لايوجد عمليات استعارة نشطة<p>
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
