@extends('layouts.app')

@section('title') Home @endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>Categories</h3>
                <ul class="categories">
                    @foreach($categories as $parentCat)
                        <li>{{ $parentCat->name }}</li>
                        <ul class="child-categories" >
                            @foreach($parentCat->subcategory as $childCat)
                                <li>{{$childCat->name}}</li>
                            @endforeach
                        </ul>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8">
                <h3>Products</h3>
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
                                <div class="card-footer mx-auto my-auto">
                                    <a href="#" class="btn btn-success">Add To Cart</a>
                                    <a href="{{route('placeorder',$product)}}" class="btn btn-success">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script>
    </script>
@endsection
