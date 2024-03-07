<link rel="stylesheet" href="{{asset('dash/css/dashh.css')}}">
<link rel="stylesheet" href="{{asset('bookstyle/css/bookpage.css')}}">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
<style>.dropdown [type="checkbox"] {
    display: none; }

</style>
<div class="main-content">
    <header>
    <div class="icons" style="margin-bottom: 20px">
     {{-- @can('قائمة-الصلاحيات')
    <a  href="{{route('dashboard')}}"><span class="fas fa-tachometer-alt"></span><span >لوحة التحكم</span></a>
    @endcan --}}

    <a  href="{{route('homepage')}}"><span class="fas fa-home"></span><span >الرئسية</span></a>

    </div>
    <form action="{{ route('main.search') }}" method="post" class="search-form">
        @csrf
        <div class="search-wrapper">
                <button type="submit" class="search-button">
                    <span class="las la-search"></span>
                </button>
                <input type="text" name="query" placeholder="البحث">
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



       {{-- <div class="sidebar-one" >
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
                <a class="active"> <span class="fas fa-tasks" ></span><span class="sidebar-title">أقسام الكتب</span></a>
            </li>
            @foreach ($categories as $category)
            @if ($category->name == "math1")
                <li>
                    <a href="{{ route('category.index') }}">
                        <span class="las la-book"></span>
                        <span>{{ $category->name }}</span>
                    </a>
                </li>
            @elseif ($category->name == "programming")
                <li>
                    <a href="{{ route('category.index') }}">
                        <span class="las la-book"></span>
                        <span>{{ $category->name }}</span>
                    </a>
                </li>

            @elseif ($category->name == "web")
                <li>
                    <a href="{{ route('book.index') }}">
                        <span class="las la-book"></span>
                        <span>{{ $category->name }}</span>
                    </a>
                </li>
            @endif
            @endforeach
        </ul>
    </div>
</div>
<div class="sidebar-tow" >
    <div class="sidebar-menu-tow">
        <ul>
            <li>
                <a href="{{route('projectPage')}}" >
                <span class="fa-solid fa-graduation-cap"></span>
                <span class="sidebar-title" style="margin-right: 1px;">مشاريع التخرج</span>
                </a>
            </li>
            <li>
                <a class="active"> <span class="fas fa-tasks" ></span><span class="sidebar-title">أقسام الكلية</span></a>
            </li>
            @foreach ($department as $departments)
            <li>
                <a href="{{ route('department.index') }}">
                <span class="las la-book"></span>
                <span>{{ $departments->name }}</span>
                </a>
            </li>
            @endforeach

        </ul>
    </div> --}}
{{-- </div> --}}
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

<script>
let hiddenInput = document.querySelector('input[name="type"]');
hiddenInput.value = section;
</script>
</body>
</html>
