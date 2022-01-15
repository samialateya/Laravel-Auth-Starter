<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin - Dashboard</title>
	<!-- ================ Purple Dashboard CSS Files ============================= -->
	<!-- plugins:css -->
	<link rel="stylesheet" href="{{ asset('assets/admin/purpel_dashboard/vendors/mdi/css/materialdesignicons.min.css')}}">
	<link rel="stylesheet" href="{{ asset('assets/admin/purpel_dashboard/vendors/css/vendor.bundle.base.css')}}">
	<!-- Layout styles -->
	<link rel="stylesheet" href="{{ asset('assets/admin/purpel_dashboard/css/style.css')}}">

	<!-- ========= Custom CSS To Apply For All Pages That Extends This Layout ======= -->
	<!-- // link any custom CSS you want to apply -->

	<!-- ========== CSS Section To Allow Pages To Include Custom CSS Files ================ -->
	@yield('css')
	<!-- End layout styles -->
	<link rel="shortcut icon" href="{{ asset('assets/admin/purpel_dashboard/images/favicon.ico')}}"/>
</head>
<body>
	<!-- ===================== main content ======================================= -->
	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-center auth">
				@yield('page-content')
			</div>
		</div>
	</div>


	<!-- ================ Purple Dashboard JS Files ============================= -->
	<!-- plugins:js -->
	<script src="{{asset('assets/admin/purpel_dashboard/vendors/js/vendor.bundle.base.js')}}"></script>
	<!-- inject:js -->
	<script src="{{asset('assets/admin/purpel_dashboard/js/off-canvas.js')}}"></script>
	<script src="{{asset('assets/admin/purpel_dashboard/js/hoverable-collapse.js')}}"></script>
	<script src="{{asset('assets/admin/purpel_dashboard/js/misc.js')}}"></script>
	
	<!-- ========= Custom JS To Apply For All Pages That Extends This Layout ======= -->
	<!-- // link any custom JS you want to apply -->
	
	<!-- ========== JS Section To Allow Pages To Include Custom JS Files ================ -->
	@yield('JS')
</body>
</html>