@extends('website.layouts.auth-layout')
@section('page-content')
<!-- form card -->
<div class="card card-body">
	<!-- from text -->
	<h4>Email Confirmation</h4>
	<h6>You must verify your email to be able to continue</h6>
	<!-- #from text -->
	<!-- success message -->
	@include('website.components.alerts.success')
	<!-- errror message -->
	@include('website.components.alerts.errors')
	<!-- from -->
	<form class="pt-3" method="post" action="{{ route('verification.send') }}">
		@csrf
		<!-- submit button -->
		<div class="mt-3">
			<button type="submit" class="btn w-100 btn-dark">Send Verfication Email</button>
		</div>
	</form>
	<!--#from-->
</div>
@endsection