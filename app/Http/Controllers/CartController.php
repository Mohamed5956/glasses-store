<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        if($cart){
            return view('user.cart.index',['cartItems'=>$cart]);
        }else{
            return view('user.home')->with("Theres's No Items to display");
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        // Get the currently authenticated user
        $user = auth()->user();

        // Check if the user already has this product in their cart
        $existingCart = Cart::where('user_id', $user->id)->where('product_id', $request->product_id)->first();
        if ($existingCart) {
            // If the user already has this product in their cart, increment the quantity
            $existingCart->prod_qty += 1;
            $existingCart->save();
        } else {
            // Otherwise, create a new cart item for the user
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'prod_qty' => 1,
            ]);
        }

        // Redirect the user back to the product page
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
        $cart->delete();
        return redirect()->back();
    }
    public function cartCount()
    {
//        dd("HI");

        $user = Auth::user();
        $cartCount = Cart::where('user_id', $user->id)->sum('prod_qty');
        return response()->json(['cartCount' => $cartCount]);
    }
    public function getTotal() {
        $total = 0;
        $cartItems = Cart::getContent();
        foreach ($cartItems as $item) {
            $total += $item->price * $item->quantity;
        }
        return $total;
    }


}
