<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the user's cart items.
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('home.index')->with("message", "There are no items to display")->with('status', 'warning');
        }

        return view('user.cart.index', ['cartItems' => $cartItems]);
    }

    /**
     * Add a product to the cart.
     */
    public function store(StoreCartRequest $request)
    {
        $user = Auth::user();
        $existingCart = Cart::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCart) {
            $existingCart->prod_qty += 1;
            $existingCart->save();
        } else {
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'prod_qty' => 1,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Show the confirmation page for placing an order.
     */
    public function proceedOrder()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        $userInfo = User::find($user->id);

        return view('user.cart.confirm_order', [
            'cartItems' => $cartItems,
            'userInfo' => $userInfo,
        ]);
    }

    /**
     * Store the order and order items in the database.
     */
    public function save(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->get();
        $userInfo = Auth::user();

        DB::beginTransaction();

        try {
            $order = new Order();
            $order->firstName = $request->input('firstName');
            $order->lastName = $request->input('lastName');
            $order->email = $request->input('email');
            $order->phone = $request->input('phone');
            $order->address = $request->input('address');
            $order->total_price = $this->calculateTotalPrice($cartItems);
            $order->user_id = $userInfo->id;
            $order->save();

            foreach ($cartItems as $cartItem) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $cartItem->product_id;
                $orderItem->quantity = $cartItem->prod_qty;
                $orderItem->price = $cartItem->product->price;
                $orderItem->save();
            }

            $this->clearCart();

            DB::commit();

            Session::flash('success', 'Order placed successfully!');
            return redirect()->route('placeorder');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Failed to place the order. Please try again.');
        }
    }

    /**
     * Remove an item from the cart.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->back();
    }

    /**
     * Get the count of items in the cart.
     */
    public function cartCount()
    {
        $user = Auth::user();
        $cartCount = Cart::where('user_id', $user->id)->sum('prod_qty');
        return response()->json(['cartCount' => $cartCount]);
    }

    /**
     * Calculate the total price of the cart items.
     */
    private function calculateTotalPrice($cartItems)
    {
        $total = 0;

        foreach ($cartItems as $cartItem) {
            $total += $cartItem->product->price * $cartItem->prod_qty;
        }

        return $total;
    }

    /**
     * Clear the cart.
     */
    private function clearCart()
    {
        $user = Auth::user();
        Cart::where('user_id', $user->id)->delete();
    }
}
