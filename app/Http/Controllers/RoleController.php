<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role; // Import Role model from Spatie.
use Spatie\Permission\Models\Permission; // Import Permission model from Spatie.
use Illuminate\View\View; // For returning views.
use Illuminate\Http\RedirectResponse; // For handling redirects.
use Illuminate\Support\Facades\DB; // For database queries.

class RoleController extends Controller
{
    /**
     * Constructor to set up middleware for role-based access control.
     */
    function __construct()
    {
        // Middleware to control access based on permissions
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of roles with pagination.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request): View
    {
        // Fetch all roles, ordered by descending ID, and paginate with 5 items per page.
        $roles = Role::orderBy('id', 'DESC')->paginate(5);

        // Pass roles to the view and compute pagination index.
        return view('roles.index', compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new role.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        // Fetch all available permissions to display in the creation form.
        $permission = Permission::get();

        // Return the view with the permissions data.
        return view('roles.create', compact('permission'));
    }

    /**
     * Store a newly created role in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate input: Role name must be unique, and at least one permission must be selected.
        $this->validate($request, [
            'name' => 'required|unique:roles,name', // Role name is required and must be unique.
            'permission' => 'required', // At least one permission is required.
        ]);

        // Convert permission IDs to integers for processing.
        $permissionsID = array_map(
            fn($value) => (int)$value,
            $request->input('permission')
        );

        // Create a new role with the given name.
        $role = Role::create(['name' => $request->input('name')]);

        // Assign selected permissions to the newly created role.
        $role->syncPermissions($permissionsID);

        // Redirect to the roles index page with a success message.
        return redirect()->route('roles.index')
                         ->with('success', 'Role created successfully');
    }

    /**
     * Display details of a specific role.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id): View
    {
        // Find the role by its ID.
        $role = Role::find($id);

        // Fetch permissions associated with the role by joining the relevant tables.
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();

        // Return the view with role and permission details.
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing a role.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id): View
    {
        // Find the role by its ID.
        $role = Role::find($id);

        // Fetch all available permissions.
        $permission = Permission::get();

        // Fetch permissions already assigned to this role.
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        // Return the view with role, permissions, and assigned permissions data.
        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified role in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validate input: Role name is required, and at least one permission must be selected.
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        // Find the role by its ID.
        $role = Role::find($id);

        // Update the role's name.
        $role->name = $request->input('name');
        $role->save();

        // Convert permission IDs to integers for processing.
        $permissionsID = array_map(
            fn($value) => (int)$value,
            $request->input('permission')
        );

        // Update the role's permissions.
        $role->syncPermissions($permissionsID);

        // Redirect to the roles index page with a success message.
        return redirect()->route('roles.index')
                         ->with('success', 'Role updated successfully');
    }

    /**
     * Remove a role from the database.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        // Delete the role by its ID.
        DB::table("roles")->where('id', $id)->delete();

        // Redirect to the roles index page with a success message.
        return redirect()->route('roles.index')
                         ->with('success', 'Role deleted successfully');
    }
}
