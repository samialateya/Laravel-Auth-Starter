<?php

namespace App\Http\Controllers\Admin\API;

use App\Models\User;
use App\Models\AdminType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Admins\AdminResource;
use App\Http\Resources\Admin\Admins\AdminCollection;
use App\Http\Resources\Admin\Admins\AdminTypeResource;
use App\Http\Requests\Admin\API\Admins\AddAdminRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Admin\API\Admins\UpdateAdminRequest;
use App\Http\Requests\Admin\API\Admins\UpdatePasswordRequest;

class AdminsController extends Controller
{
	//fetch list of all admin roles
	public function rolesList()
	{
		$roles = AdminType::OrderBy('name', 'ASC')->get();
		return AdminTypeResource::collection($roles);
	}

	//fetch list of all admins
	public function adminsList()
	{
		$admins = User::where('id', '<>', auth()->id())->where('is_admin', true)->orderBy('name')->paginate(10);
		return new AdminCollection($admins);
	}

	//fetch single admin information 
	public function adminInfo($id)
	{
		try {
			$admins = User::where('id', $id)->where('is_admin', true)->firstOrFail();
			return new AdminResource($admins);
		} catch (ModelNotFoundException $e) {
			return response(['error' => 'admin not found'], 404);
		}
	}

	//update profile information
	public function addAdmin(AddAdminRequest $request)
	{
		//catch admin name, email and admin type ID
		$adminData = $request->safe()->only(['email', 'name', 'admin_type']);
		//attach the encrypted password to user data
		$adminData['password'] = bcrypt($request->password);
		//set the user to be an admin
		$adminData['is_admin'] = true;
		//save user data to database
		User::create($adminData);
		return response(['message' => 'admin created'], 200);
	}

	//update profile information
	public function updateAdminInfo(UpdateAdminRequest $request)
	{
		try {
			$admin = User::where('id', $request->id)->where('is_admin', true)->firstOrFail();
			//apply authorization check
			abort_unless($this->authorize('update', $admin), 403);
			$request->name ? $admin->name = $request->name : '';
			$request->email ? $admin->email = $request->email : '';
			$admin->admin_type ? $admin->admin_type = $request->admin_type : '';
			$admin->save();
			return response(['message' => 'admin information updated successfully'], 200);
		} catch (ModelNotFoundException $e) {
			return response(['error' => 'admin not found'], 404);
		}
	}

	//update password
	public function updatePassword(UpdatePasswordRequest $request)
	{
		try {
			$admin = User::where('id', $request->id)->where('is_admin', true)->firstOrFail();
			//apply authorization check
			abort_unless($this->authorize('update', $admin), 403);
			$admin->password = bcrypt($request->password);
			$admin->save();
			return response(['message' => 'password updated successfully'], 200);
		} catch (ModelNotFoundException $e) {
			return response(['error' => 'admin not found'], 404);
		}
	}


	//Activate admin account
	public function activateAdminAccount($adminID)
	{
		try {
			$admin = User::where('id', $adminID)->where('is_admin', true)->firstOrFail();
			//apply authorization check
			abort_unless($this->authorize('update', $admin), 403);
			$admin->is_active = true;
			$admin->save();
			return response(['message' => 'admin account is activated successfully'], 200);
		} catch (ModelNotFoundException $e) {
			return response(['error' => 'admin not found'], 404);
		}
	}

	//block admin account
	public function blockAdminAccount($adminID)
	{
		try {
			$admin = User::where('id', $adminID)->where('is_admin', true)->firstOrFail();
			//apply authorization check
			abort_unless($this->authorize('update', $admin), 403);
			$admin->is_active = false;
			$admin->save();
			return response(['message' => 'admin account is blocked successfully'], 200);
		} catch (ModelNotFoundException $e) {
			return response(['error' => 'admin not found'], 404);
		}
	}

	//delete admin
	public function deleteAdmin(Request $request)
	{
		try {
			$admin = User::where('id', $request->id)->where('is_admin', true)->firstOrFail();
			//apply authorization check
			abort_unless($this->authorize('delete', $admin), 403);
			$admin->delete();
			return response(['message' => 'admin account is deleted successfully'], 200);
		} catch (ModelNotFoundException $e) {
			return response(['error' => 'admin not found'], 404);
		}
	}
}
