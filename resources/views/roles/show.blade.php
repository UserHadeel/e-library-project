<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('bookstyle/css/popupStyle.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('role/css/role-show.css')}}">
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">>
    <title>عرض صلاحية </title>
</head>
<body>

    <div>
        @include('pro.nav-and-header')
    </div>

<main>
<div class="container">
<section class="table_header">
<h1 class="category-title">
    <span class="Title"><h2> عرض الصلاحية</h2></span>
 </h1>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <p>الأسم:</p>
                <span>{{ $role->name }}</span>
            </div>
            <br/><br/>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="permissions"><P>الصلاحيات:</P></label>
                <div id="permissions" class="permissions">
                    @if(!empty($rolePermissions))
                        @foreach($rolePermissions as $v)
                            <span class="label label-success">{{ $v->name }}</span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
</body>
</html>
