@extends('layouts.nav')
@section('title')
    Home
@endsection
@section('content')
    <style>
        .btn-center {
            display: flex;
            justify-content: center;
        }
    </style>
    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col-lg-6 col-md-8 col-sm-10 mx-auto">
                <div class="search-bar">
                    <form action="{{ route('home.filter') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" id="search_product"
                                placeholder="Product Name" aria-label="Username" aria-describedby="addon-wrapping">
                            <button type="submit" class="input-group-text"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-8 mx-auto">
                <h3 class="text-center my-5">Products</h3>
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card h-100">
                                <img class="card-img-top" src="{{ asset('images/products/' . $product->image) }}"
                                    alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->description }}</p>
                                    <h6 class="card-subtitle mb-2 text-muted">${{ $product->price }}</h6>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex  justify-content-between">
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            @if ($product->quantity == 0)
                                                <div class="btn-center">
                                                    <button type="button" class="btn btn-danger">Not Available</button>
                                                </div>
                                            @else
                                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                                                <a href="{{ route('placeorder', $product) }}"
                                                    class="btn btn-success ms-2">Buy
                                                    Now</a>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
