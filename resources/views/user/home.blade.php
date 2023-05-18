@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    @if (session('status'))
        <div id="message-container" class="alert text-center alert-{{ session('status') }}">
            {{ session('message') }}
        </div>
    @endif

    <div class="col-lg-6 col-6 text-left">
        <form action="{{ route('home.filter') }}" method="POST">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for products" id="search_product"
                    aria-label="Username" aria-describedby="addon-wrapping">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent text-primary">
                        <i class="fa fa-search"></i>
                    </span>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="row">


            @if (count($categories) > 0)
                <div class="col-md-4">
                    <h3>Categories</h3>
                    <ul class="categories">
                        @foreach ($categories as $parentCat)
                            <li>{{ $parentCat->name }}</li>
                            <ul class="child-categories">
                                @foreach ($parentCat->subcategory as $childCat)
                                    <li><a href="{{ route('subcategory.show', $childCat->id) }}">{{ $childCat->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
        <div class="container-fluid pt-5">
            <div class="row px-xl-5 pb-3">
                <div class="col-md-8">
                    <h3 class="text-center">Products</h3>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                                <div class="card mb-4 box-shadow" style="height: 450px;">
                                    <img class="card-img-top" src="{{ asset('images/products/' . $product->image) }}"
                                        alt="{{ $product->name }}" style="object-fit: cover; height: 250px;">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-semi-bold m-0">{{ $product->name }}</h5>
                                        <p class="card-text">{{ $product->description }}</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">${{ $product->price }}</small>
                                        </div>
                                    </div>
                                    <div class="card-footer ">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                                            </form>
                                            <a href="{{ route('placeorder', $product) }}" class="btn btn-success ms-2">Buy
                                                Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
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
        if (messageContainer) {
            // Hide the message after a delay
            setTimeout(function() {
                messageContainer.style.display = 'none';
            }, delay);
        }


        $(function() {
            var availableTags = [];
            $.ajax({
                method: "get",
                url: "/productList",
                success: function(response) {
                    availableTags = response.map(function(product) {
                        return product.name;
                    });
                    $("#search_product").autocomplete({
                        source: availableTags
                    });
                }
            });
        });
    </script>
@endsection
