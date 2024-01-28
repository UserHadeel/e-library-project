<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('bookstyle/css/popupStyle.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('role/css/role-create.css')}}">
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">>
    <title>تعديل صلاحية</title>
</head>
<body>

    <div>
        @include('pro.nav-and-header')
    </div>

<main>
<div class="container">
<section class="table_header">
<h1 class="category-title">
    <span class="Title"><h2>تعديل الصلاحية</h2></span>
 </h1>
    <!-- {{-- <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
    <a class="create" href="{{ route('roles.index') }}"> Back</a> --}} -->

       @if (count($errors) > 0)
         <div class="alert alert-success">
             كانت هناك بعض المشاكل مع المدخلات الخاصة بك.<br><br>
            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

                </ul>
          </div>
       @endif

       <form method="POST" action="{{ route('roles.update', $role->id) }}">
        @method('PATCH')
        @csrf
          <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">
                <strong style="font-size: 20px;font-family:'Times New Roman', Times, serif">الأسم:</strong>
                <input class="inpt" type="text" name="name" required placeholder="أسم الصلاحية" value="{{ $role->name }}">
              </div>
              <br/><br/>

          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

              <strong style="font-size: 20px;font-family:'Times New Roman', Times, serif">الصلاحيات:</strong><br/>
              <br/>
              <div class="checkbox-group">
                 @foreach($permission as $value)
                 <label>
                    <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="name" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                    {{ $value->name }}
                </label>
                <br/>
                @endforeach
              </div>

            </div>

         </div>

         <div class="col-xs-12 col-sm-12 col-md-12 text-center">

            <button type="submit" class="create">حفظ</button>

        </div>
      </form>

<!-- {{-- {!! $roles->render() !!} --}} -->
</body>
</html>
