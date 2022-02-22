<?php

namespace App\Http\Controllers\Website\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
	//*redirect to OAuth provider login page
	public function redirectToProvider($provider)
	{
		//check for a provider
		switch ($provider) {
			case 'google':
				return Socialite::driver('google')->redirect();
				break;
			case 'facebook':
				return Socialite::driver('facebook')->redirect();
				break;
			default:
				return redirect()->route('website.homePage');
				break;
		}
	}

	//*execute OAuth provider login logic
	public function handleProviderCallback($provider)
	{
		//check for a provider and get user data
		$user = [];
		$OAuthDriver = "";
		switch ($provider) {
			case 'google':
				$user = Socialite::driver('google')->user();
				$OAuthDriver = "google";
				break;
			case 'facebook':
				$user = Socialite::driver('facebook')->user();
				$OAuthDriver = "facebook";
				break;
		}
		$this->authenticateUser($user, $OAuthDriver);
		//*redirect user to home page after authentication is done
		return redirect()->route('website.homePage');
	}

	//*authenticate the user
	private function authenticateUser(Object $OauthUserInfo, String $OAuthDriver):void
	{
		//*catch the user from database
		$user = User::where('email', $OauthUserInfo->email)
			->orWhere('google_id', $OauthUserInfo->id)
			->orWhere('facebook_id', $OauthUserInfo->id)
			->first();
		//? create a new profile if the user is not exist in the database
		if (!$user) {
			//*create new user profile
			$user = User::create([
				'name' => $OauthUserInfo->name,
				'email' => $OauthUserInfo->email,
			]);
			//*update the avatar
			$user->avatar = $OauthUserInfo->avatar;
		}
		//*update user Oauth driver id
		$user->{$OAuthDriver . '_id'} = $OauthUserInfo->id;
		//?set email verified if the user is verified by google and not verified yet by us
		if (isset($OauthUserInfo->user['verified_email']) && !$user->email_verified_at) {
			$user->email_verified_at = now();
		}
		//*save the user information
		$user->save();
		//*authenticate the user
		Auth::login($user);
	}
}
