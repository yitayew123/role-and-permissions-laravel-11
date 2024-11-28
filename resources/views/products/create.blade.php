@extends('layouts.app')

@section('content')
<!-- Main container for the "Add New Product" page -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Left-aligned header displaying the page title -->
        <div class="pull-left">
            <h2>Add New Product</h2>
        </div>
        <!-- Right-aligned "Back" button to navigate back to the products list -->
        <div class="pull-right">
            <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

<!-- Display validation error messages if there are any -->
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            <!-- Loop through each error message and display it as a list item -->
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form to add a new product -->
<form action="{{ route('products.store') }}" method="POST">
    @csrf <!-- CSRF token for security -->
    
    <div class="row">
        <!-- Product Name Input -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <!-- Text input for the product name -->
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        
        <!-- Product Detail Textarea -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Detail:</strong>
                <!-- Textarea for the product details -->
                <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>
            </div>
        </div>
        
        <!-- Submit Button -->
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <!-- Submit button to save the product -->
            <button type="submit" class="btn btn-primary btn-sm mb-3 mt-2"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
    </div>
</form>

<!-- Footer or Credits -->
<p class="text-center text-primary"><small>Practice Makes You Perfect</small></p>

@endsection
