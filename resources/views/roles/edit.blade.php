@extends('layouts.app')

@section('content')
<!-- Main container for the "Edit Role" page -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Left-aligned header displaying the page title -->
        <div class="pull-left">
            <h2>Edit Role</h2>
        </div>
        <!-- Right-aligned "Back" button to navigate back to the role list -->
        <div class="pull-right">
            <a class="btn btn-primary btn-sm mb-2" href="{{ route('roles.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>
</div>

<!-- Display validation errors if there are any -->
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            <!-- Loop through each error and display it -->
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Form for editing an existing role -->
<form method="POST" action="{{ route('roles.update', $role->id) }}">
    @csrf
    @method('PUT')

    <!-- Form fields for editing the role's name and permissions -->
    <div class="row">
        <!-- Role name input field -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong> <!-- Label for the name input field -->
                <!-- Pre-populated input field with the current role name -->
                <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $role->name }}">
            </div>
        </div>

        <!-- Permissions section for editing role permissions -->
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permission:</strong> <!-- Label for permission checkboxes -->
                <br/>
                <!-- Loop through each permission and create a checkbox for it -->
                @foreach($permission as $value)
                    <label>
                        <!-- Checkboxes are pre-selected if the role has the respective permission -->
                        <input type="checkbox" name="permission[{{$value->id}}]" value="{{$value->id}}" class="name" 
                        {{ in_array($value->id, $rolePermissions) ? 'checked' : ''}}>
                        {{ $value->name }}
                    </label>
                    <br/>
                @endforeach
            </div>
        </div>

        <!-- Submit button to update the role -->
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary btn-sm mb-3">
                <i class="fa-solid fa-floppy-disk"></i> Submit
            </button>
        </div>
    </div>
</form>

<!-- Footer/Credits Section -->
<p class="text-center text-primary"><small>Practice Makes You Perfect</small></p>

@endsection
