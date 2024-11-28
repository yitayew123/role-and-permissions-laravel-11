@extends('layouts.app')

@section('content')
<!-- Container for the main content -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Section for the page title -->
        <div class="pull-left">
            <h2>Edit User</h2>
        </div>
        <!-- Back button for navigation -->
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('users.index') }}">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>
    </div>
</div>

<!-- Validation error handling -->
@if (count($errors) > 0)
    <!-- Display errors if any input validation fails -->
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form for editing an existing user -->
<form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf <!-- CSRF token for security -->
    @method('PUT') <!-- Spoofing the HTTP PUT method for the update operation -->

    <div class="row">
        <!-- Input field for the user's name -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <!-- Pre-fill the field with the user's current name -->
                <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $user->name }}">
            </div>
        </div>

        <!-- Input field for the user's email -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <!-- Pre-fill the field with the user's current email -->
                <input type="email" name="email" placeholder="Email" class="form-control" value="{{ $user->email }}">
            </div>
        </div>

        <!-- Input field for changing the user's password -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Password:</strong>
                <!-- Password field left blank intentionally for user to input a new password -->
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
        </div>

        <!-- Input field to confirm the user's new password -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Confirm Password:</strong>
                <input type="password" name="confirm-password" placeholder="Confirm Password" class="form-control">
            </div>
        </div>

        <!-- Dropdown for assigning roles to the user -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                <!-- Multi-select dropdown populated with available roles -->
                <select name="roles[]" class="form-control" multiple="multiple">
                    @foreach ($roles as $value => $label)
                        <!-- Mark roles currently assigned to the user as selected -->
                        <option value="{{ $value }}" {{ isset($userRole[$value]) ? 'selected' : '' }}>
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

<!-- Footer with attribution -->
<p class="text-center text-primary"><small>Practice Makes You Perfect</small></p>
@endsection
