@extends('layouts.global')

@section('title')
    Edit category
@endsection

@section('content')
    <div class="col-md-8">

      @if (session('status'))
        <div class="alert alert-success">
          {{session('status')}}
        </div>
      @endif

      <form action="{{route('categories.update', [$category->id])}}" method="post" enctype="multipart/form-data" class="bg-white shadow-sm p-3">
        @csrf

        <input type="hidden" name="_method" value="PUT">

        <label for="name">Category name</label>
        <br>
        <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') ? old('name') : $category->name }}">
        <div class="invalid-feedback">
          {{ $errors->first('name') }}
        </div>
        <br><br>

        <label for="slug">Category slug</label>
        <br>
        <input type="text" class="form-control {{ $errors->first('slug') ? 'is-invalid' : '' }}" name="slug" value="{{ old('slug') ? old('slug') : $category->slug }}">
        <div class="invalid-feedback">
          {{ $errors->first('slug') }}
        </div>
        <br><br>

        @if ($category->image)
          <span>Current image</span><br>
          <img src="{{asset('store/'.$category->image)}}" width="120px">
        @endif  

        <input type="file" class="form-control {{ $errors->first('image') ? 'is-invalid' : '' }}" name="image">
        <small class="text-muted">kosongkan jika tidak ingin mengubah gambar</small>
        <div class="invalid-feedback">
          {{ $errors->first('image') }}
        </div>
        <br><br>

        <input type="submit" class="btn btn-primary" value="Update">
      </form>
    </div> 
@endsection