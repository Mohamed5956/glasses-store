@extends('layouts.app')

@section('title') Home @endsection

@section('content')
@if(session('status'))
    <div id="message-container" class="alert text-center alert-{{ session('status') }}">
        {{ session('message') }}
    </div>
@endif

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
                                <div class="card-footer">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                        </form>
                                        <a href="{{route('placeorder',$product)}}" class="btn btn-success ms-2">Buy Now</a>
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

@section('scripts')
<script>
    // Delay in milliseconds
    const delay = 3000;

    // Get the message container element
    const messageContainer = document.getElementById('message-container');

    // Hide the message after a delay
    setTimeout(function() {
        messageContainer.style.display = 'none';
    }, delay);
</script>

@endsection
