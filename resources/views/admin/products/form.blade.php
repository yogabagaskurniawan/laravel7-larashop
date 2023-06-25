{{-- @extends('admin.layout.main')

@section('content')
    
@php
    $formTitle = !empty($category) ? 'Update' : 'New'    
@endphp

<div class="content">
    <div class="row">
        <div class="col-lg-8">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                        <h2>{{ $formTitle }} Product</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    @if (!empty($product))
                        {!! Form::model($product, ['url' => ['admin/products', $product->id], 'method' => 'PUT']) !!}
                        {!! Form::hidden('id') !!}
                    @else
                        {!! Form::open(['url' => 'admin/products']) !!}
                    @endif
                        <div class="form-group">
                            {!! Form::label('sku', 'SKU') !!}
                            {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'sku']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('name', 'Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Price') !!}
                            {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'price']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('category_ids', 'Category') !!}
                            {!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'form-control', 'multiple' => true, 'selected' => !empty(old('category_ids')) ? old('category_ids') : $categoryIDs, 'placeholder' => '-- Choose Category --']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('short_description', 'Short Description') !!}
                            {!! Form::textarea('short_description', null, ['class' => 'form-control', 'placeholder' => 'short description']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'description']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('weight', 'Weight') !!}
                            {!! Form::text('weight', null, ['class' => 'form-control', 'placeholder' => 'weight']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('length', 'Length') !!}
                            {!! Form::text('length', null, ['class' => 'form-control', 'placeholder' => 'length']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('width', 'Width') !!}
                            {!! Form::text('width', null, ['class' => 'form-control', 'placeholder' => 'width']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('height', 'Height') !!}
                            {!! Form::text('height', null, ['class' => 'form-control', 'placeholder' => 'height']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Status') !!}
                            {!! Form::select('status', $statuses , null, ['class' => 'form-control', 'placeholder' => '-- Set Status --']) !!}
                        </div>
                        <div class="form-footer pt-5 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Save</button>
                            <a href="{{ url('admin/products') }}" class="btn btn-secondary btn-default">Back</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>  
        </div>
    </div>
</div>
@endsection --}}

@extends('admin.layout.main')

@section('content')
    
@php
    $formTitle = !empty($product) ? 'Update' : 'New';   
@endphp

<div class="content">
    <div class="row">
        <div class="col-lg-8">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{ $formTitle }} Product</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    @if (!empty($product))
                        <form action="{{ url('admin/products/'.$product->id) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                    @else
                        <form action="{{ url('admin/products') }}" method="POST">
                            @csrf
                    @endif
                        <div class="form-group">
                            <label for="sku">SKU</label>
                            <input type="text" name="sku" class="form-control" placeholder="sku" value="{{ $product->sku ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="name" value="{{ $product->name ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control" placeholder="price" value="{{ $product->price ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="category_ids">Category</label>
                            {!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'form-control', 'multiple' => true, 'selected' => !empty(old('category_ids')) ? old('category_ids') : $categoryIDs, 'placeholder' => '-- Choose Category --']) !!}
                        </div>
                        <div class="form-group">
                            <label for="short_description">Short Description</label>
                            <textarea name="short_description" class="form-control" placeholder="short description">{{ $product->short_description ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" placeholder="description">{{ $product->description ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="weight">Weight</label>
                            <input type="text" name="weight" class="form-control" placeholder="weight" value="{{ $product->weight ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="length">Length</label>
                            <input type="text" name="length" class="form-control" placeholder="length" value="{{ $product->length ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="width">Width</label>
                            <input type="text" name="width" class="form-control" placeholder="width" value="{{ $product->width ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="height">Height</label>
                            <input type="text" name="height" class="form-control" placeholder="height" value="{{ $product->height ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" placeholder="-- Set Status --">
                                @foreach($statuses as $key => $status)
                                    <option value="{{ $key }}" {{ (isset($product->status) && $product->status == $key) ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-footer pt-5 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Save</button>
                            <a href="{{ url('admin/products') }}" class="btn btn-secondary btn-default">Back</a>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>
@endsection
