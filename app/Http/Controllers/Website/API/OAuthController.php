<?php

namespace App\Http\Controllers\Website\API;

use App\Models\User;
use Facebook\Facebook;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Facebook\Exceptions\FacebookSDKException;
use App\Http\Resources\User\Auth\LoginResource;
use Facebook\Exceptions\FacebookResponseException;
use App\Http\Requests\Website\API\Auth\GoogleLoginRequest;
use App\Http\Requests\Website\API\Auth\FacebookLoginRequest;

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

		//?else if the token is valid:authenticate authenticate user
		$user = $this->authenticateUser($request);
    //return response with authenticated user information
    return (new LoginResource($user))->response()->setStatusCode(200);
	}

	//* authenticate with facebook
	public function facebookLogin(FacebookLoginRequest $request){
		//*catch access token from request data
		$access_token = $request->access_token;
		//*get the app id and app secret from env file
		$app_secret = env('FACEBOOK_APP_SECRET');
		$app_id = env('FACEBOOK_APP_ID');
		//insatiate the facebook client instance
		$fb = new Facebook([
			'http_client_handler' => 'stream',
			'app_id' => $app_id,
			'app_secret' => $app_secret,
			'default_graph_version' => 'v2.10'
		]);
		//*get the user data from facebook and verify the access token
		try {
			$response = $fb->get('/me', $access_token);
		} 
		//?When Graph returns an error
		catch (FacebookResponseException $e) {
			return response()->json(['error' => 'Invalid Access Token'], 401);
		} 
		//?When validation fails or other local issues
		catch (FacebookSDKException $e) {
			return response()->json(['error' => 'failed to verify the Access Token '], 500);
		}

		//*authenticate user
		$user = $this->authenticateUser($request);
		//return response with authenticated user information
		return (new LoginResource($user))->response()->setStatusCode(200);
	}


	//*authenticate the user
	private function authenticateUser($requestData)
	{
		//*catch the user from database
		$user = User::where('email', $requestData->email)->first();
		//? create a new profile if the user is not exist in the database
		if (!$user) {
			//*create new user profile
			$user = User::create([
				'name' => $requestData->name ?? "un named user",
				'email' => $requestData->email,
			]);
			//*update the avatar if it's available from the request data
			if($requestData->avatar) $user->avatar = $requestData->avatar;
		}
		//?set email verified if the user is verified by google and not verified yet by us
		if (!$user->email_verified_at) {
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
