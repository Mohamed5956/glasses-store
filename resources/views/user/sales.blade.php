{{-- @extends('layouts.nav')

@section('title')
    Sales
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center my-5">Sales - Up to 40% off</h1>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="{{ asset('images/products/' . $product->image) }}"
                            alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="price">${{ $product->price }}</div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('placeorder', $product) }}" class="btn btn-success ms-2">Buy
                                            Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
@endsection

@section('styles')
    <style>
        .card-badge {
            position: absolute;
            top: 0;
            left: 0;
            padding: 0.5rem;
            background-color: #f44336;
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            z-index: 10;
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
        }

        .price {
            font-size: 1.25rem;
            font-weight: bold;
        }
    </style>
@endsection --}}



@extends('layouts.nav')

@section('title') Sales @endsection

@section('content')
    <div class="container">
        <h1 class="text-center my-5">Sales - Up to 40% off</h1>
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow" style="height: 450px;">
                        <img class="card-img-top" src="{{asset('images/products/' . $product->image)}}" alt="{{ $product->name }}" style="object-fit: cover; height: 250px;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">${{ $product->price }}</small>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="btn " style="background-color: black;color:white">Add to Cart</button>
                                </form>
                                <a href="{{route('placeorder',$product)}}" class="btn ms-2" style="background-color: black;color:white">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @section('styles')
    <style>
        .card-badge {
            position: absolute;
            top: 0;
            left: 0;
            padding: 0.5rem;
            background-color: #f44336;
            color: #fff;
            font-weight: bold;
            font-size: 1rem;
            z-index: 10;
        }

        .card-img-top {
            height: 250px;
            object-fit: cover;
        }

        .price {
            font-size: 1.25rem;
            font-weight: bold;
        }
    </style>
@endsection
@endsection
