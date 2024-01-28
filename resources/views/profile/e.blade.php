<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/p.css')}}">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <title>Profile</title>
    </head>
    <body">
     <div class="container">
        <div class="leftbox">
            <nav>

            <div class="sidebar-brand">
            <h3><span class="lab la-accusoft"></span><span>Library</span></h3>
        </div>

                <a onclick="tabs(0)" class="tab active">
                <i class="fas fa-user"></i>
                </a>
                <a onclick="tabs(1)" class="tab">
                <i class="fa-solid fa-lock"></i>
                </a>
                <a onclick="tabs(3)" class="tab">
                <i class="fa-regular fa-bell"></i>
                </a>
            </nav>
        </div>

        <div class="rightbox">
            <div class="profile tabshow">
                <h1>Personal Info</h1>
                <h2> Name</h2>
                <input type="text" class="input" value="{{Auth::user()->name}}">
                <h2>Email</h2>
                <input type="text" class="input" value="{{Auth::user()->email}}">


                <button class="btn"><a style="text-decoration: none;" href="{{ route('profile.update') }}">Update</a></button>
            </div>
            

            <div class="password tabshow">
                <h1>Password</h1>
                <h2>Current Password </h2>
                <input type="password" class="input" >
                <h2>New Password</h2>
                <input type="password" class="input" >
                <h2>Confirm Password</h2>
                <input type="password" class="input">
                <button class="btn">Update</button>
            </div>

            <div class="delete tabshow">
                <h1>Delet </h1>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

    </div>
    </div>
    <script src="jquery/jquery.js"></script>
    <script>
        const tabBtn = document.querySelectorAll(".tab");
        const tab = document.querySelectorAll(".tabshow");
        function tabs(panelIndx){
            tab.forEach(function(node){
                node.style.display="none"
            });
            tab[panelIndx].style.display="block";
        }
        tabs(0)
    </script>

    <script>
        $(".tab").click(function(){
            $(this).addClass("active").siblings().removeClass("active")
        })

    </script>

    </body>
</html>
