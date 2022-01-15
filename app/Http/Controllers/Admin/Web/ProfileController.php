<?php

namespace App\Http\Controllers\Admin\Web;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Web\Auth\UpdateProfileRequest;
use App\Http\Requests\Admin\Web\Auth\UpdatePasswordRequest;

class ProfileController extends Controller
{
	//render update profile page
	public function updateProfilePage(){
		return view('admin.pages.profile.update.index');
	}

	//update profile
	public function updateProfile(UpdateProfileRequest $request){
		$admin = User::findOrFail($request->id);
		$admin->name = $request->name;
		$admin->email = $request->email;
		$admin->save();
		return redirect()->back()->with(['success'=>'profile updated successfully']);
	}

	//update password
	public function updatePassword(UpdatePasswordRequest $request)
	{
		$admin = User::findOrFail($request->id);
		$admin->password = bcrypt($request->password);
		$admin->save();
		return redirect()->back()->with(['success' => 'password updated successfully']);
	}
}
