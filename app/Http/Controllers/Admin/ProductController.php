<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Categories;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Session\Session;
use App\Http\Requests\ProductImageRequest;


class ProductController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [];
        $this->data['statuses'] = Product::statuses();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name', 'asc')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::orderBy('name', 'asc')->get();
        // $categories = $categories->toArray();
        $product = null;
        $productID = 0;
        $categoryIDs = [];
        return view('admin.products.form', $this->data ,compact('categories','product', 'categoryIDs', 'productID'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);
        $params['user_id'] = Auth::user()->id;

        $saved = false;
        $saved = DB::transaction(function () use ($params) {
            $product = Product::create($params);
            $product->categories()->sync($params['category_ids']);

            return true;
        });

        if($saved){
            $request->session()->flash('success', 'Product has been saved');
        } else {
            $request->session()->flash('error', 'Product could not be saved');
        }

        return redirect('admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(empty($id)){
            return redirect('admin/products/create');
        }

        $product = Product::findOrFail($id);
        $categories = Categories::orderBy('name', 'ASC')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['product'] = $product;
        $this->data['productID'] = $product->id;
        $this->data['categoryIDs'] = $product->categories->pluck('id')->toArray();

        return view('admin.products.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['slug'] = Str::slug($params['name']);

        $product = Product::findOrFail($id);

        $saved = false;
        $saved = DB::transaction(function() use ($product, $params){
            $product->update($params);
            $product->categories()->sync($params['category_ids']);

            return true;
        });

        if($saved){
            $request->session()->flash('success', 'Product has been saved');
        } else {
            $request->session()->flash('error', 'Product could not be saved');
        }

        return redirect('admin/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if($product->delete()){
            $request->session()->flash('success', 'Product has been deleted');
        }
        return redirect('admin/products');
    }

    // ============ mengatasi bagian upload gambar ============
    
    public function images($id)
    {
        if (empty($id)){
            return redirect('admin/products/create');
        }
        
        $product = Product::findOrFail($id);
        
        $this->data['productID'] = $product->id;
        $this->data['productImages'] = $product->productImages;
        
        return view('admin.products.images', $this->data);
    }
    
    public function add_image($id)
    {   
        if (empty($id)){
            return redirect('admin/products');
        }
        
        $product = Product::findOrFail($id);
        
        $this->data['productID'] = $product->id;
        $this->data['product'] = $product;
        
        return view('admin.products.images_form', $this->data);
    }

    public function upload_image(ProductImageRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        if($request->has('image')){
            $image = $request->file('image');
            $name = $product->slug.'_'.time();
            $filename = $name. '.' .$image->getClientOriginalExtension();

            $folder = '/uploads/images';
            $filePath = $image->storeAs($folder, $filename, 'public');

            $params = [
                'product_id' => $product->id,
                'path' => $filePath
            ];

            if(ProductImage::create($params)){
                $request->session()->flash('success', 'Image has been uploaded');
            } else {
                $request->session()->flash('error', 'Image could not be uploaded');
            }

            return redirect('admin/products/' . $id . '/images');
        }
    }

    public function remove_image(Request $request, $id)
    {
        $image = ProductImage::findOrFail($id);

        // Menghapus gambar dari folder penyimpanan
        Storage::disk('public')->delete($image->path);

        if ($image->delete()) {
            $request->session()->flash('success', 'Product has been deleted');
        }

        return redirect('admin/products/'.$image->product->id.'/images');
    }
}
