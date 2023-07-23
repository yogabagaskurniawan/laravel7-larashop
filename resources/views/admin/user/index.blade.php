@extends('admin.layout.main')

@section('content')
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-default">
        <div class="card-header card-header-border-bottom">
          <h2>Users</h2>
        </div>
        <div class="card-body">
          @include('admin.partials.flash')
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @php
                  $no = 1
              @endphp
              @foreach ($users as $user)
              <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->status }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    @if (auth()->user()->status=='admin')
                    <a href="{{ url('admin/users/' . $user->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ url('admin/users/delete/' . $user->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah yakin untuk dihapus?')">Delete</a>
                    @endif
                  </td>
              </tr>
              @endforeach
              
              @if ($users->isEmpty())
                  <tr>
                      <td colspan="4">No records found</td>
                      <td></td>
                  </tr>
              @endif
            </tbody>
          </table>
        </div>
        <div class="card-footer text-right"> 
          @if (auth()->user()->status=='admin')
            <a href="{{ url('admin/users/create') }}" class="btn btn-primary">Add new</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection