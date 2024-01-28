<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DashBoard</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('dash/css/dash_board.css')}}">
</head>
<body>

    <div>
        @include('pro.nav-and-header')
    </div>


    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                <span class="las la-bars"></span>
                </label> Dashboard</h2>


                <div class="user-wrapper">
    <div class="dropdown">
    <input type="checkbox" id="notification-toggle" class="toggle-checkbox">
    <label for="notification-toggle" class="toggle-label">
        <i class="fas fa-bell notification-icon" >
        <span class="icon-button__badge" >{{Auth::User()->unreadNotifications->count()}}</span>
        </i>
    </label>
<div class="dropdown-menu">
    <div class="dropdown-header">
    <span>Notifications</span>
    </div>
        @foreach (Auth::User()->unreadNotifications as $notification)
        <ul class="notifications" >
        <strong >{{ $notification->data['user_create'] }}</strong><br>
        <a href="{{ route('loans.index')}}" class="p">New borrowing</a><br>
        <small>{{$notification->created_at}}</small>
        </ul>
        @endforeach
       </div>
        </div>
        <i class="fas fa-user-circle profile-icon" ></i>
            <div>
            <h4> {{Auth::user()->name}}</h4>
            </div>
            </div>
    </header>
<min>

</min>
</body>
</html>
