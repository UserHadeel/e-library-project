

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="{{asset('welcompage/css/welcomestyle.css')}}">
  <title>مرحبا بكم في المكتبة الألكترونية</title>
  <style>

  </style>
</head>

<body>
    <div class="container">
    <div class="header">

    <div class="header-links">
    @if (Route::has('login'))
       @auth
        @if (auth()->user()->isAdmin())
        <a class="btn" href="{{ url('/dashboard') }}">لوحة التحكم </a>
        @else
        <a class="btn" href="{{ url('/homepage/all') }}">الرئسية</a>
        @endif
       @else
        <a class="btn" href="{{ route('login') }}">تسجيل الدخول</a>

        @if (Route::has('register'))
            <a class="btn" href="{{ route('register') }}">التسجيل</a>
        @endif
        @endauth
       @endif
    </div>

    <div class="header-logo">

        <span id="icon" class="las la-book" style="font-size: 30px; color: #000;" >E-library</span>
      </div>

  </div>

  <div class="welcome-container">
    <div class="welcome-text">
      <h1>مرحبا بكم في المكتبة الإلكترونية</h1>
      <p>اكتشف مجموعة واسعة من الكتب في مكتبتنا الرقمية. ابدأ القراءة والاستكشاف اليوم!</p>
    </div>
    <div class="image-container">
        <img src="{{asset('welcompage/img/6263.jpg')}}" alt="IMG" >
    </div>
  </div>
  <footer>
    &copy; 2023 E-Library. كل الحقوق محفوظة.
  </footer>
</div>

</body>

</html>
