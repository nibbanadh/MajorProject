@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change Your Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.change.update') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="oldpass" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                            <div class="col-md-6">
                                <input id="oldpass" type="password" class="form-control{{ $errors->has('oldpass') ? ' is-invalid' : '' }}" name="oldpass" value="{{ $oldpass ?? old('oldpass') }}" required autofocus>

                                @if ($errors->has('oldpass'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('oldpass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                @if(!empty(Auth::user()->avatar))
                    <img id="avatar" src="{{ asset(Auth::user()->avatar) }}" class="card-img-top" style="height:90px; width:90px; margin-left: 34%;border-radius:50%;">
                @else
                <img id="avatar" src="{{ asset('public/frontend/images/avatar_profile.png') }}" class="card-img-top" style="height:90px; width:90px; margin-left: 34%;border-radius:50%;">
                @endif
                <div class="card-body">
                    <h5 class="card-title text-center">{{ Auth::user()->name }}</h5>
                </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="{{ route('edit.user') }}">Edit Profile</a></li>
                            <li class="list-group-item"><a href="{{ route('success.orderlist') }}">Return Order</a></li>
                        </ul>

                <div class="card-body">
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection
