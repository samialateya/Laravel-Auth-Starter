<?php

namespace App\Http\Controllers\Website\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Website\Web\Profile\UpdateAvatarRequest;
use App\Http\Requests\Website\Web\Profile\UpdateProfileRequest;

class ProfileController extends Controller
{
  //render profile page
	public function profilePage(){
		return view('website.pages.profile.index');
	}

	//render update profile page
	public function updateProfilePage(){
		return view('website.pages.profile.update.index');
	}

	//update profile
	public function updateProfile(UpdateProfileRequest $request){
		$user = User::findOrFail($request->id);
		$user->name = $request->name;
		$request->password ? $user->password = bcrypt($request->password) : '';
		$user->save();
		return redirect()->back()->with(['success'=>'profile updated successfully']);
	}

	//update avatar
	public function updateAvatar(UpdateAvatarRequest $request){
		//catch user
		$user = User::findOrFail($request->id);
		//TODO upload the new picture
		//create a unique name for the avatar before storing it
		$avatarName = time().'_'.$request->avatar->getClientOriginalName();
		//save the picture to disk
		$request->avatar->move(public_path(User::AVATAR_DISK_PATH), $avatarName);

		//TODO remove the old picture if its exists
		//?remove the image from the desk if the avatar is not taken from social media account
		if($user->avatar && strpos($user->avatar, 'http') === false)
			unlink(public_path(User::AVATAR_DISK_PATH).$user->avatar);
	
		//TODO store uploaded avatar name in to users table
		$user->avatar = $avatarName;
		$user->save();

		//redirect the user to profile page
		return redirect()->route('website.profilePage');
	}

	//remove avatar
	public function removeAvatar(Request $request){
		//catch user
		$user = User::findOrFail($request->id);
		//TODO remove the old picture if its exists
		//?remove the image from the desk if the avatar is not taken from social media account
		if($user->avatar && strpos($user->avatar, 'http') === false)
			unlink(public_path(User::AVATAR_DISK_PATH) . $user->avatar);
		//TODO set avatar name to null in to users table
		$user->avatar = null;
		$user->save();
		//redirect the user to profile page
		return redirect()->route('website.profilePage');
	}
}
