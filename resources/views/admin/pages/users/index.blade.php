@extends('admin.layouts.home-layout')
@section('page-content')
<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title">
			<span class="page-title-icon bg-gradient-primary text-white mr-2">
				<i class="mdi mdi-account-multiple"></i>
			</span> users
		</h3>
	</div>
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<h4 class="card-title">Users List</h4>
					</div>
					<!-- success user -->
					@include('admin.components.alerts.success')
					<table class="table table-responsive-xl">
						<thead>
							<tr>
								<th>N.O</th>
								<th>Name</th>
								<th>Email</th>
								<th>Avatar</th>
								<th>Email Status</th>
								<th>Join Date</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($users as $key => $user)
							<tr>
								<td>{{++$key}}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>
									<a href="#" data-toggle="modal" data-target="#imageViewerModal{{$user->id}}">
										<label class="badge badge-primary cp">Image <i class="mdi mdi-image-multiple"></i></label>
									</a>
								</td>
								<td>{{ $user->email_verified_at ? 'Verified' : 'Not verified' }}</td>
								<td>{{ $user->created_at->diffForHumans() }}</td>
								<td>
									@can('update',$user)
									<!-- change statu -->
									<a href="#" data-toggle="modal" data-target="#changeStatus{{$user->id}}">
										<label class="badge {{ $user->is_active ? 'badge-success' : 'badge-gradient-dark' }} cp">
											{{ $user->is_active ? 'Active' : 'Blocked' }} 
											<i class="mdi {{ $user->is_active ? 'mdi-pocket' : 'mdi-cancel'}}"></i>
										</label>
									</a> | 
									<!-- delete user -->
									<a href="#" data-toggle="modal" data-target="#confirmDelete{{$user->id}}">
										<label class="badge badge-danger cp">Delete <i class="mdi mdi-delete"></i></label>
									</a>
									@endcan
								</td>
							</tr>

							<!-- confirm delete modal -->
							@include('admin.components.alerts.confirm',[
								'path'=>'admin.users.deleteUser',
								'message'=>"are you sure to delete ".$user->name,
								'confirmText'=>'Delete',
								'btnClass'=>'btn-danger',
								'modal_id'=>"confirmDelete$user->id",
								'data'=>[
									['key'=>'id','value'=>$user->id],
									['key'=>'','value'=>'']
								]
							])
							<!-- #confirm delete -->

							<!-- confirm change status modal -->
							@include('admin.components.alerts.confirm',[
								'path'=>'admin.users.toggleUserStatus',
								'message'=>$user->is_active ? "Block $user->name" : "Activate $user->name",
								'confirmText'=>$user->is_active ? 'Block' : 'Activate',
								'btnClass'=> $user->is_active ? 'btn-danger' : 'btn-success',
								'modal_id'=>"changeStatus$user->id",
								'data'=>[
									['key'=>'id','value'=>$user->id],
									['key'=>'','value'=>'']
								]
							])
							<!-- #confirm change status modal -->

							<!-- view user image Modal -->
							@include('admin.components.alerts.image-viewer',[
							'src'=>$user->getAvatarLink(),
							'modal_id'=>"imageViewerModal$user->id",
							])
							<!-- #image viewer modal -->
							@endforeach
						</tbody>
					</table>
					<div class="mt-4">
						{{ $users->links("pagination::bootstrap-4") }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection