<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductAttributeValue;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::active()->paginate(9);
        // dd($products);
        return view('theme.marcus.products.index', compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::active()->where('slug',$slug)->first();
        if(!$product){
            return redirect('products');
        }

        if ($product->type == 'configurable') {
            $colors = ProductAttributeValue::getAttributeOptions($product, 'color')->pluck('text_value', 'text_value');
            $sizes = ProductAttributeValue::getAttributeOptions($product, 'size')->pluck('text_value', 'text_value');
        }

        // $product = $product;

        return view('theme.marcus.products.show', compact('product', 'colors', 'sizes'));
    }
}
