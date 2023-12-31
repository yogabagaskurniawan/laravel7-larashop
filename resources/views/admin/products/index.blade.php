@extends('admin.layout.main')

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Products</h2>
        </div>
        <div class="card-body">
          @include('admin.partials.flash')
          <table class="table table-bordered table-stripped">
            <thead>
                <th>#</th>
                <th>SKU</th>
                <th>Type</th>
                <th>Name</th>
                <th>Price</th>
                <th>Status</th>
                <th style="width:15%">Action</th>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>    
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->type }}</td>
                        <td>{{ $product->name }}</td>
                        {{-- <td>{{ $product->price }}</td> --}}
                        <td>{{ number_format($product->price) }}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                            <a href="{{ url('admin/products/'. $product->id .'/edit') }}" class="btn btn-warning btn-sm">edit</a>
                            @if (auth()->user()->status=='admin')
                              <a href="{{ url('admin/products/' . $product->id) }}" class="delete" style="display:inline-block"
                                onclick="event.preventDefault(); if (confirm('Are you sure you want to remove this item?')) { document.getElementById('delete-form-{{ $product->id }}').submit(); }">
                                <button type="button" class="btn btn-danger btn-sm">Remove</button>
                              </a>
                              <form id="delete-form-{{ $product->id }}" action="{{ url('admin/products/' . $product->id) }}" method="POST" style="display: none;">
                                  @method('DELETE')
                                  @csrf
                              </form>  
                            @endif                                                 
                          </td>
                    </tr>
                @endforeach
                @if ($products->isEmpty())
                  <tr>
                      <td colspan="6">No records found</td>
                      <td></td>
                  </tr>
                @endif
            </tbody>
          </table>
          {{ $products->links() }}
        </div>
        <div class="card-footer text-right">
          @if (auth()->user()->status=='admin')
            <a href="{{ url('admin/products/create') }}" class="btn btn-primary">Add New</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection