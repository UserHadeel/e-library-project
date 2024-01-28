<!DOCTYPE html>
 <html lang="en" dir="rtl">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('bookstyle/css/popupStyle.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('bookstyle/index.css')}}">
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">
    <title>الكتب</title>
    <script>
        var popupRoute = '{{ route("book.store") }}';
    </script>
</head>
<body>
            <div>
                @include('pro.nav-and-header')
            </div>


    <main>
    <div class="container">
    <form action="{{ route('book.search') }}" method="post" class="search-form">
        @csrf
        <div class="search-wrapper">
                <button type="submit" class="search-button">
                    <span class="las la-search"></span>
                </button>
                <input type="text" name="query" placeholder=" البحث">
        </div>
    </form>

    <section class="table_header">

            <span class="Title"> قائمة الكتب</span>
            @can('انشاء-كتاب')
            <a onclick="configurePopup(true, this); show()"  class="create" >إضافة كتاب</a>
            @endcan

        </section>

        @if ($message = Session::get('success'))
    <div class="flash-message-success">
        <p>{{ $message }}</p>
    </div>
@elseif ($message = Session::get('error'))
    <div class="flash-message-error">
        <p>{{ $message }}</p>
    </div>
@endif

    @if ($books->count() > 0)
<section class="table_body">
        <table >
            <thead>
                <tr>
                    <th style="display: none;">#</th>
                    <th>العنوان</th>
                    <th>المؤلف</th>
                    <th>الناشر</th>
                    <th>الرقم التسلسلي</th>
                    <th>الكمية المتوفرة</th>
                    <th>الوصف</th>
                    <th>القسم</th>
                    <th>يمكن استعارته</th>
                    <th>يمكن تنزيله</th>
                    <th>الملف</th>
                    @can("تعديل-كتاب")
                    <th>تعديل</th>
                    @endcan
                    @can("حذف-كتاب")
                    <th>حذف</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td style="display: none;">{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->serial_number }}</td>
                        <td>{{ $book->available_quantity }}</td>
                        <td>{{ $book->description }}</td>
                        <td>{{ $book->cat_name }}</td>
                        <td>
                            @if($book->able_to_borrow == null)
                                لا
                            @else
                            {{ ($book->able_to_borrow == 1) ? "نعم" : "لا" }}
                            @endif
                        </td>
                        <td>
                            @if($book->able_to_download == null)
                                لا
                            @else
                            {{ ($book->able_to_download == 1) ? "نعم" : "لا" }}
                            @endif
                        </td>
                        <td>{{ $book->resource ?? "لا يوجد/ غير متوفر" }}</td>




                        @can("تعديل-كتاب")
                        <td>
                            <a onclick="configurePopup(false, this); show();" xhref="{{ route('book.edit', $book->id) }}" class="edit-icon"><i class="fas fa-pencil-alt icon-edit"></i>
                            </a>
                        </td>
                        @endcan

                        @can("حذف-كتاب")
                        <td>
                            <form action="{{ route('book.destroy', $book->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا الكتاب؟')">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="delete-icon"><i class="fas fa-trash-alt icon" ></i>
                                </button>
                            </form>
                        </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
            </section>
        </table>


    @else
        <p>لم يتم العثور هذا الكتاب.</p>
    @endif
