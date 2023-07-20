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
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\ProductAttributeValue;
use App\Models\ProductInventory;
use PhpParser\Node\AttributeGroup;

class ProductController extends Controller
{
    protected $data;

    public function __construct()
    {
        $this->data = [];
        $this->data['statuses'] = Product::statuses();
        $this->data['types'] = Product::types();
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
        $configurableAttributes = $this->getConfigurableAttributes();
        $product = null;
        $productID = 0;
        $categoryIDs = [];
        return view('admin.products.form', $this->data ,compact('categories','product', 'categoryIDs', 'productID', 'configurableAttributes'));
    }

    // menangkap input dari tambah prodact dibagian configurable yang attribute
    private function getConfigurableAttributes()
    {
        return Attribute::where('is_configurable', true)->get();
    }

    private function generateAttributeCombinations($arrays)
    {
        $result = [[]];
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property=>$property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }

    private function convertVariantAsName($variant)
    {
        $variantName = '';
        foreach (array_keys($variant) as $key => $code) {
            $attributeOptionID = $variant[$code];
            $attributeOption = AttributeOption::find($attributeOptionID);
            if($attributeOption){
                $variantName .='-'.$attributeOption->name;
            }
        }
        return $variantName;
    }

    public function generateProductVariants($product, $params)
    {
        $configurableAttributes = $this->getConfigurableAttributes();
        $variantAttributes = [];
        foreach ($configurableAttributes as $attribute) {
            $variantAttributes[$attribute->code] = $params[$attribute->code];
        }

        // dd($variantAttributes);
        $variants = $this->generateAttributeCombinations($variantAttributes);
        // dd($variants);

        if ($variants) {
            foreach ($variants as $variant) {
                $variantParams = [
                    'parent_id' => $product->id,
                    'user_id' => Auth::user()->id,
                    'sku' => $product->sku . '-' . implode('-', array_values($variant)),
                    'type' => 'simple',
                    'name' => $product->name . $this->convertVariantAsName($variant),
                ];
                // dd($variantParams);

                $variantParams['slug'] = Str::slug($variantParams['name']);

                $newProductVariant = Product::create($variantParams);

                $categoryIds = !empty($params['category_ids']) ? $params['category_ids'] : [];
                $newProductVariant->categories()->sync($categoryIds);

                $this->saveProductAttributeValues($newProductVariant, $variant);
            }
        }
    }

    private function saveProductAttributeValues($product, $variant)
    {
        foreach (array_values($variant) as $attributeOptionID) {
            $attributeOption = AttributeOption::find($attributeOptionID);
            $attributeValueParams = [
                'product_id' => $product->id,
                'attribute_id' => $attributeOption->attribute_id,
                'text_value' => $attributeOption->name,
            ];

            ProductAttributeValue::create($attributeValueParams);
        }
    }
    // end
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

        $product = DB::transaction(function () use ($params) {
            $categoryIds = !empty($params['category_ids']) ? $params['category_ids'] : [];
            $product = Product::create($params);
            // $product->categories()->sync($params['category_ids']);
            $product->categories()->sync($categoryIds);


            if($params['type'] == 'configurable'){
                $this->generateProductVariants($product, $params);
            }

            return $product;
        });

        if($product){
            $request->session()->flash('success', 'Product has been saved');
        } else {
            $request->session()->flash('error', 'Product could not be saved');
        }

        return redirect('admin/products/'.$product->id.'/edit');
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

        // dd($this->data);
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
        // $params['status'] = isset($params['status']) ? intval($params['status']) : 0;

        $product = Product::findOrFail($id);

        $saved = false;
        $saved = DB::transaction(function() use ($product, $params) {
            $categoryIds = !empty($params['category_ids']) ? $params['category_ids'] : [];
            $product->update($params);
            $product->categories()->sync($categoryIds);

            if ($product->type == 'configurable') {
                $this->updateProductVariants($params);
            } else {
                ProductInventory::updateOrCreate(['product_id' => $product->id], ['qty' => $params['qty']]);
            }

            return true;
        });

        if ($saved) {
            // Session::flash('success', 'Product has been saved');
            $request->session()->flash('success', 'Product has been saved');
        } else {
            // Session::flash('error', 'Product could not be saved');
            $request->session()->flash('error', 'Product could not be saved');
        }

        return redirect('admin/products');
    }

    public function updateProductVariants($params)
    {
        if ($params['variants']) {
            foreach ($params['variants'] as $productParams) {
                $product = Product::find($productParams['id']);
                $product->update($productParams);

                $product->status = $params['status'];
                $product->save();

                ProductInventory::updateOrCreate(['product_id' => $product->id], ['qty' => $productParams['qty']]);
            }
        }
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

        // Cek apakah produk memiliki produk anak terkait
        if ($product->variants()->exists()) {
            return redirect()->back()->withErrors(['error' => 'Cannot delete product with associated child products.']);
        }

        if ($product->delete()) {
            return redirect()->back()->with('success', 'Product has been deleted');
        } else {
            return redirect()->back()->withErrors(['error' => 'Failed to delete product.']);
        }
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
