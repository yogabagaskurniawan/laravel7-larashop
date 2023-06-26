@extends('admin.layout.main')

@section('content')
    
@php
    use Illuminate\Support\Facades\Form;
    use Illuminate\Support\HtmlString;

    $formTitle = !empty($attribute) ? 'Update' : 'New';
    $disableInput = !empty($attribute) ? true : false;
@endphp

{{-- <div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                        <h2>{{ $formTitle }} Attribute</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    @if (!empty($attribute))
                        {!! Form::model($attribute, ['url' => ['admin/attributes', $attribute->id], 'method' => 'PUT']) !!}
                        {!! Form::hidden('id') !!}
                    @else
                        {!! Form::open(['url' => 'admin/attributes']) !!}
                    @endif
                        <fieldset class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <legend class="col-form-label pt-0">General</legend>
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" name="code" class="form-control" value="{{ old('code') }}" {{ $disableInput ? 'readonly' : '' }}>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" class="form-control" {{ $disableInput ? 'readonly' : '' }}>
                                            <option value="">-- Set Type --</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    
                        <fieldset class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <legend class="col-form-label pt-0">Validation</legend>
                                    <div class="form-group">
                                            {!! Form::label('is_required', 'Is Required?') !!}
                                            {!! Form::select('is_required', $booleanOptions , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                    </div>
                                    <div class="form-group">
                                            {!! Form::label('is_unique', 'Is Unique?') !!}
                                            {!! Form::select('is_unique', $booleanOptions , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                    </div>
                                    <div class="form-group">
                                            {!! Form::label('validation', 'Validation') !!}
                                            {!! Form::select('validation', $validations , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <legend class="col-form-label pt-0">Configuration</legend>
                                        <div class="form-group">
                                                {!! Form::label('is_configurable', 'Use in Configurable Product?') !!}
                                                {!! Form::select('is_configurable', $booleanOptions , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                        </div>
                                        <div class="form-group">
                                                {!! Form::label('is_filterable', 'Use in Filtering Product?') !!}
                                                {!! Form::select('is_filterable', $booleanOptions , null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        <div class="form-footer pt-5 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Save</button>
                            <a href="{{ url('admin/attributes') }}" class="btn btn-secondary btn-default">Back</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>  
        </div>
    </div>
</div> --}}

<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{ $formTitle }} Attribute</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    @if (!empty($attribute))
                    <form method="POST" action="{{ url('admin/attributes', $attribute->id) }}">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id" value="{{ $attribute->id }}">
                    @else
                        <form method="POST" action="{{ url('admin/attributes') }}">
                            @csrf
                    @endif
                        <fieldset class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <legend class="col-form-label pt-0">General</legend>
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" name="code" class="form-control" value="{{ old('code', $attribute->code ?? '') }}" {{ $disableInput ? 'readonly' : '' }}>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', $attribute->name ?? '') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" class="form-control" {{ $disableInput ? 'disabled' : '' }}>
                                            <option value="">-- Set Type --</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type }}" {{ (old('type', isset($attribute) ? $attribute->type : '') == $type) ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <select name="type" class="form-control" {{ $disableInput ? 'disabled' : '' }} required>
                                            <option value="">-- Set Type --</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type }}" {{ (old('type', isset($attribute) ? $attribute->type : '') == $type) ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select> --}}
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    
                        <fieldset class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <legend class="col-form-label pt-0">Validation</legend>
                                    {{-- <div class="form-group">
                                        <label for="is_required">Is Required?</label>
                                        <select name="is_required" class="form-control" placeholder="">
                                            @foreach ($booleanOptions as $value => $label)
                                                <option value="{{ $value }}" {{ (old('is_required', $attribute->is_required) == $value) ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                    <div class="form-group">
                                        <label for="is_required">Is Required?</label>
                                        <select name="is_required" class="form-control" placeholder="">
                                            <option value="">-- Select Option --</option>
                                            @foreach ($booleanOptions as $value => $label)
                                                <option value="{{ $value }}" {{ (old('is_required', $attribute ? $attribute->is_filterable : null) === $value) ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="is_unique">Is Unique?</label>
                                        {{-- <select name="is_unique" class="form-control" placeholder="">
                                            <option value="">-- Select Option --</option>
                                            @foreach ($booleanOptions as $value => $label)
                                                <option value="{{ $value }}" {{ (old('is_unique',  $attribute ? $attribute->is_unique : null) == $value) ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select> --}}
                                        <select name="is_unique" class="form-control" placeholder="">
                                            <option value="">-- Select Option --</option>
                                            @foreach ($booleanOptions as $value => $label)
                                                <option value="{{ $value }}" {{ (old('is_unique', $attribute ? $attribute->is_filterable : null) === $value) ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="validation">Validation</label>
                                        <select name="validation" class="form-control" placeholder="">
                                            <option value="">-- Select Option --</option>
                                            @foreach ($validations as $value => $label)
                                                <option value="{{ $value }}" {{ (old('validation',  $attribute ? $attribute->validation : null) === $value )? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    
                        <fieldset class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <legend class="col-form-label pt-0">Configuration</legend>
                                    <div class="form-group">
                                        <label for="is_configurable">Use in Configurable Product?</label>
                                        <select name="is_configurable" class="form-control" placeholder="">
                                            <option value="">-- Select Option --</option>
                                            @foreach ($booleanOptions as $value => $label)
                                                <option value="{{ $value }}" {{ (old('is_configurable', $attribute ? $attribute->is_configurable : null) === $value )? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="is_filterable">Use in Filtering Product?</label>
                                        <select name="is_filterable" class="form-control" placeholder="">
                                            <option value="">-- Select Option --</option>
                                            @foreach ($booleanOptions as $value => $label)
                                                <option value="{{ $value }}" {{ (old('is_filterable', $attribute ? $attribute->is_filterable : null) === $value) ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    
                        <div class="form-footer pt-5 border-top">
                            <button type="submit" class="btn btn-primary btn-default">Save</button>
                            <a href="{{ url('admin/attributes') }}" class="btn btn-secondary btn-default">Back</a>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection