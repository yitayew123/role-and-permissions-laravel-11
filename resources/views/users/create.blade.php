@extends('layouts.app')

@section('content')
<!-- Row container for the content -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Left alignment for the heading -->
        <div class="pull-left">
            <h2>Create New User</h2>
        </div>
        <!-- Right alignment for the "Back" button -->
        <div class="pull-right">
            <!-- Button to navigate back to the user listing page -->
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('users.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>

<!-- Check if there are any validation errors -->
@if (count($errors) > 0)
    <!-- Display an alert box for validation errors -->
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            <!-- Iterate through and display each error message -->
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form to create a new user -->
<form method="POST" action="{{ route('users.store') }}">
    @csrf <!-- CSRF token for security -->
    <div class="row">
        <!-- Input field for the user's name -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" placeholder="Name" class="form-control">
            </div>
        </div>

        <!-- Input field for the user's email -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="email" name="email" placeholder="Email" class="form-control">
            </div>
        </div>

        <!-- Input field for the user's password -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
        </div>

        <!-- Input field to confirm the user's password -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
            </div>
        </div>

        <!-- Dropdown to select roles for the user -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                <select name="roles[]" class="form-control" multiple="multiple">
                    <!-- Populate roles dynamically from the controller -->
                    @foreach ($roles as $value => $label)
                        <option value="{{ $value }}">
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Submit button -->
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mt-2 mb-3">
                <i class="fa-solid fa-floppy-disk"></i> Submit
            </button>
        </div>
    </div>
</form>

<!-- Footer for attribution -->
<p class="text-center text-primary"><small>Practice Makes You Perfect</small></p>
@endsection
