@extends('layouts.app')

@section('content')
<!-- Main container for the "Products" page -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Left-aligned header displaying the page title -->
        <div class="pull-left">
            <h2>Products</h2>
        </div>
        <!-- Right-aligned "Create New Product" button, only visible if user has 'product-create' permission -->
        <div class="pull-right">
            @can('product-create') <!-- Checks if the user has permission to create products -->
            <a class="btn btn-success btn-sm mb-2" href="{{ route('products.create') }}"><i class="fa fa-plus"></i> Create New Product</a>
            @endcan
        </div>
    </div>
</div>

<!-- Display a success message if a session variable is set -->
@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }} <!-- Display the success message stored in the session -->
    </div>
@endsession

<!-- Table displaying all the products -->
<table class="table table-bordered">
    <!-- Table headers -->
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Details</th>
        <th width="280px">Action</th> <!-- Action column for edit, show, and delete options -->
    </tr>

    <!-- Loop through each product and display its details -->
    @foreach ($products as $product)
    <tr>
        <!-- Incrementing index for the 'No' column -->
        <td>{{ ++$i }}</td>
        <td>{{ $product->name }}</td> <!-- Display the product name -->
        <td>{{ $product->detail }}</td> <!-- Display the product details -->
        <td>
            <!-- Form for handling delete action for the product -->
            <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                <!-- View product details (Show button) -->
                <a class="btn btn-info btn-sm" href="{{ route('products.show',$product->id) }}"><i class="fa-solid fa-list"></i> Show</a>

                <!-- Edit product button, only visible if user has 'product-edit' permission -->
                @can('product-edit') <!-- Checks if the user has permission to edit products -->
                <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$product->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                @endcan

                <!-- CSRF token for security -->
                @csrf
                <!-- Specify that the request method is DELETE for the product deletion -->
                @method('DELETE')

                <!-- Delete product button, only visible if user has 'product-delete' permission -->
                @can('product-delete') <!-- Checks if the user has permission to delete products -->
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                @endcan
            </form>
        </td>
    </tr>
    @endforeach
</table>

<!-- Pagination controls for navigating through the product list -->
{!! $products->links() !!}

<!-- Footer or Credits Section -->
<p class="text-center text-primary"><small>Practice Makes You Perfect</small></p>

@endsection
