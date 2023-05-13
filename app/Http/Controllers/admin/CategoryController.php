<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    function __construct(){
        $this->middleware(AdminMiddleware::class);
    }
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = category::orderBy('name')->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
        // dd($request->all());

        $cat = Category::create($request->all());
        $cat->save();
        return redirect()->route('categories.index')->with('success', 'category created successfully!');
    }

    public function edit(Category $category)
    {
        // dd($subcategory);
        return view('admin.categories.edit', compact('category', 'category'));
    }

    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'max:255'
            ],
        ]);

        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $d=$category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
