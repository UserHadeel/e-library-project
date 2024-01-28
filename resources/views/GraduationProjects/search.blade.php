<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>search</title>
</head>
<body>
    <div>
        <h1>Search Results</h1>

        <form action="{{ route('GraduationProjects.search') }}" method="GET">
            <div>
                <input type="text" name="search" placeholder="Search by title">
                <div >
                    <button type="submit">Search</button>
                </div>
            </div>
        </form>

        @if ($Projects->count() > 0)
        <section class="table_body">
                <table >
                    <thead>
                        <tr>
                            <th style="display: none;">#</th>
                            <th>العنوان</th>
                            <th>اسم الطالب</th>
                            <th>اسم المشرف</th>
                            <th>السنة </th>
                            {{-- <th>الكمية المتوفرة</th>
                            <th>الوصف</th> --}}
                            {{-- <th>القسم</th> --}}
                            @can("تعديل-كتاب")
                            <th>تعديل</th>
                            @endcan
                            @can("حذف-كتاب")
                            <th>حذف</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($Projects as $Project)
                    <tr>
                        <td style="display: none;">{{ $Project->id }}</td>
                        <td>{{ $Project->title }}</td>
                        <td>{{ $Project->student_name }}</td>
                        <td>{{ $Project->supervisor_name }}</td>
                        <td>{{ $Project->year}}</td>
                </tbody>
            </table>
        @else
        <p>لم يتم العثور على المشروع.</p>
        @endif
    </div>

</body>
</html>
