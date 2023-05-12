<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subcategories = Subcategory::orderBy('name')->get();
        return view('admin.subcategories.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:subcategories|max:255',
            'slug' => 'required|unique:subcategories|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        $subcategory = Subcategory::create($validatedData);

        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully!');
    }

    public function edit(Subcategory $subcategory)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                Rule::unique('subcategories')->ignore($subcategory->id),
                'max:255'
            ],
            'slug' => [
                'required',
                Rule::unique('subcategories')->ignore($subcategory->id),
                'max:255'
            ],
            'category_id' => 'required|exists:categories,id'
        ]);

        $subcategory->update($validatedData);

        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully!');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully!');
    }
}
