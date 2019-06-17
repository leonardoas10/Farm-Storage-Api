<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\StartProduct;


class ProductsController extends Controller {

    public function getAll(Request $request) {
        $products = DB::table('products')->orderBy('id')->get();
        if($request->ajax()) {
            return [
                "products" => $products,
                "success" => true,
            ];
        }
       else {
           return view('curso', ["products"=> $products]);
       }
    }
    public function register(StartProduct $request) {
        $product = $request->input('product');
        $price = $request->input('price');
        $products = DB::table('products')->where('product', ucwords($product) )->first();
            if($products === null) {
            $id = DB::table('products')->insertGetId(
                [
                'product' => ucwords($product),
                'price' => $price,
                ]
            );
            // return view('curso');
            return redirect('/curso');
                // "product" => ucwords($product),
                // "price" => number_format((float)$price, 2,".",'' ),
                // "success" => true, 
                // "id" => $id,
                // donde coloco esto?
        
            }
             
            else {
                return view('curso')->withErrors(["message" => "este producto existe", "success" => false]);
                // response ( ["message" => "invalid credentials", "success" => false], 404);
                // Es un catch?
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

    public function destroy(Request $request, $id) {
        $products = DB::table('products')->where('id', $id)->delete();
        return [
            "success" => true,
        ];
    }
}