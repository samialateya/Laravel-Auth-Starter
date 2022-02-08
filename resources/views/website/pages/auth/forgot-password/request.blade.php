@extends('website.layouts.auth-layout')
@section('page-content')
<!-- form card -->
<div class="card card-body">
	<!-- from text -->
	<h1 class="text-black-50">Auth Starter</h1>
	<h4>Reset Password</h4>
	<h6>Fill your email address to reset your password</h6>
	<!-- #from text -->
	<!-- success message -->
	@include('website.components.alerts.success')
	<!-- errror message -->
	@include('website.components.alerts.errors')
	<!-- from -->
	<form class="pt-3" method="post" action="{{ route('website.password.sendLink') }}">
		@csrf
		<!-- email -->
		<div class="pb-2">
			<input type="email" name="email" placeholder="Email" value="{{old('email')}}" @class(['border-danger'=>
			$errors->has('email'), 'form-control', 'form-control-lg'])/>
			@error('email')
			<span class="text-danger mt-1 d-inline-block">{{$message}}</span>
			@enderror
		</div>
		<!-- submit button -->
		<div class="mb-3">
			<button type="submit" class="btn w-100 btn-dark">Reset Pssword</button>
		</div>
		<!-- from footer -->
		<div class="my-2 d-flex justify-content-between align-items-center">
			<!-- login link-->
			<a href="{{route('website.loginPage')}}" class="text-black">Return to login</a>
			<!-- register link -->
			<a href="{{route('website.registerPage')}}" class="text-black">Dont have account?</a>
		</div>
		<!--#from footer -->
	</form>
	<!--#from-->
</div>
@endsection