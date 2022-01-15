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
	<!-- ===================== main content ======================================= -->
	<div class="row w-100 h100vh m-0 align-items-center justify-center bg-light">
		<div class="col-sm-8 col-md-6 col-lg-4 mx-auto">
			@yield('page-content')
		</div>
	</div>
</body>

</html>