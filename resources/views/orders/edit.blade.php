@extends('layouts.global')

@section('title')
    Edit order
@endsection

@section('content')
    <div class="row">
      <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('orders.update', [$order->id]) }}" method="post" class="shadow-sm bg-white p-3">
          @csrf

          <input type="hidden" name="_method" value="PUT">

          <label for="invoice_number">Invoice Number</label><br>
          <input type="text" class="form-control" name="invoice_number" id="invoice_number" value="{{ $order->invoice_number }}" disabled>
          <br>

          <label for="buyer">Buyer</label><br>
          <input type="text" class="form-control" name="buyer" id="buyer" value="{{ $order->user->name }}" disabled>
          <br>

          <label for="created_at">Order date</label><br>
          <input type="text" class="form-control" name="created_at" id="created_at" value="{{ $order->created_at }}" disabled>
          <br>

          <label for="invoice_number">Invoice Number</label><br>
          <input type="text" class="form-control" name="invoice_number" id="invoice_number" value="{{ $order->invoice_number }}" disabled>
          <br>

          <label for="book">Books ({{ $oreder->totalQuantity }})</label><br>
          <ul>
            @foreach ($order->books as $book)
                <li>{{ $book->title }} <b>({{ $book->pivot->quantity }})</b></li>
            @endforeach
          </ul>

          <label for="total_price">Total price</label><br>
          <input type="text" class="form-control" name="total_price" id="total_price" value="{{ $order->total_price }}" disabled>
          <br>

          <label for="status">Status</label><br>
          <select name="status" id="status" class="form-control">
            <option value="SUBMIT" {{ $order->status == "SUBMIT" ? "selected" : "" }}>SUBMIT</option>
            <option value="PROCESS" {{ $order->status == "PROCESS" ? "selected" : "" }}>PROCESS</option>
            <option value="PROCESS" {{ $order->status == "PROCESS" ? "selected" : "" }}>PROCESS</option>
            <option value="FINISH" {{ $order->status == "FINISH" ? "selected" : "" }}>FINISH</option>
            <option value="CANCEL" {{ $order->status == "CANCEL" ? "selected" : "" }}>CANCEL</option>
          </select>
          
          <input type="submit" value="Update" class="btn btn-primary">
        </form>
      </div>
    </div>  
@endsection