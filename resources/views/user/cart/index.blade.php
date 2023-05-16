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
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary m-1 quantity-control" data-id="{{ $item->id }}" data-action="increase">+</button>
                                <input type="text" class="form-control w-25 m-1 quantity-input" min="1" value="{{ $item->prod_qty }}" disabled>
                                <button class="btn btn-primary m-1 quantity-control" data-id="{{ $item->id }}" data-action="decrease">-</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityControls = document.querySelectorAll('.quantity-control');

            quantityControls.forEach(function(control) {
                control.addEventListener('click', function(event) {
                    event.preventDefault();
                    const itemId = this.getAttribute('data-id');
                    const action = this.getAttribute('data-action');
                    const quantityInput = this.parentNode.querySelector('.quantity-input');

                    if (action === 'increase') {
                        quantityInput.value = parseInt(quantityInput.value) + 1;
                    } else if (action === 'decrease') {
                        if (parseInt(quantityInput.value) > 1) {
                            quantityInput.value = parseInt(quantityInput.value) - 1;
                        }
                    }

                    updateCartItemQuantity(itemId, quantityInput.value);
                });
            });

            function updateCartItemQuantity(itemId, quantity) {
                axios.put(`/cart/${itemId}`, { quantity: quantity })
                    .then(function(response) {
                        console.log(response.data); // Handle success response
                    })
                    .catch(function(error) {
                        console.log(error); // Handle error response
                    });
            }
        });
    </script>
@endsection
