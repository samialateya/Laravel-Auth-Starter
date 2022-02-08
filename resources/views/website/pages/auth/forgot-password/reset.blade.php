@extends('website.layouts.auth-layout')
@section('page-content')
<!-- form card -->
<div class="card card-body">
	<!-- from text -->
	<h1 class="text-black-50">Auth Starter</h1>
	<h4>Create a new password</h4>
	<h6>fill and confirm your new password</h6>
	<!-- #from text -->
	<!-- success message -->
	@include('website.components.alerts.success')
	<!-- errror message -->
	@include('website.components.alerts.errors')
	<!-- from -->
	<form class="pt-3" method="post" action="{{ route('website.password.update') }}">
		@csrf
		<!-- token -->
		<input type="hidden" name="token" value="{{ $token }}">
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
			<input type="password" name="password" placeholder="Add your new password" 
				@class(['border-danger'=> $errors->has('password'),'form-control','form-control-lg'])/>
			@error('password')
			<span class="text-danger mt-1 d-inline-block">{{$message}}</span>
			@enderror
		</div>
		<!-- password Confirmation-->
		<div class="pb-2">
			<input type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Confirm your password" />
		</div>
		<!-- submit button -->
		<div class="mb-3">
			<button type="submit" class="btn w-100 btn-dark">Update Password</button>
		</div>
		<!-- from footer -->
		<div class="my-2 d-flex justify-content-between align-items-center">
			<!-- login link-->
			<a href="{{route('website.loginPage')}}" class="text-black">Reteurn to login</a>
			<!-- register link -->
			<a href="{{route('website.registerPage')}}" class="text-black">Dont have account?</a>
		</div>
		<!--#from footer -->
	</form>
	<!--#from-->
</div>
@endsection