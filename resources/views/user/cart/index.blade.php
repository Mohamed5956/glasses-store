@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>My Cart</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cartItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->price }}</td>
                    <td>
                        <form action="{{ route('cart.update', $item) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-group">
                                <button type="submit" class="input-group-text">-</button>
                                <input type="number" name="prod_qty" value="{{ $item->prod_qty }}" class="form-control">
                                <button type="submit" class="input-group-text">+</button>
                            </div>
                        </form>
                    </td>
                    <td>{{ $item->product->price * $item->prod_qty }}</td>
                    <td>
                        <form action="{{ route('cart.destroy', $item) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <a href="{{ route('order.store') }}" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    </div>
@endsection
