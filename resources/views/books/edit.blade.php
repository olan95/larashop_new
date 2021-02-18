@extends('layouts.global')

@section('title')
    Edit book
@endsection

@section('content')
    <div class="row">
      <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('books.update', [$book->id]) }}" method="post" enctype="multipart/form-data" class="p-3 shadow-sm bg-white">
          @csrf
          <input type="hidden" name="_method" value="PUT">

          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" id="title" value="{{ $book->title }}" placeholder="Book title">
          <br>

          <label for="cover">Cover</label>
          <small class="text-muted">Current cover</small>
          @if ($book->cover)
            <img src="{{ asset('storage/'.$book->cover) }}" width="96px">
          @endif
          <br><br>
          <input type="file" class="form-control" name="cover">
          <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
          <br><br>

          <label for="slug">Slug</label>
          <input type="text" class="form-control" name="slug" id="slug" value="{{ $book->slug }}" placeholder="Enter-a-slug">
          <br>

          <label for="description">Description</label>
          <textarea class="form-control" name="dexcription" id="dexcription" >{{ $book->title }}</textarea>
          <br>

          <label for="categories">Categories</label>
          <select multiple class="form-control" name="categories[]" id="categories"></select>
          <br><br>

          <label for="stock">Stock</label>
          <input type="text" class="form-control" name="stock" id="stock" value="{{ $book->stock }}" placeholder="Stock">
          <br>

          <label for="author">Author</label>
          <input type="text" class="form-control" name="author" id="author" value="{{ $book->author }}" placeholder="Author">
          <br>

          <label for="publisher">Publisher</label>
          <input type="text" class="form-control" name="publisher" id="publisher" value="{{ $book->publisher }}" placeholder="Publisher">
          <br>

          <label for="price">Price</label>
          <input type="text" class="form-control" name="price" id="price" value="{{ $book->price }}" placeholder="Price">
          <br>

          <label for="status">Status</label>
          <select name="status" id="status" class="form-control">
            <option value="PUBLISH" {{ $book->status == 'PUBLISH' ? 'selected' : '' }}>Publish</option>
            <option value="DRAFT" {{ $book->status == 'DRAFT' ? 'selected' : '' }}>Draft</option>
          </select>
          <br>

          <button class="btn btn-primary" value="PUBLISH">Update</button>
        </form>
      </div>
    </div>
@endsection

@section('footer-scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
      $('#categories').select2({
        ajax: {
          url: 'localhost/larashop/public/ajax/categories/search',
          processResult: function(data){
            return {
              result: data.map(function(item){return {id: item.id, text:item.name}})
            }
          }
        }
      });

      var categories = {!! $book->categories !!}

      categories.forEach(function(category){
        var option = new Option(category.name, category.id, true, true);
        $('#categories').append(option).trigger('change');
      });
    </script>
@endsection