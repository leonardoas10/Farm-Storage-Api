<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
    </head>
    <body>

            @yield("Content")
            <!--  Aqui es -->
            <div class="content">
                <div class="title m-b-md">
                
                </div>
                <div className="Register">
                <h1>Register</h1>
                <label>Product</label>
                <input
                    className="input-nosubmit"
                    name="Product"
                    type="name"
                    placeholder="...";
                />
                <label>Price</label>
                <input
                    className="input-nosubmit"
                    name="Price"
                    type="email"
                    placeholder="...";
                />
                <button  className='submit-buttom' type="button" onClick={this.fetchRegister}>Register</button>
            </div>
            </div>
        </div>
    </body>
</html>
