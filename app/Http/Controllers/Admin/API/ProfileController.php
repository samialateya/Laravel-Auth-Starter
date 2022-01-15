<?php

namespace App\Http\Controllers\Admin\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Profile\ProfileResource;
use App\Http\Requests\Admin\API\Auth\UpdateProfileRequest;
use App\Http\Requests\Admin\API\Auth\UpdatePasswordRequest;

class ProfileController extends Controller
{
	//get profile information for current authenticated admin
	public function getProfileInfo()
	{
		return new ProfileResource(auth()->user());
	}

	//update profile information
	public function updateProfile(UpdateProfileRequest $request)
	{
		$admin = User::findOrFail(auth()->id());
		$request->name ? $admin->name = $request->name : '';
		$request->email ? $admin->email = $request->email : '';
		$admin->save();
		return response(['message' => 'profile updated successfully'], 200);
	}

	//update password
	public function updatePassword(UpdatePasswordRequest $request)
	{
		$admin = User::findOrFail(auth()->id());
		$admin->password = bcrypt($request->password);
		$admin->save();
		return response(['message' => 'password updated successfully'], 200);
	}
}
