<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/curso.css')}}" type="text/css">
        <title>Laravel</title>
    </head>
    <body>
        <form class="form" name="form" method="post" action="/curso">
            <h1> Farm Storage </h1>
            @csrf
            Producto <input id="product" class="input type="text" name="product" class="@error('product') hasError @enderror"/>
            @error('product')
                <span style="color: red"> {{$message}}</span>
            @enderror
            <br />
            Price <input id="price" class="input type="text" name="price" class="@error('price') hasError @enderror"/>
            @error('price')
                <span style="color: red"> {{$message}}</span>
            @enderror
            <br />
            <input class="send "id="send" type="submit" value="Send" title="Send"/>
        

        <table class="bording-table">
            <tbody class="margin-table">
                <tr>
                    <td class="withoutborder leftmargin"><strong>Product</strong></td>
                    <td class="withoutborder"><strong>Price</strong></td>
                </tr>
                @foreach ($products as $product)
                    <tr id="{{$product->id}}">
                        <td class="squares leftmargin">{{$product->product}}</td>
                        <td class="squares">{{$product->price}}</td>
                        <td class="squares"><a class="editProduct" id="{{$product->id}}" data-product="{{$product->product}}" data-price="{{$product->price}}"href="javascript:void(0)">Edit</a></td>
                        <td class="delete-square squares"> <a class="deleteProduct" id="{{$product->id}}" href="javascript:void(0)">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </form>
    </body>
    <script src="edit.js"></script> 
</html>


