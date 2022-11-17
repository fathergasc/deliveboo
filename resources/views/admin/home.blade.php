@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="container">
    <h1 class="text-center">Welcome to your dashboard, {{$user = Auth::user()->name}}</h1>.
</div>

<div class="container">
    <div class="panel-body inf-content">
        <div class="row justify-content-center">
            <div class="col-md-4 m-3">
                <div class="restaurant-img-wrapper">
                    @if($restaurant->image)
                    <img alt="" title="" class="img-circle img-thumbnail isTooltip" src="{{ asset('storage/' . $restaurant->image) }}">
                    @else
                    <img alt="" title="" class="img-circle img-thumbnail isTooltip" src="{{ asset('img/restaurant-picture-default.png') }}">
                    @endif
                </div>


                <form action="{{route('admin.restaurants.update', ['restaurant' => $restaurant->slug])}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <label class="mt-1" for="image">Restaurant Image</label>
                    <input type="file" name="image" id="image" class="form-control-file mb-3 @error('image') is-invalid @enderror"
                    accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <button type="submit" class="btn btn-primary">Update</button>
                </form>

            </div>
            <div class="col-md-6 p-3">
                <strong class="pl-1 mt-2">INFORMATION</strong><br>
                <div class="table-responsive">
                <table class="table table-user-information">
                    <tbody>
                        <tr>
                            <td>
                                <strong>
                                    Name
                                </strong>
                            </td>
                            <td class="text-primary">
                                {{ Auth::user()->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    Email
                                </strong>
                            </td>
                            <td class="text-primary">
                                {{ Auth::user()->email }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <span class="glyphicon glyphicon-calendar text-primary"></span>
                                    Subscription date
                                </strong>
                            </td>
                            <td class="text-primary">
                                {{ Auth::user()->created_at->format('Y-m-d') }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <span class="glyphicon glyphicon-calendar text-primary"></span>
                                    Modified
                                </strong>
                            </td>
                            <td class="text-primary">
                                {{ Auth::user()->updated_at->format('Y-m-d') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>

                <strong class="pl-1">YOUR RESTAURANT</strong><br>
                <div class="table-responsive">
                <table class="table table-user-information">
                    <tbody>
                        <tr>
                            <td>
                                <strong>
                                    Name
                                </strong>
                            </td>
                            <td class="text-primary">
                                {{ $restaurant->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    Address
                                </strong>
                            </td>
                            <td class="text-primary">
                                {{ $restaurant->address }}
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <b>
                                    Cuisines
                                </b>
                            </td>
                            <td>
                                @foreach($cuisines as $cuisine)
                                    {{ucfirst($cuisine->name)}};
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
    </div>




@endsection
