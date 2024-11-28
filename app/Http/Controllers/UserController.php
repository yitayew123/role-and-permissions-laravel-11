<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Handles HTTP requests.
use App\Http\Controllers\Controller; // Base Controller class for Laravel controllers.
use App\Models\User; // Importing the User model.
use Spatie\Permission\Models\Role; // Importing the Role model from the Spatie package.
use Illuminate\Support\Facades\Hash; // Provides hashing functions, such as for passwords.
use Illuminate\Support\Facades\DB; // Facilitates direct database queries.
use Illuminate\Support\Arr; // Provides array utilities.
use Illuminate\View\View; // For returning views.
use Illuminate\Http\RedirectResponse; // For returning redirects.

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        // Retrieve the latest users and paginate them, showing 5 users per page.
        $data = User::latest()->paginate(5);

        // Return the 'users.index' view, passing user data and the pagination index.
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        // Retrieve all roles as an associative array with names as both keys and values.
        $roles = Role::pluck('name', 'name')->all();

        // Return the 'users.create' view, passing the roles.
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data.
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Email must be unique in the users table.
            'password' => 'required|same:confirm-password', // Password and confirmation must match.
            'roles' => 'required' // At least one role is required.
        ]);

        // Get all input data and hash the password.
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        // Create a new user with the provided data.
        $user = User::create($input);

        // Assign the selected roles to the user.
        $user->assignRole($request->input('roles'));

        // Redirect to the users list with a success message.
        return redirect()->route('users.index')
                         ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id): View
    {
        // Find the user by ID and return the 'users.show' view.
        $user = User::find($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id): View
    {
        // Retrieve the user, all roles, and the user's assigned roles.
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        // Return the 'users.edit' view with the user, roles, and user's roles.
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validate the incoming request data.
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id, // Email must be unique except for the current user.
            'password' => 'same:confirm-password', // Password and confirmation must match if provided.
            'roles' => 'required' // At least one role is required.
        ]);

        // Get all input data, and if a password is provided, hash it.
        $input = $request->all();
        if (!empty($input['password'])) { 
            $input['password'] = Hash::make($input['password']);
        } else {
            // Exclude the password if it is not provided.
            $input = Arr::except($input, ['password']);    
        }

        // Find the user, update their data, and reassign roles.
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));

        // Redirect to the users list with a success message.
        return redirect()->route('users.index')
                         ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        // Find the user by ID and delete them.
        User::find($id)->delete();

        // Redirect to the users list with a success message.
        return redirect()->route('users.index')
                         ->with('success', 'User deleted successfully');
    }
}
