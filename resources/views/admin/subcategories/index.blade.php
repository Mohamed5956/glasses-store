@extends('layouts.app')
@section('title') Sub Categoires @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Subcategories') }}</div>

                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="{{ route('subcategories.create') }}" class="btn btn-primary">{{ __('Create SubCategory') }}</a>
                        </div>

                        @if (count($subcategories) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('Name') }}</th>
                                    <th scope="col">{{__('category')}}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                                </thead>Sub Categories
                                <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        <td>{{ $subcategory->name }}</td>
                                        <td>{{$subcategory->category->name}}</td>
                                        <td>
                                            <a href="{{ route('subcategories.edit', $subcategory) }}" class="btn btn-sm btn-primary mb-1">{{ __('Edit') }}</a>

                                            <form class="d-inline" method="POST" action="{{ route('subcategories.destroy', $subcategory) }}">
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
                            <p>No Subcategories found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
