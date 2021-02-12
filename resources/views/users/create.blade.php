@extends('layouts.global')

@section('title')
    Create User
@endsection

@section('content')
  <div class="col-md-8">

  @if (session('status'))
    <div class="alert alert-success">
      {{session('status')}}
    </div>    
  @endif

    <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data" class="bg-white shadow-sm p-3">
      @csrf

      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" placeholder="Full Name" id="name">
      <br>

      <label for="username">Username</label>
      <input type="text" class="form-control" name="username" placeholder="Username" id="username">
      <br>

      <label for="roles">Roles</label>
      <br>
      <input type="checkbox" name="roles[]" id="ADMIN" value="ADMIN">
      <label for="ADMIN">Administrator</label>

      <input type="checkbox" name="roles[]" id="STAFF" value="STAFF">
      <label for="STAFF">Staff</label>

      <input type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER">
      <label for="CUSTOMER">Customer</label>
      <br>

      <br>
      <label for="phone">Phone number</label>
      <br>
      <input type="text" class="form-control" name="phone" placeholder="phone" id="phone">
      <br>

      <label for="address">Address</label>
      <textarea name="address" id="address" class="form-control"></textarea>
      <br>

      <label for="avatar">Avatar image</label>
      <br>
      <input type="file" name="avatar" id="avatar" class="form-control">

      <hr class="my-3">

      <label for="email">Email</label>
      <input type="text" class="form-control" name="email" placeholder="user@email.com" id="email">
      <br>

      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password" id="password">
      <br>

      <label for="password_confirmation">Password Confirmation</label>
      <input type="password" class="form-control" name="password_confirmation" placeholder="Password confirmation" id="password_confirmation">
      <br>

      <input type="submit" value="Save" class="btn btn-primary">
    </form>
  </div>
@endsection