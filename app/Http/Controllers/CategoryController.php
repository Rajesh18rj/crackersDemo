<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show list of categories
    public function index()
    {
        $categories = Category::paginate(10);
        return view('category.index', compact('categories'));
    }

    // Show the form to create new category
    public function create()
    {
        return view('category.create');
    }

    // Store new category to database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create($request->only('name'));

        return redirect()->route('admin1.categories.index')->with('success', 'Category created successfully.');
    }

    // Show form to edit existing category
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    // Update category in database
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->only('name'));

        return redirect()->route('admin1.categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete a category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin1.categories.index')->with('success', 'Category deleted successfully.');
    }
}
