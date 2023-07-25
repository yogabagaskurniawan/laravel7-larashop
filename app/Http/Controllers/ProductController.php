<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductAttributeValue;

class ProductController extends Controller
{
    protected $data = [];
    public function __construct()
    {

        $this->data['categories'] = Categories::parentCategories()->orderBy('name','asc')->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        // dd(request('search'));
        $query = Product::active();
        // dd($products);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('slug', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('short_description', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('description', 'like', '%' . $request->input('search') . '%');
        }

        $products = $query->latest()->paginate(9);

        return view('theme.marcus.products.index', $this->data, compact('products'));
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
