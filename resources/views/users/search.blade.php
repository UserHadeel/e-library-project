<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Members</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('userstyle/css/userindex.css')}}">
</head>
<body>
    <form action="{{ route('user.index') }}" method="GET" class="search-form">
        @csrf
        {{-- <input type="hidden" name="_token" value="{{csrf_token() }}" /> --}}
        <div class="search-wrapper">
            {{-- <span class="las la-search"></span> --}}
            <form action="{{ route('user.search') }}" method="GET">
                <input type="text" name="search" placeholder="Enter member name">
                <button type="submit" class="search-button">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </form>
    <main class="table">
        <section class="table_header">
            <h1>
                <span><i class="fas fa-list"></i>  Members List</span></h1>
        </section>
        <section class="table_body">
            @if ($users->count() > 0)
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Member name</td>
                    <td>Email</td>
                    <td>State</td>
                    <td>Operation</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </section>
     </main>
     @else
        <p>No members found.......................</p>
    @endif
</body>
</html>


