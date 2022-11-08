@extends('layouts.app')

@section('content')
<div class="container">

        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <!-- <th scope="col">Image</th> -->
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Description</th>
                <th scope="col">Displayed</th>
                <th scope="col">Cuisines</th>
                <th scope="col">Price</th>
                <!-- <th scope="col">Actions</th> -->
            </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->slug}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->cuisines}}</td>
                    <td>{{$product->price}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection