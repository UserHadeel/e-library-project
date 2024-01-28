<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>صفحة مشاريع التخرج</title>
<!-- <link rel="stylesheet" href="{{asset('bookstyle/css/bookpage.css')}}"> -->
<link rel="stylesheet" href="{{asset('dash/css/dashh.css')}}">
 <link rel="stylesheet" href="{{asset('bookstyle/css/bookpage.css')}}">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
<style>

</style>

</head>
<body>
    <div>
        @include('bookpage.nav-side-book')
    </div>
<!-- <input type="checkbox" id="nav-toggle"> -->


    <header class="Top-main">
        <div>
        <a href="{{ route('newbooks') }}"><img class="img" src="{{asset('dash/img/f.svg')}}" style="width: 64px; height: 63px;" ><br>
        <span>الكتب الجديدة</span></a>
       </div>
        <div>
        <a ><img class="img" src="{{asset('dash/img/s.svg')}}" style="width: 64px; height: 63px;" ><br>
        <span class="Famous">الكتب الأكثر استعارة</span></a>
        </div>
        <div>
        <a href="{{route('userloans.index')}}" ><img class="img" src="{{asset('dash/img/n.svg')}}" style="width: 64px; height: 63px;" ><br>
        <span  class="S">سجل الاستعارة</span></a>
        </div>
    </header>

    <main>
<div class="books-section">
    @foreach ($projects as $project)
      <div class="book">
      <img class="b-icon" src="{{$project->image == null ? asset('categorystyle/img/book.png') : URL::to('/').'/images/project_cover/'.$project->image}}"  style="width: 90px; height: 100px;">
        <h3>{{ $project->title }}</h3>
        <p>المشرف: {{ $project->supervisor_name }}</p>
        <p>السنة: {{ $project->year }}</p>
           @if($project->projectcanBeBorrowed())
                <a href="{{ route('projectloans.create', ['project' => $project->id]) }}" class="borrow-button">استعارة</a>
                @else
                <p class="no-copies-message"> لا توجد نسخ متاحة للاستعارة</p>
            @endif
            @if( $book->resource != null)
            <a href="{{$project->resource == null ? asset('#') : URL::to('/').'/files/project_file/'.$project->resource}}"  class="download-button"  download>تحميل</a>
            @endif
        </div>
    @endforeach
  </div>
    </main>

    <!-- <footer>
    &copy; 2023 E-Library. All rights reserved.
  </footer> -->

</body>

</html>
