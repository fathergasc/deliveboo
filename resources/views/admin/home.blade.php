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
        <div class="row">
            <div class="col-md-4">
                @if($restaurant->image)
                <img alt="" title="" class="img-circle img-thumbnail isTooltip" src="{{ asset('storage/' . $restaurant->image) }}">
                @else
                <img alt="" title="" class="img-circle img-thumbnail isTooltip" src="https://dummyimage.com/300x300/ccc/000.png&text=No+picture">
                @endif

            </div>
            <div class="col-md-6">
                <strong>Information</strong><br>
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

                <strong>Your Restaurant</strong><br>
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
                    </tbody>
                </table>

            </div>



    </div>
    </div>




@endsection
