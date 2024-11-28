@extends('layouts.app')

@section('content')
<!-- Main container for the "Edit Product" page -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Left-aligned header displaying the page title -->
        <div class="pull-left">
            <h2>Edit Product</h2>
        </div>
        <!-- Right-aligned "Back" button to navigate back to the products list -->
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('products.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
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

<!-- Form for editing an existing product -->
<form action="{{ route('products.update',$product->id) }}" method="POST">
    @csrf <!-- CSRF token for security -->
    @method('PUT') <!-- This tells the form to use the PUT HTTP method to update the existing product -->

    <div class="row">
        <!-- Product Name Input -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <!-- Pre-filled text input with the current product name -->
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
            </div>
        </div>
        
        <!-- Product Detail Textarea -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Detail:</strong>
                <!-- Pre-filled textarea with the current product details -->
                <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
            </div>
        </div>
        
        <!-- Submit Button -->
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <!-- Submit button to save the updated product -->
            <button type="submit" class="btn btn-primary btn-sm mb-2 mt-2"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </div>
    </div>
</form>

<!-- Footer or Credits -->
<p class="text-center text-primary"><small>Practice Makes You Perfect</small></p>

@endsection
