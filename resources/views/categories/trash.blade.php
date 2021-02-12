@extends('layouts.global')

@section('title')
    Trashed category
@endsection

@section('content')
<div class="row">
  <div class="col-md-6">
    <form action="{{route('categories.index')}}">
      <div class="input-group">
        <input type="text" class="form-control" name="name" placeholder="Filter by category name">
        <div class="input-group-append">
          <input type="submit" value="Filter" class="btn btn-primary">
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-6">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a href="{{route('categories.index')}}" class="nav-link">Published</a>
      </li>
      <li class="nav-item">
        <a href="{{route('categories.trash')}}" class="nav-link active">Trash</a>
      </li>
    </ul>
  </div>
</div>

<hr class="my-3">

 @if (session('status'))
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-success">
        {{session('status')}}
      </div>
    </div>
  </div>
@endif

<div class="row">
  <div class="col-md-12">
    <table class="table table-bordered table-stripped">
      <thead>
        <tr>
          <th><b>Name</b></th>
          <th><b>Slug</b></th>
          <th><b>Image</b></th>
          <th><b>Actions</b></th>  
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
            <tr>
              <td>{{$category->name}}</td>
              <td>{{$category->slug}}</td>
              <td>
                @if ($category->image)
                  <img src="{{asset('storage/'.$category->image)}}" widty="48px">
                @else
                  No image
                @endif
              </td>
              <td>
                <a href="{{route('categories.restore', [$category->id])}}" class="btn btn-success">Restore</a>
                <form action="{{route('categories.delete-permanent', [$category->id])}}" method="post" class="d-inline" onsubmit="return confirm('Delete this category permanently?')">
                  @csrf
                  <input type="hidden" name="_method" value="DELETE">
                  <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                </form>
              </td>
            </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="10">
            {{$categories->appends(Request::all())->links()}}
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
</div> 
@endsection