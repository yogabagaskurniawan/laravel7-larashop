@extends('admin.layout.main')

@section('content')
@php
  use Illuminate\Support\Facades\Form;
  $formTitle = !empty($users) ? 'Update' : 'New'
@endphp

<div class="row">
  <div class="col-lg-8">
    <div class="card card-default">
      <div class="card-header card-header-border-bottom">
        <h2>{{ $formTitle }} User</h2>
      </div>
      <div class="card-body">
        @if (!empty($users))
            <form action="{{ route('admin.users.update', $users->id) }}" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{ $users->id }}">
        @else
            <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
        @endif
        @csrf
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" class="form-control  @error('name') has-error @enderror" placeholder="Name" value="{{ $users->name ?? '' }}">
          @error('name')
            <p class="help-block">{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group">
          <label for="name">Status</label>
          <input type="text" name="status" class="form-control  @error('status') has-error @enderror" placeholder="status" value="{{ $users->status ?? '' }}">
          @error('status')
            <p class="help-block">{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group">
          <label for="name">Email</label>
          <input type="email" name="email" class="form-control  @error('email') has-error @enderror" placeholder="Email" value="{{ $users->email ?? '' }}">
          @error('email')
            <p class="help-block">{{ $message }}</p>
          @enderror
        </div>
        <div class="form-group @error('password') has-error @enderror">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Password">
          @error('password')
            <p class="help-block">{{ $message }}</p>
          @enderror
        </div>      
        <div class="form-footer pt-5 border-top">
            <button type="submit" class="btn btn-primary btn-default">Save</button>
            <a href="{{ url('admin/hakaccess') }}" class="btn btn-secondary">back</a>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection