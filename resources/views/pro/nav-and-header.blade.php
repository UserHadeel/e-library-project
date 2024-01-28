<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- <link rel="stylesheet" href="{{asset('/css/notify.css')}}"> -->
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">

<style>.dropdown [type="checkbox"] {
    display: none; }
</style>

</head>
<body>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar" >

        <div class="sidebar-brand">
            <h2 class="logo"><span class="lab la-accusoft"></span><span>E-Library</span></h2>
        </div>

    <div class="sidebar-menu">
        <ul>

            <li>
                <a  href="{{route('dashboard')}}" class="active">
                    <span class="fas fa-tachometer-alt"></span>
                    <span>لوحة التحكم</span></a>
            </li>
            <li>
                <a  href="{{route('newbooks')}}">
                    <span class="fas fa-home"></span>
                    <span>الرئسية</span></a>
            </li>

            <li>
                <a href="{{route('book.index')}}"><span class="las la-book"></span>
                    <span>إدارة الكتب</span></a>
            </li>

            @can( 'قائمة-اقسام-الكتب')
            <li>
                <a href="{{route('category.index')}}" > <span class="fas fa-tasks"></span>
                    <span> اقسام الكتب</span> </a>
            </li>
            @endcan
            <li>
                <a href="{{route('GraduationProjects.index')}}"><span class="las la-book"></span>
                    <span>إدارة مشاريع التخرج</span></a>
            </li>

            <li>
                <a href="{{route('department.index')}}" > <span class="fas fa-tasks"></span>
                    <span> اقسام الكلية</span> </a>
            </li>

            <li>
                <a href="{{route('scientificJournals.index')}}"><span class="las la-book"></span>
                    <span>إدارة المجلات العلمية</span></a>
            </li>

            <li>
                <a href="{{route('loans.index')}}"><span class="las la-check"></span>
                    <span> الاستعارات النشطة</span></a>
            </li>

            @can('قائمة-الصلاحيات')
            <li>
                <a href="{{route('roles.index')}}"><span class="las la-user"></span>
                    <span>إدارة الصلاحيات</span></a>
            </li>
            @endcan

            @can('قائمة-المستخدمين')
            <li>
                <a href="{{route('user.index')}}"><span class="las la-user-circle"></span>
                    <span>إدارة المستخدمين </span></a>
            </li>
            @endcan

            <!-- <li>
                <div class="dropdown">
                <a onclick="myFunction()" class="dropbtn"><span class="las la-book"></span>
                    <span> Books</span></a>
                <div id="myDropdown" class="dropdown-content">
                   <a href="{{route('homepage')}}">Books Home</a> -->
                    <!-- <a href="{{route('book.index')}}">Mange Books</a>
            </li> -->

            <!-- <li>
                <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="fa-solid fa-right-from-bracket"></span>
                    <span>تسجيل الخروج</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li> -->
        </ul>
    </div>
</div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                <span class="las la-bars"></span>
                </label>لوحة التحكم</h2>

     <!-- <div class="user-wrapper">
    <div class="dropdown">
    <input type="checkbox" id="notification-toggle" class="toggle-checkbox">
    <label for="notification-toggle" class="toggle-label">
        <i class="fas fa-bell notification-icon" >
        <span class="icon-button__badge" >{{Auth::User()->unreadNotifications->count()}}</span>
        </i>
    </label>
<div class="dropdown-menu">
    <div class="dropdown-header">
    <span>Notifications</span>
    </div>
        @foreach (Auth::User()->unreadNotifications as $notification)
        <ul class="notifications" >
        <strong >{{ $notification->data['user_create'] }}</strong><br>
        <a href="{{ route('loans.index')}}" class="p">New borrowing</a><br>
        <small>{{$notification->created_at}}</small>
        </ul>
        @endforeach
       </div>
        </div> -->
        <div class="user-wrapper">
            <div class="dropdown">
                <input type="checkbox" id="toggle" class="dropdown-toggle">
                <label id="toggle" for="toggle"> {{Auth::user()->name?? ''}} <i class="fas fa-user-circle profile-icon" ></i></label>
                <ul class="dropdown-menu">
                  <li><a href="{{route('profile.update')}}"> الملف الشخصي</a></li>
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



    <!-- <script>
/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script> -->

</body>
</html>
