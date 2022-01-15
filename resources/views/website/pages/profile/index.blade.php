@extends('website.layouts.home-layout')
@section('page-content')
<div class="w-100 row justify-content-center">
	<div class="card col-sm-8 col-md-6 col-lg-4 mx-auto">
		<img src="{{ auth()->user()->getAvatarLink() }}" class="card-img-top" alt="...">
		<div class="card-body">
			<h5 class="card-title">{{auth()->user()->name}}</h5>
			<h6 class="card-title">Email : {{auth()->user()->email}}</h6>
			<a href="{{ route('website.updateProfilePage') }}" class="btn btn-primary">Update profile</a>
		</div>
	</div>
</div>
@endsection