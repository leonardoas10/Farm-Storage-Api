<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/curso.css')}}" type="text/css">
        <title>Laravel</title>
    </head>
    <body>
        <form class="form" name="form" method="post" action="/register">
            <h1> Curso </h1>
            @csrf
            Producto: <input id="product" type="text" name="product" class="@error('product') hasError @enderror"/>
            @error('product')
                <span style="color: red"> {{$message}}</span>
            @enderror
            <br />
            Price: <input id="price" type="text" name="price"/>
            <br />
            <input id="send" type="submit" value="Send" title="Send"/>
        </form>

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
    </body>
    <script >
        const editProducts = document.querySelectorAll(".editProduct");
        const deleteProducts = document.querySelectorAll(".deleteProduct");
        const productInput = document.getElementById("product");
        const priceInput = document.getElementById("price");
        const sendInput = document.getElementById("send");
        let selectedProdId;

        

        editProducts.forEach(function(editProduct) {
            editProduct.addEventListener("click", function (e) {
                selectedProdId = e.currentTarget.id;
                const currentProduct = e.currentTarget.dataset.product;
                const currentPrice = e.currentTarget.dataset.price;
                productInput.value = currentProduct;
                priceInput.value = currentPrice; 
                e.preventDefault();
            })
        });

        sendInput.addEventListener("click", function (e) {
                if(selectedProdId) {
                    e.preventDefault();
                    fetch("http://localhost:8000/curso/" + selectedProdId, {
                
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    product: productInput.value,
                    price: priceInput.value,
                })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                    location.reload();
                    }
                    else {
                        console.log("error");
                    }
                })
                .catch(err => console.log(err, "Fetch Update Error"));
                }
        });

        deleteProducts.forEach(function(deleteProduct) {
            deleteProduct.addEventListener("click", function (e) {
                selectedProdId = e.currentTarget.id;
                e.preventDefault();
                if(selectedProdId) {
                fetch("http://localhost:8000/curso/" + selectedProdId, {
                method: 'DELETE',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                    else {
                        console.log("error");
                    }
                })
                .catch(err => console.log(err, "Fetch Delete Error"));
            }
            })
        });
        
    </script> 
</html>


