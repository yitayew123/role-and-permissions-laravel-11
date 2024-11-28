@extends('layouts.app')

@section('content')
<!-- Main container for the "Show Product" page -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Left-aligned header displaying the page title -->
        <div class="pull-left">
            <h2>Show Product</h2>
        </div>
        <!-- Right-aligned "Back" button to navigate back to the product list -->
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
        </div>
    </div>
</div>

<!-- Display the product details in two columns -->
<div class="row">
    <!-- Product name section -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong> <!-- Label for the product name -->
            {{ $product->name }} <!-- Display the name of the product -->
        </div>
    </div>

    <!-- Product details section -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Details:</strong> <!-- Label for the product details -->
            {{ $product->detail }} <!-- Display the detailed description of the product -->
        </div>
    </div>
</div>

<!-- Footer/Credits Section -->
<p class="text-center text-primary"><small>Practice Makes You Perfect</small></p>

@endsection
