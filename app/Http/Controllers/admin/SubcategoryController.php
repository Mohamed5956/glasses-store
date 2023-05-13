<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    function __construct(){
        $this->middleware(AdminMiddleware::class);
    }
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
        $request->validate([
            'name' => 'required|max:255',
        ]);
        // dd($request->all());

        $subcat = Subcategory::create($request->all());
        $subcat->save();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully!');
    }

    public function edit(Subcategory $subcategory)
    {
        // dd($subcategory);
        return view('admin.subcategories.edit', compact('subcategory', 'subcategory'));
    }

    public function update(Request $request, Subcategory $subcategory)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'max:255'
            ],
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
