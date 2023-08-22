<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // function products(){
    //     return view('products');
    // }
    function products(){
        $products = Product::latest()->paginate(5);
        return view('products',compact('products'));
    }
    //add product
    public function addProduct(Request $request){
        $request->validate(
            [
                'name'=>'required|unique:products',
                'price'=>'required'
            ],
            [
                'name.required'=>'Name is Required',
                'name.unique'=>'Product already Exists',
                'price.required'=>'Price is Required',
            ]
            );

            // For data insert start
            $product = new Product();
            $product->name=$request->name;
            $product->price=$request->price;
            $product->save();
             // For data insert end

            // For refresh modal
            return response()->json(
                [
                    'status'=>'success',
                ]
                );

    }
    //add product
    public function updateProduct(Request $request){
        $request->validate(
            [
                'update_name'=>'required|unique:products,name,'.$request->update_id,
                'update_price'=>'required'
            ],
            [
                'update_name.required'=>'Name is Required',
                'update_name.unique'=>'Product already Exists',
                'update_price.required'=>'Price is Required',
            ]
            );

            Product::where('id',$request->update_id)->update([
                'name'=>$request->update_name,
                'price'=>$request->update_price,
            ]);

            // For refresh modal
            return response()->json(
                [
                    'status'=>'success',
                ]
                );

    }
    function deleteProduct(Request $request){
        Product::find($request->product_id)->delete();
        return response()->json(
            [
                'status'=>'success',
            ]
            );

    }
    //pagination
    function pagination(Request $request){
        $products = Product::latest()->paginate(5);
        return view('pagination_products',compact('products'))->render();

    }

    //search product
    function searchProduct(Request $request){
        $products = Product::where('name','like','%'.$request->search_string.'%')
        ->orwhere('price','like','%'.$request->search_string.'%')
        ->orderBy('id','desc')
        ->paginate(5);

        if($products->count() >=1){
            return view('pagination_products',compact('products'))->render();
        }else{
            return response()->json([
                'status'=>'nothing_found'
            ]);
        }
    }
}
