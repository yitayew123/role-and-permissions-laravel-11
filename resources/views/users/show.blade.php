@extends('layouts.app')

@section('content')
<!-- Main container for displaying user details -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Section for the page title -->
        <div class="pull-left">
            <h2>Show User</h2>
        </div>
        <!-- Button to navigate back to the user index page -->
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>

<!-- Section to display the details of the selected user -->
<div class="row">
    <!-- User's Name -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            <!-- Display the user's name from the $user variable -->
            {{ $user->name }}
        </div>
    </div>
    
    <!-- User's Email -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            <!-- Display the user's email from the $user variable -->
            {{ $user->email }}
        </div>
    </div>
    
    <!-- User's Roles -->
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Roles:</strong>
            <!-- Check if the user has roles and display them -->
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <!-- Display each role as a badge -->
                    <label class="badge badge-success">{{ $v }}</label>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
