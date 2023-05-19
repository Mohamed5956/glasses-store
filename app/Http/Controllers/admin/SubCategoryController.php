<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct(){
        $this->middleware(AdminMiddleware::class);
    }
    public function index()
    {
        //
        $subcategories = Subcategory::orderBy('name')->get();
        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::orderBy('name')->get();
        return view('admin.subcategories.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
        ]);
        // dd($request->all());

        $subcats = Subcategory::create($request->all());
        $subcats->save();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        //
        $categories = Category::orderBy('name')->get();
        return view('admin.subcategories.edit', ['subcategory' => $subcategory,"categories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        //
        $validatedData = $request->validate([
            'name' => [
                'required',
                'max:255'
            ],
        ]);

        $subcategory->update($validatedData);

        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory Deleted successfully!');
    }
}
