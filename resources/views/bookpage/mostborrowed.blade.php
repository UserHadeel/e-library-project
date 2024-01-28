<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>الكتب الأكثر الاستعارة</title>
<link rel="stylesheet" href="{{asset('dash/css/dashh.css')}}">
<link rel="stylesheet" href="{{asset('bookstyle/css/bookpage.css')}}">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <div>
        @include('bookpage.nav-side-book')
    </div>

    <header class="Top-main">

        <div class="r1">
        <a class="link" href="{{ route('newbooks') }}"><img class="img" src="{{asset('dash/img/f.svg')}}" style="width: 64px; height: 63px;" ><br>
        <span >الكتب الجديدة</span></a>
        </div>

        <div class="r2">
        <a class="link-active" href="{{ route('mostborrowed') }}"><img class="img" src="{{asset('dash/img/s.svg')}}" style="width: 64px; height: 63px;" ><br>
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
    @if ($result->count() > 0)
    <div class="books-section">
        @foreach ($result as $row)
        <div class="book">
            <img class="b-icon" src="{{ $row->imagee == null ? asset('categorystyle/img/book.png') : URL::to('/').'/images/book_cover/'.$row->imagee }}" style="width: 90px; height: 100px;">
            <h3>{{ $row->TITLE }}</h3>
            <p>المؤلف: {{ $row->author }}</p>
            <p>عدد مرات الأستعارة: {{$row->LCOUNT}}</p>
        @php
            $book = App\Models\Book::find($row->ID);
            $canBeBorrowed = $book->canBeBorrowed();
        @endphp
        @if($canBeBorrowed)
            <a href="{{ route('userloans.create', ['book' => $book->id]) }}" class="borrow-button">استعارة</a>
        @else
            <p class="no-copies-message">لا توجد نسخ متاحة للاستعارة</p>
        @endif
        @if( $book->resource != null)
            <a href="{{$book->resource == null ? asset('#') : URL::to('/').'/files/book_file/'.$book->resource}}"  class="download-button"  download>تحميل</a>
        @endif
        </div>
        @endforeach
    </div>
    @else
        <p style="margin-top: 20%; margin-right: 50%; ">لم يتم العثور .</p>
    @endif
    </main>

</body>
</html>
