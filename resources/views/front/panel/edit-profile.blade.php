@extends('layout.user-dashboard')
@section('title', 'Lance Master | Home Page')

@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="text-dark">Edit Profile</h3>
        </div>
        <div class="card-body row">
            <div class="col-md-8">
                <form action={{ route('user.updateProfile', $user->id) }} method="post">
                    @csrf

                    <div class="form-group row">
                        <label for="name"
                            class="col-md-3 col-form-label text-md-right text-left text-dark">{{ __('Name') }}</label>

                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') == '' ? $user->name : old('name') }}" required
                                autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email"
                            class="col-md-3 col-form-label text-md-right text-left text-dark">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') == '' ? $user->email : old('email') }}" required
                                autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_number"
                            class="col-md-3 col-form-label text-md-right text-left text-dark">{{ __('Phone Number') }}</label>

                        <div class="col-md-8">
                            <input id="phone_number" type="text"
                                class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                value="{{ old('phone_number') == '' ? $user->phone_number : old('phone_number') }}"
                                required>
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password"
                            class="col-md-3 col-form-label text-md-right text-left text-dark">{{ __('Password') }}</label>

                        <div class="col-md-8">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                autocomplete="new-password">
                            <span class="password-note" role="alert">
                                <strong>Leave the password field empty if you don't want it to update password </strong>
                            </span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary d-block m-auto">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
