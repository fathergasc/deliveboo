@extends('layouts.app')

@section('content')
<section>
    <div class="product">
        <div class="header">
            <img class="product_image" src="{{ $product->image }}" alt="">
        </div>
        <div class="body">
            <h3 class="title">{{ $product->name }}</h3>
            <small>{{ $product->category }}</small>
            <p class="description">{{ $product->description }}</p>
            <p>{{ $product->price}}</p>
        </div>
    </div>
</section>
@endsection