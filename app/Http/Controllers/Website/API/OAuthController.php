<?php

namespace App\Http\Controllers\Website\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User\Auth\LoginResource;
use App\Http\Requests\Website\API\Auth\GoogleLoginRequest;

class OAuthController extends Controller
{
	//* authenticate with google
	public function googleLogin(GoogleLoginRequest $request)
	{
		//*catch id token from request data
		$id_token = $request->id_token;
		//*get the client id from env file
		$client_id = env('GOOGLE_CLIENT_ID');
		//insatiate the google client instance
		$client = new \Google_Client(['client_id' => $client_id]);
		//verify the id token
		$userData = $client->verifyIdToken($id_token);

		//?if id token is invalid replay with error message
		if (!$userData) return response()->json(['message' => 'Invalid ID Token'], 401);

		//?else if the token is valid:
		//*authenticate user
		$user = $this->authenticateUser($userData, $request);
    //return response with authenticated user information
    return (new LoginResource($user))->response()->setStatusCode(200);
	}


	//*authenticate the user
	private function authenticateUser($OauthUserInfo, $requestData)
	{
		//*catch the user from database
		$user = User::where('email', $OauthUserInfo['email'])->first();
		//? create a new profile if the user is not exist in the database
		if (!$user) {
			//*create new user profile
			$user = User::create([
				'name' => $requestData->name ?? "un named user",
				'email' => $OauthUserInfo['email'],
			]);
			//*update the avatar if it's available from the request data
			if($requestData->avatar) $user->avatar = $requestData->avatar;
		}
		//?set email verified if the user is verified by google and not verified yet by us
		if ($OauthUserInfo['email_verified'] && !$user->email_verified_at) {
			$user->email_verified_at = now();
		}
		//*save the user information
		$user->save();
		//*authenticate the user
		Auth::login($user);
		//*return the user object
		return $user;
	}
}
