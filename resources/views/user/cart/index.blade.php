{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h2>My Cart</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Available Quantity</th>
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
                    <td><p>{{ $item->product->quantity}}</p></td>
                    <td>
                        <div class="d-flex">
                            <button class="btn btn-primary m-1 decrease-button" data-id="{{ $item->id }}">-</button>
                            <input type="text" class="form-control w-25 m-1 quantity-input" min="1" value="{{ $item->prod_qty }}" readonly>
                            <button class="btn btn-primary m-1 increase-button" data-id="{{ $item->id }}">+</button>
                        </div>
                    </td>
                    <td>{{ $item->product->price * $item->prod_qty }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-right">
            <a href="{{ route('cart.confirm_order') }}" class="btn btn-primary">Proceed to Checkout</a>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.decrease-button').on('click', function(event) {
                event.preventDefault();
                const itemId = $(this).data('id');
                const quantityInput = $(this).closest('td').find('.quantity-input');
                const availableQuantity = parseInt($(this).closest('td').prev().find('p').text());

                let newQuantity = parseInt(quantityInput.val());

                if (newQuantity > 1) {
                    newQuantity -= 1;
                    updateCartItemQuantity(itemId, newQuantity, quantityInput);
                }
            });

            $('.increase-button').on('click', function(event) {
                event.preventDefault();
                const itemId = $(this).data('id');
                const quantityInput = $(this).closest('td').find('.quantity-input');
                const availableQuantity = parseInt($(this).closest('td').prev().find('p').text());

                let newQuantity = parseInt(quantityInput.val());

                if (newQuantity < availableQuantity) {
                    newQuantity += 1;
                    updateCartItemQuantity(itemId, newQuantity, quantityInput);
                }
            });

            function updateCartItemQuantity(itemId, quantity, quantityInput) {
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: `/cart/${itemId}`,
                    method: 'PUT',
                    data: { prod_qty: quantity , _token: token },
                    success: function(response) {
                        console.log(response); // Handle success response
                        quantityInput.val(quantity);
                    },
                    error: function(error) {
                        console.log(error); // Handle error response
                    }
                });
            }
        });
    </script>
@endsection --}}





@extends('layouts.app')
@section('title')
    Cart
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-none d-md-block">
                <h2>My Cart</h2>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Available Quantity</th>
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
                                        <p>{{ $item->product->quantity }}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-primary m-1 decrease-button"
                                                data-id="{{ $item->id }}">-</button>
                                            <input type="text" style="min-width: 2.1rem"
                                                class="form-control w-25 m-1 quantity-input" min="1"
                                                value="{{ $item->prod_qty }}" readonly>
                                            <button class="btn btn-primary m-1 increase-button"
                                                data-id="{{ $item->id }}">+</button>
                                        </div>
                                    </td>
                                    <td>{{ $item->product->price * $item->prod_qty }}</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="text-right"> --}}
                {{-- <a href="{{ route('cart.confirm_order') }}" class="btn btn-primary">Proceed to Checkout</a> --}}
                {{-- </div> --}}
            </div>
            <div class="col-md-12 d-md-none">
                <h2>My Cart</h2>
                @foreach ($cartItems as $item)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->product->name }}</h5>
                            <p class="card-text">Price: {{ $item->product->price }}</p>
                            <p class="card-text">Available Quantity: {{ $item->product->quantity }}</p>
                            <div class="d-flex">
                                <button class="btn btn-primary m-1 decrease-button"
                                    data-id="{{ $item->id }}">-</button>
                                <input type="text" style="min-width: 2.1rem" class="form-control w-25 m-1 quantity-input"
                                    min="1" value="{{ $item->prod_qty }}" readonly>
                                <button class="btn btn-primary m-1 increase-button"
                                    data-id="{{ $item->id }}">+</button>
                            </div>
                            <p class="card-text">Total: {{ $item->product->price * $item->prod_qty }}</p>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-right d-block">
                <a href="{{ route('cart.confirm_order') }}" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.decrease-button').on('click', function(event) {
                event.preventDefault();
                const itemId = $(this).data('id');
                const quantityInput = $(this).parent().find('.quantity-input');
                const availableQuantity = parseInt($(this).closest('tr').find('td:nth-child(3) p').text());

                let newQuantity = parseInt(quantityInput.val());

                if (newQuantity > 1) {
                    newQuantity -= 1;
                    updateCartItemQuantity(itemId, newQuantity, quantityInput);
                }
            });

            $('.increase-button').on('click', function(event) {
                event.preventDefault();
                const itemId = $(this).data('id');
                const quantityInput = $(this).parent().find('.quantity-input');
                const availableQuantity = parseInt($(this).closest('tr').find('td:nth-child(3) p').text());

                let newQuantity = parseInt(quantityInput.val());

                if (newQuantity < availableQuantity) {
                    newQuantity += 1;
                    updateCartItemQuantity(itemId, newQuantity, quantityInput);
                }
            });


            function updateCartItemQuantity(itemId, quantity, quantityInput) {
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: `/cart/${itemId}`,
                    method: 'PUT',
                    data: {
                        prod_qty: quantity,
                        _token: token
                    },
                    success: function(response) {
                        console.log(response); // Handle success response
                        quantityInput.val(quantity);
                    },
                    error: function(error) {
                        console.log(error); // Handle error response
                    }
                });
            }
        });
    </script>
@endsection
