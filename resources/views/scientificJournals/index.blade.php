<!DOCTYPE html>
 <html lang="en" dir="rtl">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('scientificJournalsStyle/css/popupStyle3.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('bookstyle/index.css')}}">
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">
    <title>المجلات العلمية</title>
    <script>
        var popupRoute = '{{ route("scientificJournals.store") }}';
    </script>
</head>
<body>
            <div>
                @include('pro.nav-and-header')
            </div>


    <main>
    <div class="container">
    <form action="{{ route('scientificJournals.search') }}" method="post" class="search-form">
        @csrf
        <div class="search-wrapper">
                <button type="submit" class="search-button">
                    <span class="las la-search"></span>
                </button>
                <input type="text" name="query" placeholder="  البحث ">
        </div>
    </form>


    <section class="table_header">

            <span class="Title"> قائمة المجلات العلمية</span>
            @can('انشاء-مجلة')
            <a onclick="configurePopup(true, this); show()"  class="create_journals" >إضافة مجلة علمية</a>
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


    @if ($scientificJournals->count() > 0)
<section class="table_body">
        <table >
            <thead>
                <tr>
                    <th style="display: none;">#</th>
                    <th>العنوان</th>
                    <th>الناشر</th>
                    <th>سنة النشر</th>
                    <th>يمكن تنزيله</th>
                    <th>الملف</th>
                    @can("تعديل-مجلة")
                    <th>تعديل</th>
                    @endcan
                    @can("حذف-مجلة")
                    <th>حذف</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($scientificJournals as $scientificJournals)
                    <tr>
                        <td style="display: none;">{{ $scientificJournals->id }}</td>
                        <td>{{ $scientificJournals->title }}</td>
                        <td>{{ $scientificJournals->publishing }}</td>
                        <td>{{ $scientificJournals->Year_of_publication }}</td>
                        <td>
                            @if($scientificJournals->able_to_download == null)
                                لا
                            @else
                            {{ ($scientificJournals->able_to_download == 1) ? "نعم" : "لا" }}
                            @endif
                        </td>
                        <td>{{ $scientificJournals->resource ?? "لا يوجد/ غير متوفر" }}</td>
                        @can("تعديل-مجلة")
                        <td>
                            <a onclick="configurePopup(false, this); show();" xhref="{{ route('scientificJournals.edit', $scientificJournals->id) }}" class="edit-icon"><i class="fas fa-pencil-alt icon-edit"></i>
                            </a>
                        </td>
                        @endcan

                        @can("حذف-مجلة")
                        <td>
                            <form action="{{ route('scientificJournals.destroy', $scientificJournals->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذه المجلة؟')">
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
        <p>لم يتم العثور على هذه المجلة.</p>
    @endif
</div>
<main>
<div class="popup"  id="divID" style="display: none;">
    <div class="ppp-header">
        <h3 class="title" id="ppp-id">إضافة مجلة</h3>
    </div>
    <div class="ppp-content">
        <form  id="myForm" method="post" enctype="multipart/form-data">
        @csrf
        <input  type="hidden" name="_token" value="{{csrf_token() }}" />
        <input  type="hidden" name="id" value="" />

        <div class="p3c-input-element" id="image-container">
            <div class="col-75">
                <input class="inpt" type="file"name="image" ></div>
                <div class="col-25">
                <label for="image" >اختر صورة</label></div>
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
                <input class="inpt"  type="text" name="publishing"></div>
                <div class="col-25">
                <label>الناشر </label></div>
        </div>
        <div class="p3c-input-element ">
            <div class="col-75">
                <input class="inpt"  type="text" name="Year_of_publication"></div>
                <div class="col-25">
                <label>سنة النشر</label></div>
        </div>
        <div class="p3c-input-element">
                <div class="col-75">
                    <input class="checkbox"  type="checkbox" name="able_to_download" checked></div>
                    <div class="col-25">
                    <label>متاح للتنزيل</label></div>
        </div>

    </form>
    <button class="sbtn"  onclick="onsendEvent()" id="ppp-ok-btn">حفظ</button>
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

            let scientificJournalsID = target.parentElement.parentElement.children[0].textContent;
            let titleElement = document.querySelector("#ppp-id");
            let okButton = document.querySelector("#ppp-ok-btn");
            let imageContainer =document.querySelector("#image-container");

            document.body.addEventListener('keydown', escapeDetecetion);

            if(isForAddingNewBook) {
                titleElement.textContent = "إضافة مجلة علمية";
                popupRoute = '{{ route("scientificJournals.store") }}';
                okButton.textContent = "حفظ";
                imageContainer.style.display = "block";

            }
            else {
                titleElement.textContent = "تعديل مجلة علمية";
                popupRoute = '/update-scientificJournals';
                okButton.textContent = "تحدبث";
                imageContainer.style.display = "none";

                // pre-fill form inputs..
                // take the values form the target.parentElement.parentElement[...]

                // id..
                let id_input = document.querySelector("input[name='id']");
                id_input.value = scientificJournalsID;
                // title..
                let title_input = document.querySelector("input[name='title']");
                title_input.value = target.parentElement.parentElement.children[1].textContent;
                // publishing..
                let publishing_input = document.querySelector("input[name='publishing']");
                publishing_input.value = target.parentElement.parentElement.children[2].textContent;
                // Year_of_publication..
                let Year_of_publication_input = document.querySelector("input[name='Year_of_publication']");
                Year_of_publication_input.value = target.parentElement.parentElement.children[3].textContent;
                let ableToDownload_input =document.querySelector('input[name="able_to_download"]');
                ableToDownload_input.checked = target.parentElement.parentElement.children[4].textContent.includes('نعم');
                // console.log(scientificJournalsID);
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
            }

            function show() {
            let popup= document.querySelector('#divID');
            popup. style. display = "block";
            }

    </script>

</body>
 </html>
