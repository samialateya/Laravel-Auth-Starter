<nav class="navbar navbar-expand-sm navbar-light bg-light">
	<div class="container-fluid">
		<a class="navbar-brand" href="{{ route('website.homePage') }}">Navbar</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="{{ route('website.homePage') }}">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{ route('website.profilePage') }}">Profile</a>
				</li>
			</ul>
			
			<form class="d-flex" method="post" action="{{ route('website.logout')}}">
				@csrf
				<button class="btn btn-dark" type="submit">Logout</button>
			</form>
		</div>
	</div>
</nav>