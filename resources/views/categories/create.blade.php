@extends('layouts.global')

@section('title')
    Create Category
@endsection

@section('content')
  <div class="col-md-8">

    @if (session('status'))
      <div class="alert alert-success">
        {{session('status')}}
      </div>
    @endif

    <form action="{{route('categories.store')}}" method="post" class="bg white shadow-sm p-3" enctype="multipart/form-data">
      @csrf

      <label for="name">Category name</label>
      <input type="text" name="name" id="name" class="form-control">

      <br>

      <label for="image">Category name</label>
      <input type="file" name="image" id="image" class="form-control">

      <br>

      <input type="submit" class="btn btn-primary" value="Save">
    </form>
  </div>
@endsection