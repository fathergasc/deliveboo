@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Welcome to your dashboard, {{$user = Auth::user()->name}}</h1>.
</div>


@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@endsection
