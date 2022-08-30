@extends('layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 mt-3">
            <div class="float-left">
                <h2>Sale List</h2>
            </div>

            <div class="float-right">
                <a class="btn btn-success" href="{{ route('products.index') }}"> Product List > </a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered text-center">
        <tr>
        </tr>

         <thead>
            <tr>
                <th>SL</th>
                <th>Product</th>
                <th colspan="2">Cash</th>
                <th colspan="2">Credit</th>
                <th colspan="2">MFS</th>
                <th colspan="2">Total</th>
            </tr>
            <tr>
              <th></th>
              <th></th>

              <th>Count</th>
              <th>Total Cash</th>
              
              <th>Count</th>
              <th>Total Credit</th>
              
              <th>Count</th>
              <th>Total MFS</th>

              <th>Count</th>
              <th>Total Amount</th>
            </tr>
          </thead>

        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ ucfirst($product->name) }}</td>
            
            <td>{{ $product->sales()->where('payment', 'cash')->count() }}</td>
            <td>{{ $product->sales()->where('payment', 'cash')->sum('price') }}</td>
            
            <td>{{ $product->sales()->where('payment', 'credit')->count() }}</td>
            <td>{{ $product->sales()->where('payment', 'credit')->sum('price') }}</td>
            
            <td>{{ $product->sales()->where('payment', 'mfs')->count() }}</td>
            <td>{{ $product->sales()->where('payment', 'mfs')->sum('price') }}</td>

            <td>{{ $product->sales()->count() }}</td>
            <td>{{ $product->sales()->sum('price') }}</td>
        </tr>
        @endforeach
    </table>
  
    {!! $products->links() !!}
      
@endsection