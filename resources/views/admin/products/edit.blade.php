@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-warning">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif



    <form action="{{route('admin.products.update', ['product' => $product->slug])}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <a class="btn btn-primary mb-3" href="{{ route('admin.products.index') }}">Back to products list</a>

        <div class="form-group mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{old('name', $product->name)}}"
            required maxlength="100">

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror"
            >{{old('description', $product->description)}}</textarea>

            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{old('category', $product->category)}}"
            maxlength="70">

            @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" step="0.1" value="{{old('price', $product->price)}}"
            required min="0" max="9999">

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="displayed" class="form-label">Display product</label>
            <select class="form-control @error('displayed') is-invalid @enderror" id="displayed" name="displayed"
            required>
                <option value="0" {{ (old('displayed', $product->displayed ) == 0)? 'selected':'' }}>Hidden</option>
                <option value="1" {{ (old('displayed', $product->displayed ) == 1)? 'selected':'' }}>Displayed</option>
            </select>
            @error('displayed')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="image">Product Image</label>
            @if ($product->image)
                <img class="d-block image-fluid mb-4" src="{{ asset('storage/' . $product->image) }}" alt="">
            @else
                <span class="d-block mb-3">No image for product</span>
            @endif

            <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror"
            accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-danger my-4 " {{ ($product->image == null)?'disabled':'' }} onclick="event.preventDefault(); document.getElementById('deleteProductImage').submit()">Delete Image</button>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    {{-- hidden form to delete an uploaded image, forms can't be inside other forms --}}
    <form action="{{ route('admin.products.deleteProductImage', ['product' => $product]) }}" method="POST" class="d-none" id="deleteProductImage">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete Product Image</button>
    </form>
</div>

@endsection
