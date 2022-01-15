@extends('admin.layouts.home-layout')
@section('page-content')
	<div class="content-wrapper">
		<div class="page-header">
			<h3 class="page-title">
				<span class="page-title-icon bg-gradient-primary text-white mr-2">
					<i class="mdi mdi-settings"></i>
				</span> Update Profile
			</h3>
		</div>
		<div class="row">
			<!-- basic info -->
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Basic Information</h4>
						<p class="card-description"> Update basic information</p>
						<!-- success message -->
						@include('admin.components.alerts.success')
						<!-- errror message -->
						@include('admin.components.alerts.errors')
						<form method="post" action="{{ route('admin.updateProfile') }}">
							@csrf
							<!-- admin id -->
							<input type="hidden" name="id" value="{{auth()->user()->id}}">
							<!-- email -->
							<div class="form-group">
								<label for="email">Email</label>
								<input type="text" class="form-control" name="email" placeholder="Your email"
									value="{{auth()->user()->email}}">
								@error('email')
								<span class="text-danger mt-1">{{$message}}</span>
								@enderror
							</div>
							<!-- name -->
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" class="form-control" name="name" placeholder="Your Name" value="{{auth()->user()->name}}">
								@error('name')
								<span class="text-danger mt-1">{{$message}}</span>
								@enderror
							</div>
							<button type="submit" class="btn btn-gradient-primary mr-2">Update Information</button>
						</form>
					</div>
				</div>
			</div>
			<!-- #basic info -->
	
			<!-- password -->
			<div class="col-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<h4 class="card-title">Update Password</h4>
						<p class="card-description"> Create a new password</p>
						<form method="post" action="{{ route('admin.updatePassword') }}">
							@csrf
							<!-- admin id -->
							<input type="hidden" name="id" value="{{auth()->user()->id}}">
							<!-- password -->
							<div class="form-group">
								<label>New Password</label>
								<input type="password" class="form-control" name="password" placeholder="Create a new password">
								@error('password')
								<span class="text-danger mt-1">{{$message}}</span>
								@enderror
							</div>
							<!-- password confirmation -->
							<div class="form-group">
								<label>Confirm Password</label>
								<input type="password" class="form-control" name="password_confirmation"
									placeholder="Create a new password">
							</div>
							<button type="submit" class="btn btn-gradient-primary mr-2">Update Password</button>
						</form>
					</div>
				</div>
			</div>
			<!-- #password -->
		</div>
	</div>
@endsection()