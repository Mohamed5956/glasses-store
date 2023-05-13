@extends('layouts.app')
@section('title') Products @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Products') }}</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('products.create') }}" class="btn btn-primary">{{ __('Create Product') }}</a>
                        </div>

                        @if (count($products) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{__('Category')}}</th>
                                    <th scope="col">{{__('Price')}}</th>
                                    <th scope="col">{{__('Quantity')}}</th>
                                    <th scope="col">{{__('image')}}</th>
                                    <th scope="col">{{__('On Sale')}}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                                </thead>Products
                                <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{$product->category->name}}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td><img src="{{asset('images/products/' . $product->image)}}" width="120rem" height="90rem"></td>
                                        <td>
                                            @if ($product->trend == 1)
                                                <span class="">On Sale</span>
                                            @else
                                                <span class="">Not On Sale</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                            <form class="d-inline" method="POST" action="{{ route('products.destroy', $product) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No Products found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
