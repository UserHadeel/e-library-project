
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/store" method="post">
        @csrf
        <input type="hidden" name="_token" value="{{csrf_token() }}" />
        <label>Title</label><input type="text" name="title"><br>
        <label>Author</label><input type="text" name="author"><br>
        <label>Publisher</label><input type="text" name="publisher"><br>
        <label>Serial Number</label><input type="text" name="serial_number"><br>
        <label>Desctiption</label><input type="text" name="description"><br>
        <label>Available Quantity</label><input type="text" name="available_quantity"><br>

        <input type="submit" value="create">
    </form>

</body>
</html>
