<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Auth Starter | User</title>
	<!-- ================ CSS Libraries ============================= -->
	<!-- bootstrap 5 -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<!-- ========= Custom CSS To Apply For All Pages That Extends This Layout ======= -->
	<!-- // link any custom CSS you want to apply -->
	<style>
		.h100vh {
			height: 100vh;
		}
	</style>
	<!-- ========== CSS Section To Allow Pages To Include Custom CSS Files ================ -->
	@yield('style')
</head>

<body>
	<!-- ===================== Navbar ======================================= -->
	@include('website.components.navbar')
	<!-- ===================== main content ======================================= -->
	<div class="container mt-4">
		@yield('page-content')
	</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>