@extends('admin.layouts.home-layout')
@section('page-content')
<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title">
			<span class="page-title-icon bg-gradient-primary text-white mr-2">
				<i class="mdi mdi-account-multiple"></i>
			</span> Admins
		</h3>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin.admins.listPage') }}">All Admins</a></li>
			</ol>
		</nav>
	</div>
	<div class="row">
		<!-- Hero Section -->
		<div class="col-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Add Admin</h4>
					<p class="card-description"> </p>
					<!-- success message -->
					@include('admin.components.alerts.success')
					<!-- errror message -->
					@include('admin.components.alerts.errors')
					<form class="forms-sample" method="post" action="{{ route('admin.admins.addAdmin') }}"
						enctype="multipart/form-data">
						@csrf
						<!-- name -->
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" placeholder="add admin name" required
								value="{{old('name')}}">
							@error('name')
							<span class="text-danger mt-1">{{$message}}</span>
							@enderror
						</div>
						<!-- Email -->
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" placeholder="Email" required
								value="{{old('email')}}">
							@error('email')
							<span class="text-danger mt-1">{{$message}}</span>
							@enderror
						</div>
						<!--Admin Type -->
						<div class="form-group">
							<label>Admin Type</label>
							<select class="form-control" name="admin_type" required>
								@foreach ($adminTypes as $type)
									<option value="{{$type->id}}" {{ old('admin_type') == $type->id ? 'selected' : ''}}>{{$type->name}}</option>
								@endforeach
							</select>
							@error('admin_type')
							<span class="text-danger mt-1">{{$message}}</span>
							@enderror
						</div>
						<!-- password -->
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password" placeholder="add admin password" required>
							@error('password')
							<span class="text-danger mt-1">{{$message}}</span>
							@enderror
						</div>
						<!-- password confirmation -->
						<div class="form-group">
							<label>Password Confirmation</label>
							<input type="password" class="form-control" name="password_confirmation" placeholder="re enter the password" required>
						</div>
						<button type="submit" class="btn btn-gradient-primary mr-2">Add</button>
					</form>
				</div>
			</div>
		</div>
		<!-- #Hero Section -->
	</div>
</div>
@endsection