@extends('layouts.app')
@section('title') Create Product @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Product') }}</div>
                    @if(count($categories)>0)
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.store') }}" class="mt-4" enctype="multipart/form-data">
                            @method('POST')
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name:</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" >

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description:</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" >

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-md-6">
                                    <label for="price" class="form-label text-md-right">Price:</label>

                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" >

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="price" class="form-label text-md-right">Quantity:</label>

                                    <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" >

                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row m-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="trend" id="trend" value="1">
                                    <label class="form-check-label" for="trend">
                                        On Sale
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label for="image" class="col-md-4 col-form-label text-md-right">Image:</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" >

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mt-2">
                                <label for="category_id" class="col-md-4 col-form-label text-md-right">Categories:</label>
                                <div class="col-md-6">
{{--                                    <select id="category_id" type="text" class="form-control" name="category_id">--}}
{{--                                        @foreach($categories as $parentCat)--}}
{{--                                                <optgroup label="{{$parentCat->name}}">--}}
{{--                                                    @foreach($parentCat->category as $childCat)--}}
{{--                                                        @if($childCat->id == $parentCat->id)--}}
{{--                                                            <option value="{{$childCat->id}}">{{$childCat->name}}</option>--}}
{{--                                                        @endif--}}
{{--                                                    @endforeach--}}
{{--                                                </optgroup>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
                                    <select id="subcategory_id" type="text" class="form-control" name="subcategory_id">
                                        @foreach($categories as $cat)
                                                <optgroup label="{{$cat->name}}">
                                                    @foreach($subcategories as $subcategory)
                                                        @if($subcategory->category->id == $cat->id)
                                                            <option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0 ">
                                <div class="col-md-6 offset-md-4 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Create Product
                                    </button>
                                </div>
                            </div>
                        </form>
                        @else
                        <div class="d-flex m-4 justify-content-between">
                            <p class="text-danger fw-bold ">There's No Categories you can't add Product</p>
                            <a href="{{route('subcategories.create')}}"> Go To Categories</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
