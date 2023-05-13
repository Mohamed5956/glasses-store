<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    function __construct(){
        $this->middleware(AdminMiddleware::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
//        $products = Product::all();
        $products = Product::orderBy('name')->get();
        return view('admin.products.index',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('admin.products.create',['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product($request->all());
        $product->save();
        $this->save_image($request->image,$product);
        return redirect()->route('products.index')->with('success', 'Product Added successfully!');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $categories = Category::all();
        return view('admin.products.edit',['product' => $product,'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        if ($request->file('image')) {
//            dd('heelo');
            $this->delete_image($product->image);
            $this->save_image($request->image, $product);
        }
        $product->update();

        return redirect()->route('products.index')->with('success', 'Product Updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $this->delete_image($product->image);

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted successfully!');

    }

    private function delete_image($image_name){
//        dd($image_name !='article.png' and ! str_contains($image_name, '/tmp/'));
        if(!str_contains($image_name, '/tmp/')){
            try{
                unlink(public_path('images/products/'.$image_name));
            }catch (\Exception $e){
                echo $e;
            }
        }
    }

    private function save_image($image, $product){
        if ($image){
            $image_name = time().'.'.$image->extension();
            $image->move(public_path('images/products'),$image_name);
            $product->image = $image_name;
            $product->save();
        }
    }

}
