<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>الكتب الجديدة</title>
<link rel="stylesheet" href="{{asset('dash/css/dashh.css')}}">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body >
    <div>
        @include('bookpage.nav-side-book')
    </div>

    <header class="Top-main">

        <div class="r1">
        <a class="link-active" href="{{ route('newbooks') }}"><img class="img" src="{{asset('dash/img/f.svg')}}" style="width: 64px; height: 63px;" ><br>
        <span >الكتب الجديدة</span></a>
        </div>

        <div class="r2">
        <a class="link" href="{{ route('mostborrowed') }}"><img class="img" src="{{asset('dash/img/s.svg')}}" style="width: 64px; height: 63px;" ><br>
        <span class="Famous">الكتب الأكثر استعارة</span></a>
        </div>

        @if (!Auth::user()->isAdmin())
        <div class="r3">
        <a class="link" href="{{ route('userloans.index') }}"><img class="img" src="{{ asset('dash/img/n.svg') }}" style="width: 64px; height: 63px;"><br>
        <span class="S">سجل الاستعارة</span></a>
        </div>
        @endif
        @if (Auth::user()->isAdmin())
        <div class="r3">
        <a class="link" href="{{ route('loans.index') }}">
        <img class="img" src="{{ asset('dash/img/n.svg') }}" style="width: 64px; height: 63px;"><br>
        <span class="S">سجل الاستعارة</span>
        </a>
        </div>
        @endif

    </header>



    <main>
    <div class="books-section">
        @foreach ($lastNewBooks as $book)
        @if(($book->able_to_borrow == null || $book->able_to_borrow == 0) && ($book->able_to_download == 0||$book->resource==null))
            @continue
        @endif
        <div class="book">
        <img class="b-icon" src="{{$book->image == null ? asset('categorystyle/img/book.png') : URL::to('/').'/images/book_cover/'.$book->image}}"  style="width: 90px; height: 100px;">
        <h3>{{ $book->title }}</h3>
        <p>المؤلف: {{ $book->author }}</p>
        <p>القسم: {{ $book->cat_name }}</p>
        @if($book->able_to_borrow == null || $book->able_to_borrow == 0)
        <p class="no-copies-message"> غير متاح للاستعارة</p>
        @elseif($book->canBeBorrowed())
            <a href="{{ route('userloans.create', ['book' => $book->id]) }}" class="borrow-button">استعارة</a>
        @else
            <p class="no-copies-message"> لا توجد نسخ متاحة للاستعارة</p>
        @endif
        @if( $book->resource != null && $book->able_to_download == 1)
            <a href="{{$book->resource == null ? asset('#') : URL::to('/').'/files/book_file/'.$book->resource}}"  class="download-button"  download>تحميل</a>
        @endif
    </div>
        @endforeach
    </div>
    </main>

</body>
</html>
