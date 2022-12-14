@extends('layouts.app')

@section('content')
<div class="container table-responsive">
    <a href="{{route('admin.products.create')}}" class="btn btn-secondary my-1">Add Product</a>
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Displayed</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <th scope="row">
                        @if ($product->image)
                            <div class="product-index-wrapper">
                                <img class="cover-img-index" src="{{ asset('storage/' . $product->image) }}" alt="">
                            </div>

                        @else
                        <div class="product-index-wrapper">
                            <img class="cover-img-index" src="{{ asset('img/no_product_image_default.jpg') }}" alt="">
                        </div>
                        @endif
                    </th>
                    <td>{{$product->name}}</td>
                    <td>{{Str::limit($product->description, 30)}}</td>
                    <td>{{($product->displayed)?'displayed':'not displayed'}}</td>
                    <td>{{$product->category}}</td>
                    <td>${{$product->price}}</td>
                    <td class="d-flex flex-wrap">
                        <a class="btn btn-warning m-1" href="{{route('admin.products.show', ['product' => $product->slug])}}">Show</a>
                        <a class="btn btn-primary m-1" href="{{route('admin.products.edit', ['product' => $product->slug])}}">Edit</a>
                        <form action="{{route('admin.products.destroy', ['product' => $product->slug])}}" method="post" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger m-1">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
