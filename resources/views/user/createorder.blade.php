@extends('layouts.app')
@section('title') Place Order @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Product') }}</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-around mb-3 flex-wrap">
                            <p>Product: {{$product->name}}</p>
                            <p>Price: {{$product->price}}</p>
                            <p class="available_quantity">Available Quantity: <span id="available">{{$product->quantity}}</span></p>
                            <div class="d-flex justify-content-center">
                                <button id="plus" class="btn btn-primary m-1">+</button>
                                <input id="quantity" type="text" class="form-control w-25 m-1" min="1" value="1" disabled>
                                <button id="minus" class="btn btn-primary m-1">-</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5 ">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Place Order') }}</div>
                    <div class="card-body">

                        <form method="POST" action="{{ route('order.store') }}" class="mt-4" >
                            @method('POST')
                            @csrf
                            <div class="form-group row">
                                <label for="firstName" class="col-md-4 col-form-label text-md-right">First Name:</label>
                                <div class="col-md-6">
                                    <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required>
                                    @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="lastName" class="col-md-4 col-form-label text-md-right">Last Name:</label>
                                <div class="col-md-6">
                                    <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required>
                                    @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address:</label>
                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone:</label>
                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label for="total_price" class="col-md-4 col-form-label text-md-right">Total Price:</label>
                                <div class="col-md-6">
                                    <p id="total_price" class="form-control-static"></p>
                                    <input type="hidden" name="quantity" id="quantityInput" value="1">
                                    <input type="hidden" name="total_price" id="total_price_input">
                                    @error('total_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Place Order
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var available = document.getElementById("available");
            var quantityInput = $('#quantity');
            var totalPriceDisplay = $('#total_price');
            var plusButton = $('#plus');
            var minusButton = $('#minus');
            var total_price_input = $('#total_price_input');
            var quantity = 1;

            // Calculate total price initially
            calculateTotalPrice();

            plusButton.click(function() {
                if (Number(quantityInput.val()) >= Number(available.innerText)) {
                    return;
                } else {
                    quantity++;
                    quantityInput.val(quantity);
                    calculateTotalPrice();
                }
            });

            minusButton.click(function() {
                if (quantity <= 1) {
                    return;
                } else {
                    quantity--;
                    quantityInput.val(quantity);
                    calculateTotalPrice();
                }
            });

            function calculateTotalPrice() {
                var price = {{$product->price}};
                var quantity = Number(quantityInput.val());
                var total = price * quantity;
                totalPriceDisplay.text('$' + total.toFixed(2));
                total_price_input.val(total.toFixed(2));
                $('#quantityInput').val(quantity);
            }
        });

    </script>
@endsection
