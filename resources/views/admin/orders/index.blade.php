@extends('layouts.app')
@section('title') Orders @endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Orders') }}</div>

                    <div class="card-body">

                        @if (count($orders) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('First Name') }}</th>
                                    <th scope="col">{{ __('last Name') }}</th>
                                    <th scope="col">{{__('Email')}}</th>
                                    <th scope="col">{{__('Phone')}}</th>
                                    <th scope="col">{{__('Address')}}</th>
                                    <th scope="col">{{__('Total Price')}}</th>
                                    <th scope="col">{{ __('Actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->firstName }}</td>
                                        <td>{{ $order->lastName }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td>
                                            <a href="{{ route('order.show', $order) }}" class="btn btn-sm btn-primary">{{ __('Show') }}</a>

                                            <form class="d-inline" method="POST" action="{{ route('order.destroy', $order) }}">
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
                            <p>No Orders found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
