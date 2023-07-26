<?php

namespace App\Http\Controllers;

use App\Models\AttributeOption;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductAttributeValue;

class ProductController extends Controller
{
    protected $data = [];
    public function __construct()
    {
        // mengambil paren_id = null di tabel category
        $this->data['categories'] = Categories::parentCategories()->orderBy('name','asc')->get();

        // mengambil color
        $this->data['colors'] = AttributeOption::whereHas('attribute', function ($query) {
            $query->where('code', 'color')
                ->where('is_filterable', 1);
        })->orderBy('name', 'asc')->get();
        
        // mengambil size
        $this->data['sizes'] = AttributeOption::whereHas('attribute', function ($query){
            $query->where('code', 'size')
            ->where('is_filterable', 1);
        })->orderBy('name', 'asc')->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {       
        // dd(request('search'));
        // active() dari model product
        $productQuery = Product::active();
        // dd($productQuery);

        // Menambahkan kondisi pencarian dan kondisi parent_id null
        $productQuery->where(function ($query) use ($request) {
            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('slug', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('short_description', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('description', 'like', '%' . $request->input('search') . '%');
            }
            $query->whereNull('parent_id');
        });

        // menu mengambil product berdasarkan category
        if ($categorySlug = $request->query('category')){
            $category = Categories::where('slug', $categorySlug)->firstOrFail();
            
            // mengambil sub dari parent category
            $childIds = Categories::childIds($category->id);
            // dd($childIds);
            $categoryIds = array_merge([$category->id], $childIds);
            $products = $productQuery->whereHas('categories', function ($query) use ($categoryIds){
                $query->whereIn('categories.id', $categoryIds);
            });
        }

        // menu mengambil product berdasarkan warna
        if ($attributeOptionID = $request->query('option')){
            $attributeOption = AttributeOption::findOrFail($attributeOptionID);

            $products = $productQuery->whereHas('ProductAttributeValues', function ($query) use ($attributeOption){
                $query->where('attribute_id', $attributeOption->attribute_id)
                ->where('text_value', $attributeOption->name);
            });
        }

        // Dapatkan produk berpaginasi
        $products = $productQuery->latest()->paginate(9);
        
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
            $this->data['colors'] = ProductAttributeValue::getAttributeOptions($product, 'color')->pluck('text_value', 'text_value');
            $this->data['sizes'] = ProductAttributeValue::getAttributeOptions($product, 'size')->pluck('text_value', 'text_value');
        }

        $this->data['product'] = $product;

        return view('theme.marcus.products.show', $this->data);
    }
}
