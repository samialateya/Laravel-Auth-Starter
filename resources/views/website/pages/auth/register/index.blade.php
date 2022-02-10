@extends('website.layouts.auth-layout')
@section('page-content')
<!-- form card -->
<div class="card card-body">
	<!-- from text -->
	<h1 class="text-black-50">Auth Starter Register</h1>
	<h4>Hello! let's get started</h4>
	<h6>Sign in to continue.</h6>
	<!-- #from text -->
	<!-- success message -->
	@include('website.components.alerts.success')
	<!-- errror message -->
	@include('website.components.alerts.errors')
	<!-- from -->
	<form class="pt-3" method="post" action="{{ route('website.register') }}">
		@csrf
		<!-- name -->
		<div class="pb-2">
			<input type="text" name="name" placeholder="Name" value="{{old('name')}}" @class(['border-danger'=>
			$errors->has('name'), 'form-control', 'form-control-lg'])/>
			@error('name')
			<span class="text-danger mt-1 d-inline-block">{{$message}}</span>
			@enderror
		</div>
		<!-- email -->
		<div class="pb-2">
			<input type="email" name="email" placeholder="Email" value="{{old('email')}}" @class(['border-danger'=>
			$errors->has('email'), 'form-control', 'form-control-lg'])/>
			@error('email')
			<span class="text-danger mt-1 d-inline-block">{{$message}}</span>
			@enderror
		</div>
		<!-- password -->
		<div class="pb-2">
			<input type="password" name="password" placeholder="Password" @class(['border-danger'=> $errors->has('password'),
			'form-control','form-control-lg'])/>
			@error('password')
			<span class="text-danger mt-1 d-inline-block">{{$message}}</span>
			@enderror
		</div>
		<!-- password confirmation -->
		<div class="pb-2">
			<input type="password" name="password_confirmation" placeholder="Confirm your password" class="form-control form-control-lg"/>
		</div>
		<!-- submit button -->
		<div class="mt-3">
			<button type="submit" class="btn btn-block btn-dark">Register</button>
		</div>
		<!-- from footer -->
		<div class="text-center font-weight-light mt-3"> Allready have account?
			<a href="{{route('website.loginPage')}}" class="text-primary">login</a>
		</div>
		<!-- from footer -->
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