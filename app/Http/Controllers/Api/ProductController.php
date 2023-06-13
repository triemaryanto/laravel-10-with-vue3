<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $description = $request->input('description');
        $tags = $request->input('tags');
        $categories = $request->input('categories');

        $price_form = $request->input('price_form');
        $price_to = $request->input('price_to');

        if($id){
            $product = Product::with(['category', 'galleries'])->find($id);
            if($product)
            {
                return ResponseFormatter::success(
                    $product,
                    'Data Product Berhasil diambil'
                );
            }
            else{ 
                return ResponseFormatter::error(
                    null,
                    'Data Product tidak ada',
                    404
                );
            }
        }
        $product = Product::with(['category', 'galleries']);

        if($name){
            $product->where('name', 'like', '%' .$name. '%');
        }
        if($tags){
            $product->where('tags', 'like', '%' .$tags. '%');
        }
        if($description){
            $product->where('name', 'like', '%' .$description. '%');
        }
        if($price_form){
            $product->where('name', '>=',$price_form);
        }
        if($price_to){
            $product->where('name', '<=', $price_to);
        }
        if($categories){
            $product->where('name', $categories);
        }
        return ResponseFormatter::success(
            $product->paginate($limit),  
            'Data Product berhasil diambil'
        );
    }
}
