@extends('layouts.app')

@section('title')
    {{$order->firstName}}'s Order Details
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-light">
                        <h4>Order View</h4>
                        <a href="{{ route('order.index') }}" class="btn btn-warning float-end">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row order-details">
                            <div class="col-md-6">
                                <h4>Shipping Details</h4>
                                <hr>
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <div class="border">{{ $order->firstName }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <div class="border">{{ $order->lastName }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="border">{{ $order->email }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Contact No.</label>
                                    <div class="border">{{ $order->phone }}</div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Shipping Address</label>
                                    <div class="border">
                                        {{ $order->address }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h4>Order Details</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $item)
                                            <tr>
                                                <td>{{ $item->product->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>
                                                    <img src="{{ asset('images/products/' . $item->product->image) }}"
                                                         width="50px" alt="Product-image">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 class="px-2">Total : <span class="float-end">{{ $order->total_price }} $</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
