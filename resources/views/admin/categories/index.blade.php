@extends('admin.layout.main')

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Categories</h2>
        </div>
        <div class="card-body">
          @include('admin.partials.flash')
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Parent</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $no = 1
              @endphp
              @foreach ($categories as $category)
              <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $category->name }}</td>
                  <td>{{ $category->slug }}</td>
                  <td>{{ $category->parent_id }}</td>
                  <td>
                    <a href="categories/{{ $category->id }}/edit" class="btn btn-warning btn-sm">Edit</a>
                    <a href="categories/delete/{{ $category->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin untuk dihapus?')">Delete</a></td>
                  </td>
              </tr>
              @endforeach
              
              @if ($categories->isEmpty())
                  <tr>
                      <td colspan="4">No records found</td>
                      <td></td>
                  </tr>
              @endif
            </tbody>
          </table>
          {{ $categories->links() }}
        </div>
        <div class="card-footer text-right"> 
          <a href="categories/create" class="btn btn-primary">Add new</a>
        </div>
      </div>
    </div>
  </div>
@endsection