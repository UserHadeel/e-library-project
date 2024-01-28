
<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>طلب استعارة</title>
    <link rel="stylesheet" href="{{asset('Loan/css/create.css')}}">
</head>
<body>



<div class="limiter">
<div class="container-login100">
@isset ($err)
<script>
        alert(err)
        </script>
@endisset

    <div class="layout">

        <form method="POST" action="{{ route('projectloans.store', ['project' => $project->id]) }}">
        @csrf
        <span class="login100-form-title">
        {{ ('طلب استعارة' ) }} <span style="color:red; margin-right:17px;font-family: Poppins-Regular, sans-serif;"> " </span> <span class="title" style="color:green;"> {{$project->title}}</span>  <span style="color: red;font-family: Poppins-Regular, sans-serif;"> " </span>
        </span>


        <div class="wrap-input100 validate-input">
        <input class="input100" type="text" name="first_name" required placeholder="الاسم الاول" autofocus />
        </div>

        <div class="wrap-input100 validate-input">
        <input class="input100" type="text" name="last_name" required placeholder="اللقب" />
        </div>

        <div class="wrap-input100 validate-input">
        <input id="emailInput" class="input100" oninput="onEmaildataChanage(this);" type="text" name="email" required value=" {{Auth::user()->email}}"  />
        <p id="error-emaillabel"  style="margin-left:2em;font-size:10pt;color:red;display: none;"></p>
        </div>

        <div class="wrap-input100 validate-input">
        <input id="phoneNoInput" oninput="ondataChanage(this);" class="input100" type="text" name="phone" required  placeholder="رقم الهاتف" maxlength="12" pattern="(^2189[1|2|4][0-9]{7}$)|(^09[1|2|4][0-9]{7}$)" />
        <p id="error-label"  style="margin-left:2em;font-size:10pt;color:red;display: none;"></p>
        </div>

        <div class="wrap-input100 validate-input">
        <input class="input100" id="dateID" onchange="ondateValueChanged(this);" type="date" name="return_date"  required  placeholder="تاريخ الاسترجاع"/>
        <p id="error-datelabel"  style="margin-left:2em;font-size:10pt;color:red;display: none;"></p>
        </div>

        <div class="wrap-input100 validate-input">
        <input class="input100" type="text" name="number_borrowed" value="{{old('number_borrowed')}}" required placeholder="كم عدد النسخ التي ترغب في استعارتها؟" />
        <p id="error-avlabel"  style="margin-left:2em;font-size:10pt;color:red;display: none;"></p>
    </div>
            @error('number_borrowed')
            <div class="message">{{ $message }}</div>
            @enderror

    <div class="container-login100-form-btn">
      <button type="submit" class="login100-form-btnCreate"  id="send-button">
            <a href="{{ route('projectloans.store', ['project' => $project->id]) }}" style="color: white;">حفظ</a>
      </button>
    </div>
            </form>



  <div class="container-login100-form-btn">
      <button type="submit" class="login100-form-btnCancel" >
            <a href="{{route('projectloans.index')}}"style="color: white;">الغاء</a>
      </button>
  </div>
  <p class="note">ملاحظة: مدة الاستعارة يجب الا تزيد عن 7 أيام</p>
</div>

</div>
</div>

<script>
    const sendButton = document.querySelector('#send-button');
    function ondataChanage(e) {
        // return; // to skip this whole validation
        let label = document.querySelector("#error-label");
        if(/(^2189[1|2|4][0-9]{7}$)|(^09[1|2|4][0-9]{7}$)/.test(e.value) == false)

        {
            sendButton.innerHTML = "حفظ";
            sendButton.disabled = true;
            sendButton.style.cursor = "not-allowed";
            label.textContent = "خطأ. رقم هاتف غير صحيح";
            label.style.display = "block";
        } else {
            label.style.display = "none";
            console.log(e.value + " OK");
            sendButton.disabled = false;
            sendButton.style.cursor = "pointer";
            sendButton.innerHTML = "<a id='send-button' href='{{ route('projectloans.store', ['project' => $project->id]) }}'>حفظ</a>";
        }
    }


function ondateValueChanged(o) {
        // extracting values and converting to int on one time
        let errorLabel = document.querySelector("#error-datelabel");
        let dateValues = o.value.split('-').map(v => parseInt(v));
        let year = dateValues[0];
        let month = dateValues[1];
        let day = dateValues[2];

        function okState() {
            errorLabel.style.display = "none";
            errorLabel.textContent = "";
            sendButton.disabled = false;
            sendButton.style.cursor = "pointer";
        }
        function failureState() {
            sendButton.innerHTML = "حفظ";
            sendButton.disabled = true;
            sendButton.style.cursor = "not-allowed";
            // errorLabel.style.display = "block";
            // errorLabel.textContent = "خطأ! تاريخ غير صالح، لا يمكنك تحديد تاريخ في الماضي";
        }

        let nowDate = new Date();
        let userSelectedDate = new Date(month+"/"+day+"/"+year);
        let amountOfDays = (userSelectedDate - nowDate)/(1000 * 3600 * 24);

        // check if days is less than one day (0.x)
        if(amountOfDays < 0) {
            alert("لايمكنك اختيار تاريخ قديم.");
            failureState();
        }
        else if(amountOfDays < 1) {
            alert("لا يمكنك استعارة كتاب لمدة تقل عن يوم واحد.");
            failureState();
        }
        else if(amountOfDays > 7 ) { // iff you want 7 then choose 8 is safer>>
            // check if days is about two weaks (15 is more than two weaks
            // bc we dealing with milli seconds..)
            alert("لا يمكنك استعارة كتاب لأكثر من 7 ايام.");
            failureState();
        }
        else {
            okState();
        }
         console.log("Days : ", (userSelectedDate - nowDate)/(1000 * 3600 * 24));

    }


    function onEmaildataChanage(a) {
        let label = document.querySelector("#error-emaillabel");
        if(/^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(a.value) == false)

        {
            sendButton.innerHTML = "حفظ";
            sendButton.disabled = true;
            sendButton.style.cursor = "not-allowed";
            label.textContent = "خطأ. تنسيق البريد الإلكتروني غير صحيح";
            label.style.display = "block";
        } else {
            label.style.display = "none";
            console.log(a.value + " OK");
            sendButton.disabled = false;
            sendButton.style.cursor = "pointer";
            sendButton.innerHTML = "<a id='send-button' href='{{ route('projectloans.store', ['project' => $project->id]) }}'>حفظ</a>";

        }


    }


</script>
</body>
</html>
