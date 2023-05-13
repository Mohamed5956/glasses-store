@extends('layouts.app')
@section('title') Categoires @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Categories') }}</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('categories.create') }}" class="btn btn-primary">{{ __('Create Category') }}</a>
                        </div>

                        @if (count($categories) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{__('Category')}}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                                </thead>Categories
                                <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{$category->subcategory->name}}</td>
                                        <td>
                                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-primary">{{ __('Edit') }}</a>

                                            <form class="d-inline" method="POST" action="{{ route('categories.destroy', $category) }}">
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
                            <p>No subcategories found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
