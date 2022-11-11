@extends('layouts.app')

@section('content')
<div class="container">
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th scope="col">Customer Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Shipping Address</th>
                <th scope="col">Products</th>
                <th scope="col">Total Price</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Paid</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <th scope="row">{{$order->name}}</th>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->shipping_address}}</td>
                    <td>
                        @foreach($order->products as $product)
                        <span class="d-block">{{ $product->name }} - {{ $product->pivot->quantity }}</span>

                        @endforeach
                    </td>
                    <td>{{$order->total_price}}</td>
                    <td>{{$order->created_at->format('d-m-Y')}}</td>
                    <td>{{$order->created_at->format('H:i')}}</td>
                    <td>{{($order->paid)?'paid':'not paid'}}</td>
                    <td><a class="btn btn-warning m-1" href="{{route('admin.orders.show', ['order' => $order->id])}}">Show</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
