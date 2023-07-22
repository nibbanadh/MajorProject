@extends('layouts.app')

@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_responsive.css') }}">

    <div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 offset-lg-1" style="border: 1px solid grey; padding: 20px; border-radius: 25px;">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Sign In</div>

						<form action="{{ route('login') }}" id="login_form" method="post">
							@csrf
							<div class="form-group">
                                <label for="exampleInputEmail1">Email or Phone</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" aria-describedby="emailHelp" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
							<div class="contact_form_button text-center">
								<button type="submit" class="btn btn-info">Login</button>
							</div>
                             
						</form>
                        <br>
                        <div class="text-center">
                            <a href="{{ route('password.request') }}">I forgot my password</a>
                        </div>
                        
                        <br><br>
                        <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-primary btn-block"><i class="fab fa-facebook"></i> Login with Facebook</a>
                        <a href="{{ url('/auth/redirect/google') }}" class="btn btn-danger btn-block"><i class="fab fa-google"></i> Login with Google</a>

					</div>
				</div>

                <div class="col-lg-5 offset-lg-1" style="border: 1px solid grey; padding: 20px; border-radius: 25px;">
					<div class="contact_form_container">
						<div class="contact_form_title text-center">Sign Up</div>

						<form action="{{ route('register') }}" id="signup_form" method="post">
                            @csrf
							
							<div class="form-group">
                                <label for="exampleInputEmail1">Full Name</label>
                                <input type="text" class="form-control @error('register_name') is-invalid @enderror" name="register_name" value="{{ old('register_name') }}" aria-describedby="emailHelp" placeholder="Enter Full Name" required>
                                @error('register_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phone</label>
                                <input type="text" class="form-control @error('register_phone') is-invalid @enderror" name="register_phone" value="{{ old('register_phone') }}" aria-describedby="emailHelp" placeholder="Enter Phone Number" required>
                                @error('register_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" class="form-control @error('register_email') is-invalid @enderror" name="register_email" value="{{ old('register_email') }}" aria-describedby="emailHelp" placeholder="Enter Email Address" required>
                                @error('register_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" class="form-control @error('register_password') is-invalid @enderror" name="register_password" aria-describedby="emailHelp" placeholder="Enter Password" required>
                                @error('register_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                <input type="password" class="form-control" name="register_password_confirmation" aria-describedby="emailHelp" placeholder="Re-Type Password" required>
                            </div>
							<div class="contact_form_button text-center"><br>
								<button type="submit" class="btn btn-info">Sign Up</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	</div>
@endsection
