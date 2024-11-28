<?php
  
use Illuminate\Support\Facades\Route; // Importing the Route facade for defining routes.
use App\Http\Controllers\HomeController; // Importing the HomeController for handling home-related actions.
use App\Http\Controllers\RoleController; // Importing the RoleController for managing roles.
use App\Http\Controllers\UserController; // Importing the UserController for managing users.
use App\Http\Controllers\ProductController; // Importing the ProductController for handling product-related actions.
use Illuminate\Support\Facades\Auth; // Importing the Auth facade for authentication-related routes and features.

// Define the route for the root URL of the application.
Route::get('/', function () {
    // When a user accesses the root URL ('/'), they are shown the 'welcome' view.
    return view('welcome');
});
  
// Register all default authentication routes (login, register, reset password, etc.) provided by Laravel.
Auth::routes();
  
// Define a route for the '/home' URL.
Route::get('/home', [HomeController::class, 'index'])->name('home');
// This route maps '/home' to the `index` method of the HomeController.
// It is named 'home', so you can reference it in views or redirects using `route('home')`.

// Define a group of routes that require user authentication.
Route::group(['middleware' => ['auth']], function() {
    // Resource controller for managing roles. Provides routes like:
    // - GET /roles -> index (list all roles)
    // - GET /roles/create -> create (show form for creating a new role)
    // - POST /roles -> store (save a new role)
    // - GET /roles/{id} -> show (view a specific role)
    // - PUT/PATCH /roles/{id} -> update (edit a specific role)
    // - DELETE /roles/{id} -> destroy (delete a specific role)
    Route::resource('roles', RoleController::class);

    // Resource controller for managing users. Provides similar routes as above for users.
    Route::resource('users', UserController::class);

    // Resource controller for managing products. Provides similar routes as above for products.
    Route::resource('products', ProductController::class);
});
