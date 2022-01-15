<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
	<!-- navbar brand -->
	<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
		<!-- desktop logo -->
		<a class="navbar-brand brand-logo" href="{{ route('admin.homePage') }}"><img src="{{asset('assets/admin/purpel_dashboard/images/logo.svg')}}" alt="logo" /></a>
		<!-- mobile logo -->
		<a class="navbar-brand brand-logo-mini" href="{{ route('admin.homePage') }}"><img src="{{asset('assets/admin/purpel_dashboard/images/logo-mini.svg')}}" alt="logo" /></a>
	</div>
	<!-- #navbar brand -->
	<!-- navbar menu -->
	<div class="navbar-menu-wrapper d-flex align-items-stretch">
		<!-- minimize button -->
		<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
			<span class="mdi mdi-menu"></span>
		</button>
		<!-- right menu -->
		<ul class="navbar-nav navbar-nav-right">
			<!-- profile dropdown -->
			<li class="nav-item nav-profile dropdown">
				<a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
					<!-- avatar -->
					<div class="nav-profile-img">
						<img src="{{auth()->user()->getAvatarLink()}}" alt="image">
						<span class="availability-status online"></span>
					</div>
					<!-- admin name -->
					<div class="nav-profile-text">
						<p class="mb-1 text-black">{{ auth()->user()->name }}</p>
					</div>
				</a>
				<!-- profile dropdown options-->
				<div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
					<!-- profile page -->
					<a class="dropdown-item" href="{{ route('admin.updateProfilePage') }}">
						<i class="mdi mdi-cached mr-2 text-success"></i> Update Profile</a>
					<div class="dropdown-divider"></div>
					<!-- signout button -->
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
						<i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
				</div>
				<!-- #profile dropdown options-->
			</li>
			<!-- #profile dropdown -->
			<!-- full screen -->
			<li class="nav-item d-none d-lg-block full-screen-link">
				<a class="nav-link">
					<i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
				</a>
			</li>

			<!-- logout button -->
			<li class="nav-item nav-logout d-none d-lg-block">
				<a href="#" class="nav-link" data-toggle="modal" data-target="#logoutModal">
					<i class="mdi mdi-power"></i>
				</a>
			</li>
		</ul>
		<!-- #right menu -->
		<!--toggle sidebar menu in mobile view-->
		<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
			data-toggle="offcanvas">
			<span class="mdi mdi-menu"></span>
		</button>
	</div>
	<!-- #navbar menu -->
</nav>


<!-- confirm logout modal -->
@include('admin.components.alerts.confirm',
	[
		'path'=>'admin.logout',
		'confirmText'=>'Logout',
		'btnClass' => 'btn-danger',
		'message'=>'are you sure you to logout?',
		'modal_id'=>'logoutModal',
	])
<!-- #confirm modal -->