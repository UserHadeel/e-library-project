<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>صفحة المجلات العلمية</title>
<!-- <link rel="stylesheet" href="{{asset('bookstyle/css/bookpage.css')}}"> -->
<link rel="stylesheet" href="{{asset('dash/css/dashh.css')}}">
<link rel="stylesheet" href="{{asset('bookstyle/css/bookpage.css')}}">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>.dropdown [type="checkbox"] {
    display: none; }
</style>

<script>
    var section = sessionStorage.getItem('section') ?? "book";
    function setSection(sec) {
        if(sessionStorage.getItem('section') == null)
            sessionStorage.setItem('section', 'book');

        sessionStorage.setItem('section', sec);
        if(sec == "book")
            location.href = "{{route('m-homepage', ['i' => 'book', 'cg' => 'all'])}}";
        else
            location.href = "{{route('m-homepage', ['i' => 'gp', 'cg' => 'all'])}}"
    }
</script>

</head>
<body>


    <header class="Top-main">

        <div class="r1">
        <a class="link" href="{{ route('newbooks') }}"><img class="img" src="{{asset('dash/img/f.svg')}}" style="width: 64px; height: 63px;" ><br>
        <span >الكتب الجديدة</span></a>
        </div>

        <div class="r2">
        <a class="link" href="{{ route('mostborrowed') }}"><img class="img" src="{{asset('dash/img/s.svg')}}" style="width: 64px; height: 63px;" ><br>
        <span class="Famous">الكتب الأكثر استعارة</span></a>
        </div>

        <div  class="r3">
        <a href="{{route('userloans.index')}}" ><img class="img" src="{{asset('dash/img/n.svg')}}" style="width: 64px; height: 63px;" ><br>
        <span  class="S">سجل الاستعارة</span></a>
        </div>
    </header>


    <div class="main-content">
        <header>
        <div class="icons" style="margin-bottom: 20px">
        @can('قائمة-الصلاحيات')
        <a  href="{{route('dashboard')}}"><span class="fas fa-tachometer-alt"></span><span class="b-title">لوحة التحكم</span></a>
        @endcan

        <a  href="{{route('homepage')}}"><span class="fas fa-home"></span><span class="b-title">الرئسية</span></a>

        </div>
        <form action="{{ route('main.JournalsSearch') }}" method="post" class="search-form">
            @csrf
            <div class="search-wrapper">
                    <button type="submit" class="search-button">
                        <span class="las la-search"></span>
                    </button>
                    <input type="text" name="query" placeholder=" البحث" style="font-size: medium;">

            </div>
        </form>

        <div class="user-wrapper">
            <div class="dropdown">
                <input type="checkbox" id="toggle" class="dropdown-toggle">
                <label id="toggle" for="toggle"> {{Auth::user()->name?? ''}} <i class="fas fa-user-circle profile-icon" ></i></label>
                <ul class="dropdown-menu">
                <li><a href="{{route('userprofile.update')}}"> الملف الشخصي</a></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span>تسجيل الخروج</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                </ul>
            </div>

        </div>
        </header>
        </div>



            <div class="sidebar-one" >
            <div class="sidebar-menu-one">
                <li>
                    <a href="{{route('scientificJournalsPage')}}" >
                    <span class="fa fa-book"></span>
                    <span class="sidebar-title" style="margin-right: 1px;"> المجلات العلمية</span>
                </a>
                </li>
        </div>
        </div>

        <div class="sidebar" >
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a class="active" style="cursor: pointer;" onclick="setSection('book');"> <span class="fas fa-tasks" ></span><span class="sidebar-title">أقسام الكتب</span></a>
                </li>
                <li>
                    <a href="{{route('m-homepage', ['i' => 'book', 'cg' => 'all'])}}">
                    <span class="las la-book"></span>
                    <span>الكل</span>
                    </a>
                </li>
                @foreach ($categories as $category)
                <li>
                    <!-- <a href="{{ route('category.index') }}"> -->
                    <a href="{{route('m-homepage', ['i' => 'book', 'cg' => $category->name])}}">
                    <span class="las la-book"></span>
                    <span>{{ $category->name }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="sidebar-tow" >
        <div class="sidebar-menu-tow">
            <ul>

                <li>
                    <a class="active"  style="cursor: pointer;" onclick="setSection('gb');">
                    <span class="fa-solid fa-graduation-cap"></span>
                    <span class="sidebar-title" style="margin-right: 1px;">مشاريع التخرج</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('m-homepage', ['i' => 'gp', 'cg' => 'all'])}}">
                    <span class="las la-book"></span>
                    <span>الكل</span>
                    </a>
                </li>
                @foreach ($department as $department)
                <li>
                    <a href="{{route('m-homepage', ['i' => 'gp', 'cg' => $department->name])}}">
                    <span class="las la-book"></span>
                    <span>{{ $department->name }}</span>
                    </a>
                </li>
                @endforeach

            </ul>
        </div>
    </div>




    <main>
 @if ($scientificJournals->count() > 0)
    <div class="books-section">

    @foreach ($scientificJournals as $scientificJournals)
    @if($scientificJournals->resource == null || $scientificJournals->able_to_download == 0)
            @continue
    @endif
    <div class="book">
    <img class="b-icon" src="{{$scientificJournals->image == null ? asset('categorystyle/img/book.png') : URL::to('/').'/images/scientific_cover/'.$scientificJournals->image}}"  style="width: 90px; height: 100px;">
        <h3>{{ $scientificJournals->title }}</h3>
        <p>الناشر : {{ $scientificJournals->publishing }}</p>
        @if( $scientificJournals->resource != null && $scientificJournals->able_to_download == 1)
        <a href="{{$scientificJournals->resource == null ? asset('#') : URL::to('/').'/files/scientific_file/'.$scientificJournals->resource}}"  class="download-button"  download>تحميل</a>
        @endif
    </div>
    @endforeach


    </div>
    @else
        <p style="margin-top: 20%; margin-right: 50%; ">لم يتم العثور .</p>
    @endif
    </main>

    <script>
        let hiddenInput = document.querySelector('input[name="type"]');
        hiddenInput.value = section;
    </script>
</body>

</html>
