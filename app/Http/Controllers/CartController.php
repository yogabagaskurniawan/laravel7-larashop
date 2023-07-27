<?php

namespace App\Http\Controllers;

// use Darryldecode\Cart\Cart;

use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Cart::getContent();
        return view('theme.marcus.carts.index', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->except('_token');
        $product = Product::findOrFail($params['product_id']);
        $slug = $product->slug;

        $attributes = [];
        // dd($product->id);
        if ($product->configurable()){
            $product = Product::from('products as p')
							->whereRaw("p.parent_id = :parent_product_id
							and (select pav.text_value 
									from product_attribute_values pav
									join attributes a on a.id = pav.attribute_id
									where a.code = :size_code
									and pav.product_id = p.id
									limit 1
								) = :size_value
							and (select pav.text_value 
									from product_attribute_values pav
									join attributes a on a.id = pav.attribute_id
									where a.code = :color_code
									and pav.product_id = p.id
									limit 1
								) = :color_value
								", [
									'parent_product_id' => $product->id,
									'size_code' => 'size',
									'size_value' => $params['size'],
									'color_code' => 'color',
									'color_value' => $params['color'],
								])->firstOrFail();
            // dd($product->id);
			$attributes['size'] = $params['size'];
			$attributes['color'] = $params['color'];
        }

        $item = [
            'id' => md5($product->id),
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $params['qty'],
            'attributes' => $attributes,
            'associatedModel' => $product,
        ];

        \Cart::add($item);

        \Session::flash('success', 'Product '.$item['name'].'has been added to cart');
        return redirect('product/' .$slug);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $params = $request->except('_token');
        if($items = $request['items']){
            foreach ($items as $cartID => $item) {
                \Cart::update($cartID, [
                    'quantity' => [
                        'relative' => false,
                        'value' => $item['quantity']
                    ]
                ]);
            }

            \Session::flash('success', 'The card has been updated');
            return redirect('carts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Cart::remove($id);

        return redirect('/carts');
    }
}
