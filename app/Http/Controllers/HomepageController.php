<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        return view('user.theme',['products' => $products, 'categories' => $categories,'subcategories' => $subcategories]);
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        //

        return view('user.createorder',['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function subcategory(Subcategory $subcategory){
        $products=$subcategory->products;
//        dd($products);
        $categories=Category::all();
        return view('user.theme',['subcategory' => $subcategory,'products'=>$products,'categories' => $categories]);
    }
    public function sales(){
        $products= Product::where('trend',1)->get();

        return view('user.sales',['products'=>$products]);
    }
    public function filter(Request $request){
        $products = Product::where("name","LIKE","%$request->search%")->get();
        $categories = Category::all();
        return view('user.theme',['products'=>$products,'categories'=>$categories]);
    }
    public function productList(){
        $products= Product::all();
        return $products;
    }
}
