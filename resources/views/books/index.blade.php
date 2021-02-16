@extends('layouts.global')

@section('title')
    Books list
@endsection

@section('content')
    <div class="row">
      <div class="col-md-12">
        <table class="table table-bordered table-stripped">
          <thead>
            <tr>
              <th><b>Cover</b></th>
              <th><b>Title</b></th>
              <th><b>Author</b></th>
              <th><b>Status</b></th>
              <th><b>Categories</b></th>
              <th><b>Stock</b></th>
              <th><b>Price</b></th>
              <th><b>Action</b></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($books as $book)
                <tr>
                  <td>
                    @if ($book->cover)
                        <img src="{{ asset('storage/'.$book->cover) }}" width="96px">
                    @endif
                  </td>
                  <td>{{ $book->title }}</td>
                  <td>{{ $book->author }}</td>
                  <td>
                    @if ($book->status == "DRAFT")
                        
                    @else
                        
                    @endif
                  </td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
@endsection