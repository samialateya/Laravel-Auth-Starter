@extends('website.layouts.auth-layout')
@section('page-content')
<!-- form card -->
<div class="card card-body">
	<!-- from text -->
	<h4>Email Verified</h4>
	<h6>Your email is verified</h6>
	<!-- #from text -->
	<!-- success message -->
	@include('website.components.alerts.success')
	<!-- errror message -->
	@include('website.components.alerts.errors')
	<!-- submit button -->
	<div class="mt-3">
		<a href="{{ route('website.homePage') }}"class="btn w-100 btn-dark">Proceed To Home Page</a>
	</div>
	<!--#from-->
</div>
@endsection