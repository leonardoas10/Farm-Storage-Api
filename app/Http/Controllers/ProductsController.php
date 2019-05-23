<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductsController extends Controller {

    public function getAll(Request $request) {
        $products = DB::table('products')->orderBy('id')->get();

        return [
            "products" => $products,
            "success" => true,
        ];
    }
    public function register(Request $request) {

        $product = $request->input('product');
        $price = $request->input('price');
         if ($request->input('product') !== null && $request->input('price') !== null) {
            $products = DB::table('products')->where('product', $product )->first();
            if($products === null) {
            DB::table('products')->insert(
                [
                'product' => $product,
                'price' => $price,
                ]
            );
            }
             return [
                "product" => $product,
                "price" => $price,
                "success" => true, 
            ];
     }
     else {
         return response ( ["message" => "invalid credentials", "success" => false], 404);
     }
    }

    public function update(Request $request, $id) {
        $product = $request->input('product');
        $price = $request->input('price');
            $products = DB::table('products')->where('id', $id)
            ->update(
            [
                'product' =>$product,
                'price' => $price,
            ]);
            return [
                "product" => [
                    'product' => $product,
                    'price' => $price,
                    'id' => $id
                ],
                "success" => true, 
            ];
    }
}