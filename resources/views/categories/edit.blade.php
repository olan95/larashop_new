@extends('layouts.global')

@section('title')
    Edit category
@endsection

@section('content')
    <div class="col-md-8">

      @if (session('status'))
        <div class="alert alert-success">
          {{session('')}}
        </div>
      @endif

      <form action="{{route('categories.update', [$category->$id])}}" method="post" enctype="multipart/form-data" class="bg-white shadow-sm p-3">
        @csrf

        <input type="hidden" name="_method" value="PUT">

        <label for="name">Category name</label>
        <br>
        <input type="text" class="form-control" name="name" value="{{$category->name}}">
        <br><br>

        <label for="slug">Category slug</label>
        <br>
        <input type="text" class="form-control" name="slug" value="{{$category->slug}}">
        <br><br>

        @if ($category->image)
          <span>Current image</span><br>
          <img src="{{asset('store/'.$category->image)}}" width="120px">
        @endif  

        <input type="file" class="form-control" name="image">
        <small class="text-muted">kosongkan jika tidak ingin mengubah gambar</small>
        <br><br>

        <input type="submit" class="btn btn-primary" value="Update">
      </form>
    </div> 
@endsection