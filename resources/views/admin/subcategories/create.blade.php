@extends('layouts.app')
@section('title') Create Sub Category @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Subcategory') }}</div>
                    @if(count($categories)>0)
                    <div class="card-body">
                        <form method="POST" action="{{ route('subcategories.store') }}" class="mt-4">
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

                            <div class="form-group row mt-2">
                                <label for="subcategory_id" class="col-md-4 col-form-label text-md-right">Category:</label>
                                <div class="col-md-6">
                                    <select id="category_id" type="text" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0 ">
                                <div class="col-md-6 offset-md-4 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Create Category
                                    </button>
                                </div>
                            </div>
                        </form>
                        @else
                        <div class="d-flex m-4 justify-content-between">
                            <p class="text-danger fw-bold ">There's No Sub Categories you can't add Category</p>
                            <a href="{{route('categories.create')}}"> Go To Sub Categories</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
