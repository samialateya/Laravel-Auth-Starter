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
			default:
				return redirect()->route('website.homePage');
				break;
		}
	}

	//*execute OAuth provider login logic
	public function handleProviderCallback($provider)
	{
		//check for a provider
		switch ($provider) {
			case 'google':
				$user = Socialite::driver('google')->user();
				//*authenticate user
				$this->authenticateUser($user);
				//*redirect user to home page
				return redirect()->route('website.homePage');
				break;
			default:
				return redirect()->route('website.homePage');
				break;
		}
	}

	//*authenticate the user
	private function authenticateUser($OauthUserInfo)
	{
		//*catch the user from database
		$user = User::where('google_id', $OauthUserInfo->id)->orWhere('email', $OauthUserInfo->email)->first();
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
		//*update user google auth info
		$user->google_id = $OauthUserInfo->id;
		$user->google_token = $OauthUserInfo->token;
		$user->refresh_token = $OauthUserInfo->refreshToken;
		//?set email verified if the user is verified by google and not verified yet by us
		if ($OauthUserInfo->user['verified_email'] && !$user->email_verified_at) {
			$user->email_verified_at = now();
		}
		//*save the user information
		$user->save();
		//*authenticate the user
		Auth::login($user);
	}
}
