@php
    $data = !empty($data) ? 'Update' : 'Add';
@endphp

<div class="card card-default">
    <div class="card-header card-header-border-bottom">
        <h2>{{ $data }} Option</h2>
    </div>
    <div class="card-body">
        @include('admin.partials.flash', ['$errors' => $errors])
        @if (!empty($attributeOption))
            <form method="POST" action="{{ url('admin/attributes/options', $attributeOption->id) }}">
                @method('PUT')
                <input type="hidden" name="id">
        @else
            <form method="POST" action="{{ url('admin/attributes/options', $attribute->id) }}" enctype="multipart/form-data">
        @endif
        @csrf
        <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $attributeOption->name ?? '' }}">
        </div>
        <div class="form-footer pt-5 border-top">
            <button type="submit" class="btn btn-primary btn-default">Save</button>
            <a href="{{ url('admin/attributes/') }}" class="btn btn-secondary btn-default">Back</a>
        </div>
        </form>
    </div>
    
</div> 