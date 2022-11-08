@extends('layouts.app')

@section('content')
<div class="container">
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col">Shipping Address</th>
                <th scope="col">Total Price</th>
                <th scope="col">Paid</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <th scope="row">{{$order->id}}</th>
                    <td>{{$order->name}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->shipping_address}}</td>
                    <td>{{$order->total_price}}</td>
                    <td>{{($order->paid)?'paid':'not paid'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection