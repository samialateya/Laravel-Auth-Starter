@extends('admin.layouts.home-layout')
@section('page-content')
<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title">
			<span class="page-title-icon bg-gradient-primary text-white mr-2">
				<i class="mdi mdi-settings"></i>
			</span> Update {{ $admin->name }} information
		</h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin.admins.listPage') }}">All Admins</a></li>
			</ol>
		</nav>
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
					<form method="post" action="{{ route('admin.admins.updateAdmin') }}">
						@csrf
						<!-- admin id -->
						<input type="hidden" name="id" value="{{$admin->id}}">
						<!-- email -->
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" class="form-control" name="email" placeholder="Your email"
								value="{{$admin->email}}">
							@error('email')
							<span class="text-danger mt-1">{{$message}}</span>
							@enderror
						</div>
						<!-- name -->
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" class="form-control" name="name" placeholder="Your Name"
								value="{{$admin->name}}">
							@error('name')
							<span class="text-danger mt-1">{{$message}}</span>
							@enderror
						</div>
						<!--Admin Type -->
						<div class="form-group">
							<label>Admin Type</label>
							<select class="form-control" name="admin_type" required>
								@foreach ($adminTypes as $type)
								<option value="{{$type->id}}" {{ $admin->admin_type == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
								@endforeach
							</select>
							@error('admin_type')
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
					<form method="post" action="{{ route('admin.admins.updatePassword') }}">
						@csrf
						<!-- admin id -->
						<input type="hidden" name="id" value="{{$admin->id}}">
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