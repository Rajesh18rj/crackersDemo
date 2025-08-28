<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('product.index', compact('products'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('product.create-edit', compact('categories'));
    }

    // Store new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'original_price' => 'nullable|numeric',
            'package' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only('name', 'category_id', 'price', 'original_price', 'package', 'is_active');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin1.products.index')->with('success', 'Product created successfully.');
    }

    // Show edit form
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.create-edit', compact('product', 'categories'));
    }

    // Update product
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'original_price' => 'nullable|numeric',
            'package' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only('name', 'category_id', 'price', 'original_price', 'package', 'is_active');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }
            $data['image_path'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin1.products.index')->with('success', 'Product updated successfully.');
    }

    // Delete product
    public function destroy(Product $product)
    {
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('admin1.products.index')->with('success', 'Product deleted successfully.');
    }
}
