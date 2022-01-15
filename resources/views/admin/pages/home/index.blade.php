@extends('admin.layouts.home-layout')
@section('page-content')
<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title">
			<span class="page-title-icon bg-gradient-primary text-white mr-2">
				<i class="mdi mdi-home"></i>
			</span> Dashboard
		</h3>
	</div>
	<div class="row justify-content-around">
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-danger card-img-holder text-white">
				<div class="card-body">
					<img src="{{asset('assets/admin/purpel_dashboard/images/dashboard/circle.svg')}}" class="card-img-absolute"
						alt="circle-image" />
					<h4 class="font-weight-normal mb-3">Admins<i class="mdi mdi-diamond mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">{{ $adminsNO }}</h2>
					<h6 class="card-text"></h6>
				</div>
			</div>
		</div>
		<div class="col-md-4 stretch-card grid-margin">
			<div class="card bg-gradient-success card-img-holder text-white">
				<div class="card-body">
					<img src="{{asset('assets/admin/purpel_dashboard/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image">
					<h4 class="font-weight-normal mb-3">Users<i class="mdi mdi-account-multiple mdi-24px float-right"></i>
					</h4>
					<h2 class="mb-5">{{ $usersNO }}</h2>
					<h6 class="card-text"></h6>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection()