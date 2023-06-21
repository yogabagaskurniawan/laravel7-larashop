@extends('admin.layout.main')

@section('content')

@php
  use Illuminate\Support\Facades\Form;
  $formTitle = !empty($category) ? 'Update' : 'New'
@endphp

<div class="row">
  <div class="col-lg-8">
    <div class="card card-default">
      <div class="card-header card-header-border-bottom">
        <h2>{{ $formTitle }} Category</h2>
      </div>
      <div class="card-body">
        @include('admin.partials.flash', ['$errors' => $errors])
        @if (!empty($category))
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{ $category->id }}">
        @else
            <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
        @endif
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="category name" value="{{ $category->name ?? '' }}">
        </div>
        <div class="form-group">
            <label for="parent_id">Parent</label>
            {!! General::selectMultiLevel('parent_id', $categories, ['class' => 'form-control', 'selected' => (!empty(old('parent_id')) ? old('parent_id') : (!empty($category['parent_id']) ? $category['parent_id'] : '')), 'placeholder' => '-- Choose Category --']) !!}
        </div>
        <div class="form-footer pt-5 border-top">
            <button type="submit" class="btn btn-primary btn-default">Save</button>
            <a href="{{ url('admin/categories') }}" class="btn btn-secondary">back</a>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection