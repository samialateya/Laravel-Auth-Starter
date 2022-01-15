@extends('admin.layouts.home-layout')
@section('page-content')
<div class="content-wrapper">
	<div class="page-header">
		<h3 class="page-title">
			<span class="page-title-icon bg-gradient-primary text-white mr-2">
				<i class="mdi mdi-account-multiple"></i>
			</span> Admins
		</h3>
	</div>
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="d-flex justify-content-between">
						<h4 class="card-title">Admins List</h4>
						@can('create',App\Models\User::class)
						<a href="{{ route('admin.admins.addAdminPage') }}">
							<label class="badge badge-primary cp">
								<h5 class="m-0 h6">Add New admin <i class="mdi mdi-plus-circle-outline"></i></h5>
							</label>
						</a>
						@endcan
					</div>
					<!-- success admin -->
					@include('admin.components.alerts.success')
					<table class="table table-responsive-xl">
						<thead>
							<tr>
								<th>N.O</th>
								<th>Name</th>
								<th>Email</th>
								<th>Role</th>
								<th>Join Date</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($admins as $key => $admin)
							{{-- dont show current logged in admin in the admins list --}}
							@continue($admin->id == auth()->id())
							<tr>
								<td>{{ $key}}</td>
								<td>{{ $admin->name }}</td>
								<td>{{ $admin->email }}</td>
								<td>{{ $admin->adminType->name }}</td>
								<td>{{ $admin->created_at->diffForHumans() }}</td>
								<td>
									@can('update',$admin)
									<!-- update -->
									<a href="{{ route('admin.admins.updateAdminPage', $admin->id) }}">
										<label class="badge badge-info cp">Update <i class="mdi mdi-lead-pencil"></i></label>
									</a> | 
									<!-- Toggle statu -->
									<a href="#" data-toggle="modal" data-target="#changeStatus{{$admin->id}}">
										<label class="badge {{ $admin->is_active ? 'badge-success' : 'badge-gradient-dark' }} cp">
											{{ $admin->is_active ? 'Active' : 'Blocked' }} 
											<i class="mdi {{ $admin->is_active ? 'mdi-pocket' : 'mdi-cancel'}}"></i>
										</label>
									</a> | 
									<!-- delete -->
									<a href="#" data-toggle="modal" data-target="#confirmDelete{{$admin->id}}">
										<label class="badge badge-danger cp">Delete <i class="mdi mdi-delete"></i></label>
									</a>
									@endcan
								</td>
							</tr>

							<!-- confirm delete modal -->
							@include('admin.components.alerts.confirm',[
								'path'=>'admin.admins.deleteAdmin',
								'message'=>"are you sure to delete ".$admin->name,
								'confirmText'=>'Delete',
								'btnClass'=>'btn-danger',
								'modal_id'=>"confirmDelete$admin->id",
								'data'=>[
									['key'=>'id','value'=>$admin->id],
									['key'=>'','value'=>'']
								]
							])
							<!-- #confirm delete -->

							<!-- confirm change status modal -->
							@include('admin.components.alerts.confirm',[
								'path'=>'admin.admins.toggleAdminStatus',
								'message'=>$admin->is_active ? "Block $admin->name" : "Activate $admin->name",
								'confirmText'=>$admin->is_active ? 'Block' : 'Activate',
								'btnClass'=> $admin->is_active ? 'btn-danger' : 'btn-success',
								'modal_id'=>"changeStatus$admin->id",
								'data'=>[
									['key'=>'id','value'=>$admin->id],
									['key'=>'','value'=>'']
								]
							])
							<!-- #confirm change status modal -->
							@endforeach
						</tbody>
					</table>
					<!-- pagination links -->
					<div class="mt-4">
						{{ $admins->links("pagination::bootstrap-4") }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection