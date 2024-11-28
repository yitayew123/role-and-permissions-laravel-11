<?php

namespace App\Http\Controllers;

use App\Models\Product; // Importing the Product model.
use Illuminate\Http\Request; // For handling HTTP requests.
use Illuminate\View\View; // For returning views.
use Illuminate\Http\RedirectResponse; // For handling redirects.

class ProductController extends Controller
{
    /**
     * Set up middleware for role-based permissions.
     */
    function __construct()
    {
        // Apply permissions for specific methods.
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Retrieve the latest products and paginate them, 5 per page.
        $products = Product::latest()->paginate(5);

        // Return the 'products.index' view with the products data and page index.
        return view('products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        // Return the 'products.create' view to display the form for creating a product.
        return view('products.create');
    }

    /**
     * Store a newly created product in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request to ensure required fields are provided.
        $request->validate([
            'name' => 'required', // 'name' field is mandatory.
            'detail' => 'required', // 'detail' field is mandatory.
        ]);

        // Create a new product with the validated data.
        Product::create($request->all());

        // Redirect to the product index page with a success message.
        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified product details.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product): View
    {
        // Return the 'products.show' view with the product data.
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing a product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product): View
    {
        // Return the 'products.edit' view with the product data.
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        // Validate the incoming request to ensure required fields are provided.
        $request->validate([
            'name' => 'required', // 'name' field is mandatory.
            'detail' => 'required', // 'detail' field is mandatory.
        ]);

        // Update the product with the validated data.
        $product->update($request->all());

        // Redirect to the product index page with a success message.
        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified product from the database.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Delete the specified product from the database.
        $product->delete();

        // Redirect to the product index page with a success message.
        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully');
    }
}