</div>
<main>
    <div class="popup"  id="divID" style="display: none;">
        <div class="ppp-header">
            <h3 class="title" id="ppp-id">إضافة كتاب</h3>
        </div>
        <div class="ppp-content">
            <form  id="myForm" method="post" enctype="multipart/form-data">
            @csrf
            <input  type="hidden" name="_token" value="{{csrf_token() }}" />
            <input  type="hidden" name="id" value="" />

            <div class="p3c-input-element"  id="image-container">
                <div class="col-75">
                    <input class="inpt" type="file"name="image"></div>
                    <div class="col-25">
                    <label for="image">اختر صورة</label></div>
            </div>
            <div class="p3c-input-element"  id="resource-container">
                <div class="col-75">
                    <input class="inpt" type="file"name="resource"></div>
                    <div class="col-25">
                    <label for="resource">اختر ملف</label></div>
            </div>
            <div class="p3c-input-element">
                <div class="col-75">
                    <input class="inpt" type="text" name="title" ></div>
                    <div class="col-25">
                    <label>العنوان</label></div>
            </div>

            <div class="p3c-input-element ">
                <div class="col-75">
                    <input class="inpt"  type="text" name="author"></div>
                    <div class="col-25">
                    <label>المؤلف</label></div>
            </div>
            <div class="p3c-input-element ">
                <div class="col-75">
                    <input class="inpt"  type="text" name="publisher"></div>
                    <div class="col-25">
                    <label>الناشر</label></div>
            </div>
            <div class="p3c-input-element">
                <div class="col-75">
                    <input class="inpt"  type="text" name="description"></div>
                    <div class="col-25">
                    <label>الوصف</label></div>
            </div>
            <div class="p3c-input-element">
                <div class="col-75">
                    <input class="inpt"  type="text" name="serial_number"></div>
                    <div class="col-25">
                    <label>الرقم التسلسلي</label></div>
            </div>
            <div class="p3c-input-element">
                <div class="col-75">
                    <input class="inpt"  type="text" name="available_quantity"></div>
                    <div class="col-25">
                    <label>الكمية المتوفرة</label></div>
            </div>
            <div class="p3c-input-element ">

                <div class="col-75">
                <select name="cat_name" class="input100">
                <option value="">اختر قسم</option>
                @foreach($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
                </select>
                </div>
                <div class="col-25">
                    <label  for="category">القسم</label></div>
            </div>
            <div class="p3c-input-element">
                <div class="col-75">
                    <input class="checkbox"  type="checkbox" name="able_to_borrow" checked></div>
                    <div class="col-25">
                    <label>متاح للإستعارة</label></div>
            </div>
            <div class="p3c-input-element">
                <div class="col-75">
                    <input class="checkbox"  type="checkbox" name="able_to_download" checked></div>
                    <div class="col-25">
                    <label>متاح للتنزيل</label></div>
            </div>
        </form>
        <button class="sbtn"  onclick="onsendEvent()" id="ppp-ok-btn" ok-button>حفظ</button>
        <button class="cbtn" onclick="exit_click()">إلغاء</button>


        </div>
    </div>

        <script>
            const escapeDetecetion = (e) => {
                    //console.log("fired", e.key);
                        if(e.key == "Escape")
                        exit_click();
            };
            function configurePopup(isForAddingNewBook, target) {
                if(target == null) return;

                let bookID = target.parentElement.parentElement.children[0].textContent;
                let titleElement = document.querySelector("#ppp-id");
                let okButton = document.querySelector("#ppp-ok-btn");
                let imageContainer =document.querySelector("#image-container");

                document.body.addEventListener('keydown', escapeDetecetion);

                if(isForAddingNewBook) {
                    titleElement.textContent = "إضافة كتاب";
                    popupRoute = '{{ route("book.store") }}';
                    okButton.textContent = "حفظ";
                    imageContainer.style.display = "block";

                }
                else {
                    titleElement.textContent = "تعديل كتاب";
                    popupRoute = '/update-book';
                    okButton.textContent = "تحديث";
                    imageContainer.style.display = "none";


            // pre-fill form inputs..
                // take the values form the target.parentElement.parentElement[...]
                // id..
                let id_input = document.querySelector("input[name='id']");
                id_input.value = bookID;
                // title..
                let title_input = document.querySelector("input[name='title']");
                title_input.value = target.parentElement.parentElement.children[1].textContent;
                // author..
                let author_input = document.querySelector("input[name='author']");
                author_input.value = target.parentElement.parentElement.children[2].textContent;
                // publisher..
                let puplisher_input = document.querySelector("input[name='publisher']");
                puplisher_input.value = target.parentElement.parentElement.children[3].textContent;
                // available quantity..
                let aq_input = document.querySelector("input[name='available_quantity']");
                aq_input.value = target.parentElement.parentElement.children[5].textContent;
                // description..
                let desc_input = document.querySelector("input[name='description']");
                desc_input.value = target.parentElement.parentElement.children[6].textContent;
                // serial number..
                let serial_number_input = document.querySelector("input[name='serial_number']");
                serial_number_input.value = target.parentElement.parentElement.children[4].textContent;
                // category..
                let category_input = document.querySelector("select[name='cat_name']");
                category_input.value = target.parentElement.parentElement.children[7].textContent;
                // able to borrow...
                let ableToBorrow_input =document.querySelector('input[name="able_to_borrow"]');
                //console.log("'"+target.parentElement.parentElement.children[8].textContent.includes('نعم')+"'", target.parentElement.parentElement.children[8].textContent)
                ableToBorrow_input.checked = target.parentElement.parentElement.children[8].textContent.includes('نعم');
                // able to download...
                let ableToDownload_input =document.querySelector('input[name="able_to_download"]');
                ableToDownload_input.checked = target.parentElement.parentElement.children[9].textContent.includes('نعم');
                //console.log(bookID);

            }


        }
        function onsendEvent(e) {
            let formData = new FormData(document.querySelector('#myForm'));
          //  let csrf_token = document.querySelector('meta[name="csrf-token"]').content;
            fetch(popupRoute, {
                method: 'post',
                credentials: "same-origin",
                body: formData
            }).then(v => v.json())
            .then(v => {
                console.log(v);
                alert(v.result);
                location.reload();
            })
            .catch(error => {
                console.error(error);
            });}

            function exit_click() {

            let popup= document.querySelector('#divID');
            popup. style. display = "none";
            document.body.removeEventListener('keydown', escapeDetecetion);
            }

            function show() {
            let popup= document.querySelector('#divID');
            popup. style. display = "block";
            }

    </script>

</body>
</html>
