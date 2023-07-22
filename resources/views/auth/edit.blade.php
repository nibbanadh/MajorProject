@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit User Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update.user') }}" aria-label="{{ __('Reset Password') }}" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-6">
                                <div class="card">
                                    @if(!empty($user->avatar))
                                        <img id="avatar" src="{{ asset($user->avatar) }}" class="card-img-top" style="height:90px; width:90px; margin-left: 34%;border-radius:50%;">
                                    @else
                                    <img id="avatar" src="{{ asset('public/frontend/images/avatar_profile.png') }}" class="card-img-top" style="height:90px; width:90px; margin-left: 34%;border-radius:50%;">
                                    @endif
                                    <div class="card-body">
                                        <input type="file" id="image" class="file-input" name="image" onchange="readURL(this);">
                                    </div>
                                </div>

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{$user->phone}}" required>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Profile') }}
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
                    <img id="side_avatar" src="{{ asset(Auth::user()->avatar) }}" class="card-img-top" style="height:90px; width:90px; margin-left: 34%;border-radius:50%;">
                @else
                <img id="side_avatar" src="{{ asset('public/frontend/images/avatar_profile.png') }}" class="card-img-top" style="height:90px; width:90px; margin-left: 34%;border-radius:50%;">
                @endif
                <div class="card-body">
                    <h5 class="card-title text-center">{{ Auth::user()->name }}</h5>
                </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"> <a href="{{ route('password.change') }}">Change Password</a></li>
                            <li class="list-group-item"><a href="{{ route('success.orderlist') }}">Return Order</a></li>
                        </ul>

                <div class="card-body">
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </div>


            </div>
        </div>
    </div>
</div>
<script>
    function readURL(input) {
        if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#avatar')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);
                $('#side_avatar')
                    .attr('src', e.target.result)
                    .width(80)
                    .height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
