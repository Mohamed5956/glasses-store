<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class OrderController extends Controller
{
    function __construct(){
        $this->middleware(AdminMiddleware::class)->only(['index','show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function checkout(){
        
    }
    public function index()
    {
        //
        $orders = Order::all();
        return view('admin.orders.index',['orders' => $orders]);
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
    public function store(StoreOrderRequest $request)
    {
        //

        $product = Product::findOrFail($request->product_id);

        // Calculate the total price for the order
        $total_price = $request->total_price;
        if(Auth::user()){
            $order = Order::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'total_price' => $total_price,
                'user_id'=>Auth::user()->id
            ]);
        }else{
            $order = Order::create([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'total_price' => $total_price,
            ]);
        }
        // Create the order record


//        dd($product->id);

        // Create the order item record
        $order_item = Orderitem::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->price,
            'order_id' => $order->id,
        ]);
        $product->update([
            'quantity' => $product->quantity - $request->quantity,
        ]);

        return Redirect::route('home.index')->with('message', 'Order placed successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
//        dd($order->orderItems()->product());
        return view('admin.orders.show', ['order'=>$order]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('order.index');
        //
    }
}
