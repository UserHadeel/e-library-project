<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">
    <title>Profile</title>
    <style>
        .container{
            width: 70%;
            margin-left: 7%;
            padding: 20px;
            float: left;
            background: #fff;
            border-radius: 30px;
        }

        .max-w-xl {
            max-width: 100%;
        }
        .sidebar-brand span,
        header h2 {
            font-size: 25px;
            font-weight: bold;


        }
        #nav-toggle:checked ~ main .container{
           margin-left: 70px;
           width: calc(100% - 70px);
}
    </style>
</head>
<body>

    <div>
        @include('userprofile.side-head.side-head')
    </div>

    <x-app-layout>
    <div class="container" style="
        margin-left: 2%;
  width: 100%;
  padding-right: 30px;
  height: 100%;">
        <div class="py-12" style="margin-right: -24%;" >
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" >
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg main-content">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg main-content">
                    <div class="max-w-xl">
                        @include('userprofile.partials.update-password-form')
                    </div>

                    <div class="max-w-xl " >
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>

    </x-app-layout>
</body>
</html>
