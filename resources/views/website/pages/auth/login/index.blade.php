@extends('website.layouts.auth-layout')
@section('page-content')
<!-- form card -->
<div class="card card-body">
	<!-- from text -->
	<h1 class="text-black-50">Auth Starter Login</h1>
	<h4>Hello! let's get started</h4>
	<h6>Sign in to continue.</h6>
	<!-- #from text -->
	<!-- success message -->
	@include('website.components.alerts.success')
	<!-- errror message -->
	@include('website.components.alerts.errors')
	<!-- from -->
	<form class="pt-3" method="post" action="{{ route('website.login') }}">
		@csrf
		<!-- email -->
		<div class="pb-2">
			<input type="email" name="email" placeholder="Email" value="{{old('email')}}"
			 @class(['border-danger'=> $errors->has('email'), 'form-control', 'form-control-lg'])/>
			@error('email')
			<span class="text-danger mt-1 d-inline-block">{{$message}}</span>
			@enderror
		</div>
		<!-- password -->
		<div class="pb-2">
			<input type="password" name="password" placeholder="Password"
				@class(['border-danger'=> $errors->has('password'), 'form-control','form-control-lg'])/>
			@error('password')
			<span class="text-danger mt-1 d-inline-block">{{$message}}</span>
			@enderror
		</div>
		<!-- submit button -->
		<div class="mt-3">
			<button type="submit" class="btn btn-block btn-dark">SIGN IN</button>
		</div>
		<!-- from footer -->
		<div class="my-2 d-flex justify-content-between align-items-center">
			<!-- remember me -->
			<div class="form-check">
				<label class="text-muted">
					<input type="checkbox" class="form-check-input" name="remember"> Keep me signed in 
				</label>
			</div>
			<!-- forget password -->
			<a href="{{route('website.password.request')}}" class="text-black">Forgot password?</a>
		</div>
		<!--#from footer -->
		<!-- register link -->
		<div class="text-center font-weight-light"> Don't have an account?
			<a href="{{route('website.registerPage')}}" class="text-primary">Create</a>
		</div>
		<!--#register link -->
		<!-- social login -->
		<h6 class="mt-4 text-center">Or continue with</h6>
		<div class="d-flex justify-content-around mt-2">
			<a href="{{ route('website.social.redirect',['google']) }}" class="btn btn-block btn-danger">Google</a>
			<a href="{{ route('website.social.redirect',['google']) }}" class="btn btn-block btn-primary">Facebook</a>
		</div>
		<!--#social login -->
	</form>
	<!--#from-->
</div>
@endsection