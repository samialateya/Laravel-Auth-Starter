@extends('website.layouts.home-layout')
@section('page-content')
<div class="row w-100 m-0 justify-center">
	<div class="col-sm-8 col-md-6 mx-auto">
		<!-- form card -->
		<div class="card card-body">
			<!-- from text -->
			<h4>Update Profile Info</h4>
			<h6>Update basic information</h6>
			<!-- #from text -->
			<!-- success message -->
			@include('website.components.alerts.success')
			<!-- errror message -->
			@include('website.components.alerts.errors')
			<!-- from to update user infromation -->
			<form class="pt-3" method="post" action="{{ route('website.updateProfile') }}">
				@csrf
				<!-- user id -->
				<input type="hidden" name="id" value="{{auth()->user()->id}}">
				<!-- name -->
				<div class="pb-2">
					<input type="name" name="name" placeholder="Name" value="{{ auth()->user()->name }}" @class(['border-danger'=>
					$errors->has('name'), 'form-control', 'form-control-lg'])/>
					@error('name')
					<span class="text-danger mt-1 d-inline-block">{{$message}}</span>
					@enderror
				</div>
				<!-- password -->
				<div class="pb-2">
					<input type="password" name="password" placeholder="New Password" @class(['border-danger'=>
					$errors->has('password'),
					'form-control','form-control-lg'])/>
					@error('password')
					<span class="text-danger mt-1 d-inline-block">{{$message}}</span>
					@enderror
				</div>
				<!-- submit button -->
				<div class="mt-3">
					<button type="submit" class="btn w-100 btn-dark">Update Information</button>
				</div>
			</form>
			<!--#from update information -->
			<hr>
			<!-- from to update user avatar -->
			<form class="pt-3" method="post" action="{{ route('website.updateAvatar')}}" enctype="multipart/form-data">
				<h4>Update Profile Image</h4>
				<h6>Change your profile pictuer</h6>
				@csrf
				<!-- user id -->
				<input type="hidden" name="id" value="{{auth()->user()->id}}">
				<!-- image -->
				<div class="pb-2">
					<input type="file" name="avatar" placeholder="Select new profile image"  
						@class(['border-danger'=> $errors->has('avatar'), 'form-control', 'form-control-lg'])/>
					@error('avatar')
					<span class="text-danger mt-1 d-inline-block">{{$message}}</span>
					@enderror
				</div>
				<!-- submit button -->
				<div class="mt-3">
					<button type="submit" class="btn w-100 btn-dark">Update Image</button>
				</div>
			</form>
			<!--#from to update user avatar -->
			<hr>
			<!-- from to remove user avatar -->
			<form class="pt-3" method="post" action="{{ route('website.removeAvatar')}}" enctype="multipart/form-data">
				<h4>Remove Profile Image</h4>
				<h6>remove your profile pictuer</h6>
				@csrf
				<!-- user id -->
				<input type="hidden" name="id" value="{{auth()->user()->id}}">
				<!-- submit button -->
				<div class="mt-3">
					<button type="submit" class="btn w-100 btn-dark">Remove Image</button>
				</div>
			</form>
			<!--#from remove user avatar -->
		</div>
	</div>
</div>
@endsection