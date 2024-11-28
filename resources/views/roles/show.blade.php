@extends('layouts.app')

@section('content')
<!-- Main container for the "Show Role" page -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Left-aligned header displaying the page title -->
        <div class="pull-left">
            <h2> Show Role</h2>
        </div>
        <!-- Right-aligned button to go back to the roles index page -->
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>
    </div>
</div>

<!-- Display the details of the role -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <!-- Label for the role name -->
            <strong>Name:</strong>
            {{ $role->name }} <!-- Display the role's name -->
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <!-- Label for the role permissions -->
            <strong>Permissions:</strong>
            <!-- Check if the role has associated permissions -->
            @if(!empty($rolePermissions))
                <!-- Loop through each permission and display it -->
                @foreach($rolePermissions as $v)
                    <!-- Display each permission as a green label -->
                    <label class="label label-success">{{ $v->name }},</label>
                @endforeach
            @endif
        </div>
    </div>
</div>

@endsection
