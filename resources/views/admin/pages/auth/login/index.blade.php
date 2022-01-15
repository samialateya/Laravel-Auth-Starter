@extends('admin.layouts.auth-layout')
@section('page-content')
<div class="row flex-grow">
	<div class="col-lg-4 mx-auto">
		<div class="auth-form-light text-left p-5">
			<div class="brand-logo">
				<img src="{{asset('assets/admin/purpel_dashboard/images/logo.svg')}}" />
			</div>
			<h4>Hello! let's get started</h4>
			<h6 class="font-weight-light">Sign in to continue.</h6>
			<!-- success message -->
			@include('admin.components.alerts.success')
			<!-- errror message -->
			@include('admin.components.alerts.errors')
			<form class="pt-3" method="post" action="{{ route('admin.login') }}">
				@csrf
				<!-- email -->
				<div class="form-group">
					<input type="email" name="email"  placeholder="Email"
						value="{{old('email')}}" 
						@class(['border-danger' => $errors->has('email'), 'form-control', 'form-control-lg']) 
					/>
					@error('email')
					<span class="text-danger mt-2 d-inline-block">{{$message}}</span>
					@enderror
				</div>
				<!-- password -->
				<div class="form-group">
					<input type="password" name="password" 
						@class(['border-danger' => $errors->has('password'), 'form-control', 'form-control-lg']) 
						placeholder="Password"
					/>
					@error('password')
					<span class="text-danger mt-2 mt-2 d-inline-block">{{$message}}</span>
					@enderror
				</div>
				<!-- register link -->
				<div class="mt-3">
					<button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN
						IN</button>
				</div>
				<!-- remeber token -->
				<div class="my-2 d-flex justify-content-between align-items-center">
					<div class="form-check">
						<label class="form-check-label text-muted">
							<input type="checkbox" class="form-check-input" name="remember"> Keep me signed in </label>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection