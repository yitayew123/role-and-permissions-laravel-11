@extends('layouts.app')

@section('content')
<!-- Container for the main content -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Section for the page title -->
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <!-- Button to navigate to the user creation form -->
        <div class="pull-right">
            <a class="btn btn-success mb-2" href="{{ route('users.create') }}">
                <i class="fa fa-plus"></i> Create New User
            </a>
        </div>
    </div>
</div>

<!-- Display a success message if a session key named 'success' exists -->
@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }} <!-- Displays the value of the 'success' session -->
    </div>
@endsession

<!-- Table to display the list of users -->
<table class="table table-bordered">
   <tr>
       <th>No</th> <!-- Serial number -->
       <th>Name</th> <!-- User's name -->
       <th>Email</th> <!-- User's email -->
       <th>Roles</th> <!-- Roles assigned to the user -->
       <th width="280px">Action</th> <!-- Action buttons for CRUD operations -->
   </tr>
   @foreach ($data as $key => $user)
    <tr>
        <td>{{ ++$i }}</td> <!-- Incrementing serial number -->
        <td>{{ $user->name }}</td> <!-- Display the user's name -->
        <td>{{ $user->email }}</td> <!-- Display the user's email -->
        <td>
          <!-- Display roles associated with the user -->
          @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
               <!-- Badge for each role -->
               <label class="badge bg-success">{{ $v }}</label>
            @endforeach
          @endif
        </td>
        <td>
            <!-- Show button -->
             <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">
                 <i class="fa-solid fa-list"></i> Show
             </a>
            <!-- Edit button -->
             <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">
                 <i class="fa-solid fa-pen-to-square"></i> Edit
             </a>
            <!-- Delete form with a button -->
              <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                  @csrf <!-- CSRF token for security -->
                  @method('DELETE') <!-- Spoofing the DELETE HTTP method -->

                  <!-- Delete button -->
                  <button type="submit" class="btn btn-danger btn-sm">
                      <i class="fa-solid fa-trash"></i> Delete
                  </button>
              </form>
        </td>
    </tr>
   @endforeach
</table>

<!-- Pagination links using Bootstrap 5 -->
{!! $data->links('pagination::bootstrap-5') !!}

<!-- Footer attribution -->
<p class="text-center text-primary"><small>Practice Makes You Perfect</small></p>
@endsection
