<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>الصفحة الرئسية</title>
<link rel="stylesheet" href="{{asset('dash/css/dashh.css')}}">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>

<div>
        @include('bookpage.nav-side-book')
    </div>
<main>
@if ($books->count() > 0)

        <div style="margin:0 auto; margin-top: 17%; float:left;">
            {{$books->onEachSide(1)->links()}}
        </div>
        <div class="books-section">

            @if($itemsShowing == 'book')
            @foreach ($books as $book)
            @if(($book->able_to_borrow == null || $book->able_to_borrow == 0) && ($book->able_to_download == 0||$book->resource==null))
            @continue
            @endif
            <div class="book">
                <img  class="b-icon" src="{{$book->image == null ? asset('categorystyle/img/book.png') : URL::to('/').'/images/book_cover/'.$book->image}}" style="width: 90px; height: 100px;">
                <h3 >{{ $book->title }}</h3>
                <p>المؤلف: {{ $book->author }}</p>
                <p>القسم: {{ $book->cat_name }}</p>
                @if($book->able_to_borrow == null || $book->able_to_borrow == 0)
                <p class="no-copies-message"> غير متاح للاستعارة</p>
                @elseif($book->canBeBorrowed())
                <a href="{{ route('userloans.create', ['book' => $book->id]) }}" class="borrow-button">استعارة
                </a>
                @else
                <p class="no-copies-message"> لا توجد نسخ متاحة للاستعارة</p>
                @endif
                @if( $book->resource != null)
                <a href="{{$book->resource == null ? asset('#') : URL::to('/').'/files/book_file/'.$book->resource}}"  class="download-button"  download>تحميل</a>
                @endif
            </div>
            @endforeach

        @else

            @foreach ($books as $book)
            @if(($book->able_to_borrow == null || $book->able_to_borrow == 0) && ($book->able_to_download == 0||$book->resource==null))
                @continue
            @endif
            <div class="book">
                <img class="b-icon" src="{{$book->image == null ? asset('categorystyle/img/book.png') : URL::to('/').'/images/project_cover/'.$book->image}}" style="width: 90px; height: 100px;">
                <h3 >{{ $book->title }}</h3>
                <p >المشرف: {{ $book->supervisor_name }}</p>
                <p>القسم: {{ $book->dep_name }}</p>
                <p>السنة: {{ $book->year }}</p>
                @if($book->able_to_borrow == null || $book->able_to_borrow == 0)
                <p class="no-copies-message"> غير متاح للاستعارة</p>
                @elseif($book->projectcanBeBorrowed())
                <a href="{{ route('projectuserloans.create', ['project' => $book->id]) }}" class="borrow-button">استعارة
                </a>
                @else
                <p class="no-copies-message"> لا توجد نسخ متاحة للاستعارة</p>
                @endif
                  @if( $book->resource != null && $book->able_to_download == 1)
                <a href="{{$book->resource == null ? asset('#') : URL::to('/').'/files/project_file/'.$book->resource}}"  class="download-button"  download>تحميل</a>
                @endif
            </div>

            @endforeach
            @endif

        </div>
    @else
    {{-- <i style="text-align: center; font-size: 190px;color:rgb(73, 202, 53);" class="fas fa-exclamation-circle"></i>
    <br />
        <p style="margin-top: 18%; margin-bottom: 18%; margin-right: 51%; font-size:30px; padding-top:20px">

            لم يتم العثور على اي تطابق
            <i style="text-align: center;color:rgb(73, 202, 53);" class="fas fa-exclamation-circle"></i>
        </p> --}}
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh;">
            <i style="font-size: 190px; color: rgb(156, 238, 144);padding-right: 12%;" class="fas fa-exclamation-circle"></i>
            <br />
            <p style="font-size: 25px; padding-top: 25px;padding-right: 12%;">
              لم يتم العثور على أي تطابق
              <i style="text-align: center;color: rgb(156, 238, 144);" class="fas fa-exclamation-circle"></i>

            </p>
          </div>
    @endif
    </main>




</body>

</html>
