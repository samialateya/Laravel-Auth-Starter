<!-- sidebar -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<!-- avatar -->
		<li class="nav-item nav-profile">
			<a href="#" class="nav-link">
				<div class="nav-profile-image">
					<img src="{{ auth()->user()->getAvatarLink() }}" alt="profile">
					<span class="login-status online"></span>
				</div>
				<div class="nav-profile-text d-flex flex-column">
					<span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
					<span class="text-secondary text-small">{{ auth()->user()->adminType->name ?? 'super admin' }}</span>
				</div>
				<i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
			</a>
		</li>
		<!-- dashboard -->
		<li class="nav-item">
			<a class="nav-link" href="{{ route('admin.homePage') }}">
				<span class="menu-title">Dashboard</span>
				<i class="mdi mdi-home menu-icon"></i>
			</a>
		</li>
		<!-- admins -->
		<li class="nav-item">
			<a class="nav-link" href="{{ route('admin.admins.listPage') }}">
				<span class="menu-title">Admins</span>
				<i class="mdi mdi-account-key menu-icon"></i>
			</a>
		</li>
		<!-- users -->
		<li class="nav-item">
			<a class="nav-link" href="{{ route('admin.users.listPage') }}">
				<span class="menu-title">Users</span>
				<i class="mdi mdi-account-group-outline menu-icon"></i>
			</a>
		</li>
	</ul>
</nav>