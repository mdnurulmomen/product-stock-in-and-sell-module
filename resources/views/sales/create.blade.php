@extends('layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 mt-3">
        <div class="float-left">
            <h2>Add New Product</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('sales.index') }}">< Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('sales.store') }}" method="POST">
    @csrf
  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Product:</strong>
                <div class="form-group">
                    <select name="product_id" class="form-control" placeholder="Product Name" required>
                        <option value="" disabled selected>-- Select Payment Method --</option>
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Stock Quantity:</strong>
                <input type="number" name="quantity" class="form-control" placeholder="Quantity" max="{{ $product->available_quantity }}" required="true">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Method:</strong>
                <div class="form-group">
                    <select name="payment" class="form-control" placeholder="Payment Method" required>
                      <option value="" disabled selected>-- Select Payment Method --</option>
                      <option value="cash">Cash</option>
                      <option value="credit">Credit</option>
                      <option value="mfs">MFS</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
@endsection