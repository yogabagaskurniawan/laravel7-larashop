<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeOptionRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Http\Requests\AttributeRequest;
use App\Models\AttributeOption;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = Attribute::orderBy('name', 'asc')->paginate(10);
        return view('admin.attributes.index', ['attributes' => $attributes]);
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attribute = null;
        $types = Attribute::types();
        $booleanOptions = Attribute::booleanOptions();
        $validations = Attribute::validations();

        return view('admin.attributes.form', compact('attribute', 'types', 'booleanOptions', 'validations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $params = $request->except('_token');
        $params['is_required'] = (bool) $params['is_required'];
        $params['is_unique'] = (bool) $params['is_unique'];
        $params['is_configurable'] = (bool) $params['is_configurable'];
        $params['is_filterable'] = (bool) $params['is_filterable'];

        if(Attribute::create($params)){
            $request->session()->flash('success', 'Attribute has been saved');
        }

        return redirect('admin/attributes');
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
        $attribute = Attribute::findOrFail($id);
        $types = Attribute::types();
        $booleanOptions = Attribute::booleanOptions();
        $validations = Attribute::validations();
        return view('admin.attributes.form', compact('attribute','types', 'booleanOptions', 'validations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, $id)
    {
        $params = $request->except('_token');
        $params['is_required'] = (bool) $params['is_required'];
        $params['is_unique'] = (bool) $params['is_unique'];
        $params['is_configurable'] = (bool) $params['is_configurable'];
        $params['is_filterable'] = (bool) $params['is_filterable'];

        unset($params['code']);
        unset($params['type']);

        $attribute = Attribute::findOrFail($id);

        if($attribute->update($params)){
            $request->session()->flash('success', 'Attribute has been saved');
        }

        return redirect('admin/attributes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $attribute = Attribute::findOrFail($id);
        if($attribute->delete()){
            $request->session()->flash('success', 'Attribute has been deleted');
        }
        return redirect('admin/attributes');
    }

    // ============= Mengatasi jika user mengatasi mengeklik tombol option ==============

    public function options($attributeID)
    {
        if(empty($attributeID)) {
            return redirect('admin/attributes');
        }

        $attribute = Attribute::findOrFail($attributeID);
        $data = null;

        return view('admin.attributes.options', compact('attribute', 'data'));
    }

    public function store_option(AttributeOptionRequest $request, $attributeID)
    {
        if(empty($attributeID)){
            return redirect('admin/attributes');
        }

        $params = [
            'attribute_id' => $attributeID,
            'name' => $request->get('name'),
        ];

        if(AttributeOption::create($params)){
            $request->session()->flash('success', 'Option has been saved');
        }

        return redirect('admin/attributes/'.$attributeID.'/options');
    }

    public function edit_option($optionID)
    {
        $attributeOption = AttributeOption::findOrFail($optionID);
        // mengambil data dari model attribute
        $attribute = $attributeOption->attribute;
        $data = 1;

        return view('admin.attributes.options', compact('attributeOption', 'attribute', 'data'));
    }

    public function update_option(AttributeOptionRequest $request, $optionID)
    {
        $option = AttributeOption::findOrFail($optionID);
        $params = $request->except('_token');

        if($option->update($params)){
            $request->session()->flash('success', 'Option has been updated');
        }

        return redirect('admin/attributes/'.$option->attribute->id.'/options');
    }

    public function remove_option(Request $request, $optionID)
    {
        if(empty($optionID)){
            return redirect('admin/attributes');
        }

        $option = AttributeOption::findOrFail($optionID);

        if($option->delete()){
            $request->session()->flash('success', 'Option has been deleted');
        }

        return redirect('admin/attributes/'.$option->attribute->id.'/options');
    }
}
