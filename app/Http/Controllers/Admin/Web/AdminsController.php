<?php

namespace App\Http\Controllers\Admin\Web;

use App\Models\User;
use App\Models\AdminType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Web\Admins\AddAdminRequest;
use App\Http\Requests\Admin\Web\Admins\UpdateAdminRequest;
use App\Http\Requests\Admin\Web\Auth\UpdatePasswordRequest;

class AdminsController extends Controller
{
	//show list of all admins
	public function adminsListPage(){
		$admins = User::where('is_admin',true)->orderBy('name')->paginate(10);
		return view('admin.pages.admins.index', ['admins' => $admins]);
	}

	//show a page for adding new admin
	public function addAdminPage(){
		//apply authorization check
		abort_unless($this->authorize('create',User::class),403);
		$adminTypes = AdminType::all();
		return view('admin.pages.admins.add-admin', ['adminTypes' => $adminTypes]);
	}

	//add new admin
	public function addAdmin(AddAdminRequest $request){
		//apply authorization check
		abort_unless($this->authorize('create', User::class), 403);
		//catch admin name, email and admin type ID
		$adminData = $request->safe()->only(['email', 'name', 'admin_type']);
		//attach the encrypted password to user data
		$adminData['password'] = bcrypt($request->password);
		//set the user to be an admin
		$adminData['is_admin'] = true;
		//save user data to database
		User::create($adminData);
		//redirect back to login page
		return redirect()->back()->with(['success' => 'new admin is created successfully']);
	}

	//show page to update admin information
	public function updateAdminPage(User $admin){
		//apply authorization check
		abort_unless($this->authorize('update', $admin), 403);
		$adminTypes = AdminType::all();
		return view('admin.pages.admins.update-admin', ['admin' => $admin, 'adminTypes' => $adminTypes]);
	}

	//update admin basic information
	public function updateAdmin(UpdateAdminRequest $request)
	{
		$admin = User::findOrFail($request->id);
		//apply authorization check
		abort_unless($this->authorize('update', $admin), 403);
		$admin->name = $request->name;
		$admin->email = $request->email;
		$admin->admin_type = $request->admin_type;
		$admin->save();
		return redirect()->back()->with(['success' => 'admin info updated successfully']);
	}

	//update admin password
	public function updatePassword(UpdatePasswordRequest $request)
	{
		$admin = User::findOrFail($request->id);
		//apply authorization check
		abort_unless($this->authorize('update', $admin), 403);
		$admin->password = bcrypt($request->password);
		$admin->save();
		return redirect()->back()->with(['success' => 'password updated successfully']);
	}

	//delete admin
	public function deleteAdmin(Request $request){
		$admin = User::findOrFail($request->id);
		//apply authorization check
		abort_unless($this->authorize('update', $admin), 403);
		$admin->delete();
		return redirect()->back()->with(['success' => 'admin deleted successfully']);
	}


	// toggle admin status
	public function toggleAdminStatus(Request $request){
		$admin = User::findOrFail($request->id);
		//apply authorization check
		abort_unless($this->authorize('update', $admin), 403);
		$admin->is_active = !$admin->is_active;
		$admin->save();
		return redirect()->back()->with(['success' => 'admin status was changed successfully']);
	}

}
