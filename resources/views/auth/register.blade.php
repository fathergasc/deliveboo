@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <h5 class="text-center">User Info</h5>

                            <!-- name input -->
                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus required maxlength="255"
                                        placeholder="Please, enter your full name" />

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- email input -->
                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" required maxlength="255"
                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" v-model="email"
                                        placeholder="Please, enter your email address" />

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- password input -->
                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        value="{{ old('password') }}" autocomplete="new-password" required minlength="8"
                                        v-model="password" placeholder="Enter a password at least 8 characters long" />

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- confirm password input -->
                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password" required minlength="8"
                                        v-model="passwordConfirm" placeholder="Confirm your previously entered password" />
                                </div>
                            </div>

                            <!-- vat number input -->
                            <div class="form-group row">
                                <label for="vat_number" class="col-md-4 col-form-label text-md-right">Vat Number</label>

                                <div class="col-md-6">
                                    <input id="vat_number" type="text"
                                        class="form-control @error('vat_number') is-invalid @enderror" name="vat_number"
                                        value="{{ old('vat_number') }}" required minlength="11" maxlength="11"
                                        placeholder="Please, enter your VAT identification number ">

                                    @error('vat_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <h5 class="text-center">Restaurant Info</h5>

                            <!-- restaurant name -->
                            <div class="form-group row">
                                <label for="restaurant_name" class="col-md-4 col-form-label text-md-right">Restaurant
                                    Name</label>

                                <div class="col-md-6">
                                    <input id="restaurant_name" type="text"
                                        class="form-control @error('restaurant_name') is-invalid @enderror"
                                        name="restaurant_name" value="{{ old('restaurant_name') }}" required maxlength="70"
                                        placeholder="Please, enter your restaurant's name">

                                    @error('restaurant_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- restaurant address -->
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control " name="address"
                                        value="{{ old('address') }}" required maxlength="80"
                                        placeholder="Please, enter your restaurant's address">

                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- restaurant cuisine -->
                            <div class="form-group row">
                                <label for="cuisines" class="col-md-4 col-form-label text-md-right">Restaurant
                                    cuisine</label>

                                <div class="col-md-6">
                                    @foreach ($cuisines as $cuisine)
                                        <div class="form-group form-check">

                                            <input {{ in_array($cuisine->id, old('cuisines', [])) ? 'checked' : '' }}
                                                name="cuisines[]" type="checkbox" class="form-check-input @error('cuisines') is-invalid @enderror"
                                                id="cuisine_{{ $cuisine->id }}" value="{{ $cuisine->id }}">

                                            <label class="form-check-label"
                                                for="tag_{{ $cuisine->id }}">{{ ucfirst($cuisine->name) }}</label>
                                        </div>
                                    @endforeach

                                    @error('cuisines')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- submit button -->
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" id="submit-btn" @click="submitCheck">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
