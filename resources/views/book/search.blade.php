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

        <form action="{{ route('book.search') }}" method="GET">
            <div>
                <input type="text" name="search" placeholder="Search by title">
                <div >
                    <button type="submit">Search</button>
                </div>
            </div>
        </form>

        @if ($books->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>Serial Number</th>
                        <th>Available Quantity</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ $book->serial_number }}</td>
                            <td>{{ $book->available_quantity }}</td>
                            <td>{{ $book->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No books found.</p>
        @endif
    </div>

</body>
</html>
