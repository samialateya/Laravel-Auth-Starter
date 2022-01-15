<?php

namespace App\Http\Controllers\Website\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\Profile\UserResource;
use App\Http\Requests\Website\API\Profile\UpdateAvatarRequest;
use App\Http\Requests\Website\API\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
	//get profile information for current authenticated user
	public function getProfileInfo()
	{
		return new UserResource(auth()->user());
	}

	//update profile information
	public function updateProfile(UpdateProfileRequest $request)
	{
		$user = User::findOrFail(auth()->id());
		$request->name ? $user->name = $request->name : '';
		$request->password ? $user->password = bcrypt($request->password) : '';
		$user->save();
		return response(['message' => 'profile updated successfully'], 200);
	}

	//update avatar
	public function updateAvatar(UpdateAvatarRequest $request)
	{
		//catch user
		$user = User::findOrFail(auth()->id());
		//TODO upload the new picture
		//create a unique name for the avatar before storing it
		$avatarName = time() . '_' . $request->image->getClientOriginalName();
		//save the picture to disk
		$request->image->move(public_path(User::AVATAR_DISK_PATH), $avatarName);

		//TODO remove the old picture if its exists
		$user->avatar ? unlink(public_path(User::AVATAR_DISK_PATH) . $user->avatar) : '';

		//TODO store uploaded avatar name in to users table
		$user->avatar = $avatarName;
		$user->save();

		return response(['message' => 'Profile has been updated successfully'], 200);
	}

	//remove avatar
	public function removeAvatar()
	{
		//catch user
		$user = User::findOrFail(auth()->id());
		//TODO remove the old picture if its exists
		$user->avatar ? unlink(public_path(User::AVATAR_DISK_PATH) . $user->avatar) : '';
		//TODO set avatar name to null in to users table
		$user->avatar = null;
		$user->save();
		return response(['message' => 'Profile image has been removed successfully'], 200);
	}
}
