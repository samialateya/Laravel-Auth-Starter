<?php

namespace App\Http\Controllers\Website\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Http\Resources\User\Auth\LoginResource;
use App\Http\Requests\Website\API\Auth\LoginRequest;
use App\Http\Requests\Website\API\Auth\RegisterRequest;

class AuthController extends Controller
{
  //login
	public function login(LoginRequest $request){
		//retrieve safe validated data
		$safeCredentials = $request->safe()->toArray();
		//check the credentials just against regular user not the admin
		$safeCredentials['is_admin'] = false;
		//check if user is not blocked by the admin
		$safeCredentials['is_active'] = true;
		//attempt to login and check the credentials 
		if (Auth::attempt($safeCredentials, $request->remember)) {
			//return response with current user information
			$user = User::where('email', $request->email)->first();
			return new LoginResource($user);
		}
		//when invalid credentials
		return response(['error' => 'Invalid credentials'],401);
	}

	//register
	public function register(RegisterRequest $request){
		//catch user name and email
		$userData = $request->safe()->only(['email', 'name']);
		//attach the encrypted password to user data
		$userData['password'] = bcrypt($request->password);
		//save user data to database
		User::create($userData);
		//redirect back to login page
		return response(['message' => 'user account created successfully'], 201);
	}


	//verify user email and send reset password link
	public function sendResetPasswordLink(Request $request)
	{
		//validate email input
		$request->validate(['email' => 'required|email']);
		//redirect back with error if this email is for an admin account or is not exists
		$user = User::where('email', $request->email)->first();
		if (!$user || $user->is_admin) return response(['error' => "this email is not linked with any account"], 406);

		//use laravel Password facade to get user model by email and sends the link
		$resetLinkStatus = Password::sendResetLink($request->only('email'));
		//return response
		return $resetLinkStatus === Password::RESET_LINK_SENT
		? response(['message' => "verification link sent to your email"], 200)
		: response(['error' => "this email is not linked with any account"], 206);
	}


	//send email verification link
	public function sendVerificationEmail(Request $request)
	{
		//send the verification link to authenticated user email address
		$request->user()->sendEmailVerificationNotification();
		//redirect user back
		return response(['message' => 'Verification link sent successfully'], 200);
	}

	//log user out and revoke current token
	public function logout(Request $request)
	{
		//delete user token
		$request->user()->currentAccessToken()->delete();
		return response(['message' => 'success'], 200);
	}
}
