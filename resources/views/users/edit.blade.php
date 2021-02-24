@extends('layouts.global')

@section('title')
    Edit User
@endsection

@section('content')
  <div class="col-md-8">
    @if (session('status'))
        <div class="alert alert-success">
          {{session('status')}}
        </div>
    @endif
    <form action="{{route('users.update', [$user->id])}}" method="post" class="bg-white shadow-sm p-3" enctype="multipart/form-data">
      @csrf
      <input type="hidden" value="PUT" name="_method">
      <label for="name">Name</label>
      <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}" name="name" id="name" value="{{old('name') ? old('name') : $user->name}}" placeholder="Full Name">
      <div class="invalid-feedback">
        {{ $errors->first('name') }}
      </div>
      <br>

      <label for="username">Username</label>
      <input type="text" class="form-control" name="username" id="username" value="{{$user->username}}" placeholder="Username">
      <br>

      <label for="status">Status</label>
      <br>
      <input {{$user->status == "ACTIVE" ? "checked" : ""}} type="radio" class="form-control" name="status" id="active" value="ACTIVE">
      <label for="active">Active</label>

      <input {{$user->status == "INACTIVE" ? "checked" : ""}} type="radio" class="form-control" name="status" id="inactive" value="INACTIVE">
      <label for="inactive">Inactive</label>
      <br><br>

      <label for="roles">Roles</label>
      <br>
      <input type="checkbox" name="roles[]" id="ADMIN" value="ADMIN" class="form-control {{$errors->first('roles') ? 'is-invalid' : ''}}" {{in_array("ADMIN", json_decode($user->roles)) ? "checked" : ""}}>
      <label for="ADMIN"> Administrator</label>

      <input type="checkbox" name="roles[]" id="STAFF" value="STAFF" class="form-control {{$errors->first('roles') ? 'is-invalid' : ''}}" {{in_array("STAFF", json_decode($user->roles)) ? "checked" : ""}}>
      <label for="STAFF"> Staff</label>

      <input type="checkbox" name="roles[]" id="CUSTOMER" value="CUSTOMER" class="form-control {{$errors->first('roles') ? 'is-invalid' : ''}}" {{in_array("CUSTOMER", json_decode($user->roles)) ? "checked" : ""}}>
      <label for="CUSTOMER"> Customer</label>
      
      <div class="invalid-feedback">
        {{ $errors->first('roles') }}
      </div>

      <br>

      <br>
      <label for="phone">Phone number</label>
      <br>
      <input type="text" class="form-control {{$errors->first('phone') ? 'is-invalid' : ''}}" name="phone" id="phone" value="{{$user->phone}}">
      <div class="invalid-feedback">
        {{ $errors->first('phone') }}
      </div>
      
      <br>
      <label for="address">Address</label>
      <textarea name="address" id="address" class="form-control {{$errors->first('address') ? 'is-invalid' : ''}}">{{$user->address}}</textarea>
      <div class="invalid-feedback">
        {{ $errors->first('address') }}
      </div>
      <br>

      <label for="avatar">Avatar</label>
      <br>
      Current avatar : <br>
      @if ($user->avatar)
        <img src="{{asset('storage/'.$user->avatar)}}" width="120px">
        <br>
      @else
        No avatar
      @endif  
      <br>
      <input type="file" class="form-control" name="avatar" id="avatar">
      <small class="text-muted">Kosongkan jika tidak ingin mengubah avatar</small>

      <hr class="my-3">

      <label for="email">Email</label>
      <input type="text" class="form-control {{$errors->first('email') ? 'is-invalid' : ''}}" name="email" id="email" value="{{$user->email}}" placeholder="user@mail.com" disabled>
      <div class="invalid-feedback">
        {{ $errors->first('email') }}
      </div>
      <br>

      <input type="submit" class="btn btn-primary" value="Save">
    </form>
  </div>
    
@endsection