@extends('layouts.app')
@section('title') Place Order @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Product') }}</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-around mb-3">
                            <p>Product : {{$product->name}}</p>
                            <p>Price : {{$product->price}}</p>
                            <p  class="available_quantity">Available Quantity : <span id="available">{{$product->quantity}}</span></p>
                            <div class="d-flex justify-content-center">
                                <button id="plus" class="btn btn-primary m-1" >+</button>
                                <input id="quantity" type="text" class="form-control w-25 m-1" min="1" value="1" disabled>
                                <button id="minus" class="btn btn-primary m-1">-</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Place Order') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('products.store') }}" class="mt-4" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="form-group row">
                                    <label for="firstName" class="col-md-4 col-form-label text-md-right">First Name:</label>

                                    <div class="col-md-6">
                                        <input id="firstName" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" >

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
                                        <input id="lastName" type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" >

                                        @error('lastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mt-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>

                                    <div class="col-md-6">
                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" >

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
                                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" >

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
                                        <input id="total_price" type="hidden" name="total_price" value="" >
                                        <p class=""></p>

                                    </div>
                                </div>

                                <div class="form-group row mb-0 ">
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
        var available = document.getElementById("available");


        $(document).ready(function() {
            // Get the quantity input field.
            var quantityInput = $('#quantity');
            // Get the plus button.
            var plusButton = $('#plus');
            // Get the minus button.
            var minusButton = $('#minus');
            // console.log(available);
            console.log(Number(available.innerText));
            // Increase the quantity when the plus button is clicked.
            plusButton.click(function() {
                if(Number(quantityInput.val()) >= Number(available.innerText)){
                    return;
                }else{
                    quantityInput.val(Number(quantityInput.val()) + 1);
                }
            });

            // Decrease the quantity when the minus button is clicked.
            minusButton.click(function() {
                if (quantityInput.val() == 1) {
                    quantityInput.value=1 ;
                }else{
                    quantityInput.val(Number(quantityInput.val()) - 1);
                }

            });
        });
    </script>
@endsection
