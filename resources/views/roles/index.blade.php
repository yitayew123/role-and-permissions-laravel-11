@extends('layouts.app')

@section('content')
<!-- Main container for the "Role Management" page -->
<div class="row">
    <div class="col-lg-12 margin-tb">
        <!-- Left-aligned header displaying the page title -->
        <div class="pull-left">
            <h2>Role Management</h2>
        </div>
        <!-- Right-aligned button to create a new role (only visible if the user has 'role-create' permission) -->
        <div class="pull-right">
            @can('role-create') <!-- Check if the user has the permission to create roles -->
                <a class="btn btn-success btn-sm mb-2" href="{{ route('roles.create') }}"><i class="fa fa-plus"></i> Create New Role</a>
            @endcan
        </div>
    </div>
</div>

<!-- Display success message if a session variable 'success' is present -->
@session('success')
    <div class="alert alert-success" role="alert"> 
        {{ $value }}
    </div>
@endsession

<!-- Table to display all roles -->
<table class="table table-bordered">
  <tr>
     <!-- Table headers -->
     <th width="100px">No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>

  <!-- Loop through the roles and display each role's data -->
  @foreach ($roles as $key => $role)
  <tr>
      <td>{{ ++$i }}</td> <!-- Increment the index for each role -->
      <td>{{ $role->name }}</td> <!-- Display the name of the role -->
      <td>
          <!-- View button to see the details of the role -->
          <a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}"><i class="fa-solid fa-list"></i> Show</a>
          
          <!-- Edit button (only visible if the user has 'role-edit' permission) -->
          @can('role-edit') <!-- Check if the user has permission to edit roles -->
              <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
          @endcan

          <!-- Delete button (only visible if the user has 'role-delete' permission) -->
          @can('role-delete') <!-- Check if the user has permission to delete roles -->
              <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                  @csrf
                  @method('DELETE')

                  <!-- Button to submit the form and delete the role -->
                  <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
              </form>
          @endcan
      </td>
  </tr>
  @endforeach
</table>

<!-- Pagination links for the roles -->
{!! $roles->links('pagination::bootstrap-5') !!}

<!-- Footer/Credits Section -->
<p class="text-center text-primary"><small>Practice Makes You Perfect</small></p>

@endsection
