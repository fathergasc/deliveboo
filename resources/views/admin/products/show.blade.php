@extends('layouts.app')

@section('content')
    <div class="container">

        <a class="btn btn-primary mb-3" href="{{ route('admin.products.index') }}">Back to products list</a>



        <div class="container d-flex flex-wrap flex-md-nowrap">

            <div class="container">

                @if ($product->image)
                    <img class="card-img-top img-fluid mx-auto my-3" style="max-width: 100%" src="{{ asset('storage/' . $product->image) }}" alt="product-image">
                @else
                    <img class="card-img-top img-fluid mx-auto my-3" style="max-width: 100%" src="{{ asset('img/no_product_image_default.jpg') }}" alt="product-image">
                @endif

            </div>

            <div class="container p-3">

                <div class="text-primary">Name:</div>
                <h1 class="text-left font-weight-bold text-capitalize mb-4">{{$product->name}}</h1>

                <div class="text-primary">slug:</div>
                <h5 class="text-left mb-3">{{ $product->slug }}</h5>

                <div class="text-primary">Category:</div>
                <h5 class="text-left mb-3 text-capitalize">{{ $product->category }}</h5>


                <div class="text-primary">Displayed:</div>
                <p class="text-left text-capitalize">{{($product->displayed)?'displayed':'not displayed'}}</p>

                <div class="text-primary">Description:</div>
                <p class="text-left mb-3">{{ $product->description }}</p>

                <div class="text-primary">Price:</div>
                <h5 class="text-left">{{ $product->price }}</h5>
            </div>
        </div>




        {{-- <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <!-- <th scope="col">Image</th> -->
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Description</th>
                <th scope="col">Displayed</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->slug}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{($product->displayed)?'displayed':'not displayed'}}</td>
                    <td>{{$product->category}}</td>
                    <td>{{$product->price}}</td>
                </tr>
            </tbody>
        </table> --}}
    </div>
@endsection
