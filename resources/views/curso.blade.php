

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <h1> Curso </h1>
            @yield("Content")
        <form name="form" method="post" action="/register">
        @csrf
        Producto: <input type="text" name="product"/>
        <br />
        Price: <input type="text" name="price"/>
        <br />
        <input type="submit" value="Send" title="Send"/>
        </form>
    </body>
</html>
