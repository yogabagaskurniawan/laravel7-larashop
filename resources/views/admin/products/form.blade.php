@extends('admin.layout.main')

@section('content')
    
@php
    $formTitle = !empty($product) ? 'Update' : 'New'    
@endphp

<div class="row">
    <div class="col-lg-3">
        @include('admin.products.layouts_menus.product_menus')
    </div>
    <div class="col-lg-9">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                    <h2>{{ $formTitle }} Product</h2>
            </div>
            <div class="card-body">
                @include('admin.partials.flash', ['$errors' => $errors])
                @if (!empty($product))
                    <form method="POST" action="{{ url('admin/products/' . $product->id) }}">
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <!-- tambahkan input hidden untuk menyimpan ID -->
                        <input type="hidden" name="type" value="{{ $product->type }}">
                @else
                    <form method="POST" action="{{ url('admin/products') }}">
                @endif
                    @csrf
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" class="form-control product-type">
                            <option value="">-- Choose Product Type --</option>
                            @foreach ($types as $type => $label)
                                <option value="{{ $type }}" {{ !empty($product) && $product->type == $type ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>                        
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input type="text" name="sku" class="form-control" placeholder="sku" value="{{ !empty($product) ? $product->sku : '' }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="name" value="{{ !empty($product) ? $product->name : '' }}">
                    </div>
                    {{-- <div class="form-group">
                        <label for="category_ids">Category</label>
                        <select name="category_ids[]" class="form-control" multiple>
                            <option value="">-- Choose Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}" {{ in_array($category['id'], !empty(old('category_ids')) ? old('category_ids') : $categoryIDs) ? 'selected' : '' }}>
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="category_ids">Category</label>
                        <select name="category_ids[]" class="form-control" multiple>
                            <option value="">-- Choose Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category['id'] }}" {{ in_array($category['id'], (is_array(old('category_ids')) ? old('category_ids') : $categoryIDs)) ? 'selected' : '' }}>
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>                    
                    {{-- <div class="configurable-attributes">
                        @if (!empty($configurableAttributes) && empty($product))
                            <p class="text-primary mt-4">Configurable Attributes</p>
                            <hr/>
                            @foreach ($configurableAttributes as $attribute)
                                <div class="form-group">
                                    <label for="{{ $attribute->code }}">{{ $attribute->name }}</label>
                                    <select name="{{ $attribute->code }}[]" class="form-control" multiple>
                                        @foreach ($attribute->attributeOptions as $option)
                                            <option value="{{ $option->id }}">{{ $option->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        @endif
                    </div> --}}
                    <div class="configurable-attributes">
                        @if (!empty($configurableAttributes) && empty($product))
                            <p class="text-primary mt-4">Configurable Attributes</p>
                            <hr/>
                            @foreach ($configurableAttributes as $attribute)
                                <div class="form-group">
                                    <label for="{{ $attribute->code }}">{{ $attribute->name }}</label>
                                    @foreach ($attribute->attributeOptions as $option)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="{{ $attribute->code }}[]" value="{{ $option->id }}" id="{{ $attribute->code }}_{{ $option->id }}">
                                            <label class="form-check-label" for="{{ $attribute->code }}_{{ $option->id }}">
                                                {{ $option->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    </div>                        
            
                    @if ($product)
                        @if ($product->type == 'configurable')
                            @include('admin.products.configurable')
                        @else
                            @include('admin.products.simple')                            
                        @endif
            
                        <div class="form-group">
                            <label for="short_description">Short Description</label>
                            <textarea name="short_description" class="form-control" placeholder="short description">{{ !empty($product) ? $product->short_description : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" placeholder="description">{{ !empty($product) ? $product->description : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" placeholder="-- Set Status --">
                                <option value="">-- Set Status --</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ !empty($product) && $product->status == $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-footer pt-5 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Save</button>
                        <a href="{{ url('admin/products') }}" class="btn btn-secondary btn-default">Back</a>
                    </div>
                </form>
            </div>
            
        </div>  
    </div>
</div>
@endsection