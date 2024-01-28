<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="csrf-token content={{csrf_token()}}">
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="{{asset('categorystyle/css/category.css')}}">
<link rel="stylesheet" href="{{asset('categorystyle/css/popupStyle2.css')}}">
<link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">
<title>الأقسام</title>
</head>

<body>

            <div>
                @include('pro.nav-and-header')
            </div>

<script>
    window.selectedRow = null;
</script>
<main>
    @can('قائمة-اقسام-الكتب')
    <div class="container">
    <div class="add-category">
            <h1 class="category-title">
                <span class="Title"> أضافة قسم</span>
            </h1>

            @can('انشاء-قسم-كتب')
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 10px;">
                    <label class="ca-name" for="name">أضافة قسم :</label>
                    <br>
                    <input class="input" type="text" id="name" name="name" required placeholder="أدخل أسم القسم">
                </div>
                <div>
                    <button type="submit" class="add-button-category">حفظ</button>
                    <!-- {{-- <a href="{{ route('category.index') }}" class="cancel-button">Cancel</a> --}} -->
                </div>
            </form>
            @endcan
        </div>


        <div class="category-list">
        <h1 class="category-title">
           <span class="Title"> قائمة الأقسام</span>
        </h1>


            <table class="styled-table">
                <thead>
                    <tr>
                        <th>أسم القسم</th>
                        @endcan
                        @can('تعديل-قسم-كتب')
                        <th>تعديل</th>
                        @endcan
                        @can('حذف-قسم-كتب')
                        <th>حذف</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>

                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        @can('تعديل-قسم-كتب')
                        <td>

                            <a  class="edit-icon" onclick="openPopup();document.querySelector('#myIDHere').value
                            = this.parentElement.parentElement.children[0].innerText;
                            document.querySelector('#myInputTag').value
                            = this.parentElement.parentElement.children[0].innerText; window.selectedRow = this;">
                            <i class="fas fa-pencil-alt icon-edit"></i>
                            </a>

                        </td>
                        @endcan

                        @can('حذف-قسم-كتب')
                        <td>
                            <form action="{{ route('category.destroy', $category->name) }}" method="POST" onsubmit="return confirm('هل أنت متأكد أنك تريد حذف هذا القسم ؟')">
                                @method('DELETE')
                                @csrf
                                <!-- {{-- <button type="submit" class="delete-icon">
                                    <img src="{{asset('categorypage/img/delete.jpg')}}" alt="Delete" style="width: 24px; height: 24px;">
                                </button> --}} -->
                                <button type="submit" class="delete-icon"><i class="fas fa-trash-alt icon" ></i>
                            </form>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- {{-- <a href="{{ route('category.create') }}" class="add-button">Add</a> --}} -->
        </div>
    </div>
</main>
<div class="popup"  id="divID" style="display: none;">
    <div class="ppp-header">
        <h3 class="title">تعديل القسم</h3>
    </div>
    <div class="ppp-content">
        <form  id="myForm" method="post">
        @csrf
        <input  type="hidden" name="_token" value="{{csrf_token() }}" />
        <div class="p3c-input-element">

            <div class="col-75">
            <input class="inpt" type="text" id="myInputTag" name="name" >
        </div>
        <div class="col-25">
            <label>الأسم:</label>
        </div>
            <input type='hidden' id='myIDHere' />
        </div>

    </form>

    <button class="sbtn"  onclick="save_click()">حفظ</button>
    <button class="cbtn" onclick="exit_click()">اغلاق</button>
    </div>
</div>
    <script>
        function save_click(e) {
            let formData = new FormData(document.querySelector('#myForm'));
            let button=this;
            fetch('/update/'+document.querySelector('#myIDHere').value, {
                method: 'post',
                credentials: "same-origin",
                body: formData
            }).then(v => v.json())
            .then(v => {
                alert(v.result);
                location.reload();
            window.selectedRow.parentElement.parentElement.children[0].innerText = v.categories.name;

            closePopup();
            });



            }

            function exit_click() {
            let popup= document.querySelector('#divID');
            popup. style. display = "none";}

            function openPopup() {
            let popup= document.querySelector('#divID');
            popup. style. display = "block";
            }
            function closePopup() {
            let popup= document.querySelector('#divID');
            popup. style. display = "none";
            }
    </script>


</body>
</html>
