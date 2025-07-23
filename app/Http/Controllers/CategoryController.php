<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categorys = Category::get();
        return view('admin.category.list', compact('categorys'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255|unique:category,name',
            'type'              => 'required|in:1,2,3,4,5',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:255',
            'meta_keywords'     => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $imageName  = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/category'), $imageName);
            $validated['image'] = 'uploads/category/' . $imageName; // full path
        }

        $validated['slug']   = Str::slug($validated['name']);
        $validated['status'] = 1;

        Category::create($validated);

        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255|unique:category,name,' . $category->id,
            'status'            => 'required|in:0,1',
            'type'              => 'required|in:1,2,3,4,5',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:255',
            'meta_keywords'     => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $image      = $request->file('image');
            $imageName  = time() . '_' . Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/category'), $imageName);
            $validated['image'] = 'uploads/category/' . $imageName; // full path
        }

        $validated['slug'] = Str::slug($validated['name']);

        $category->update($validated);

        return redirect()->route('admin.category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->image && file_exists(public_path($category->image))) {
            unlink(public_path($category->image));
        }

        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
    }
}
