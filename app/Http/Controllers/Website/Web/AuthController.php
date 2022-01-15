<?php

namespace App\Http\Controllers\Website\Web;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\Website\Web\Auth\LoginRequest;
use App\Http\Requests\Website\Web\Auth\RegisterRequest;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Requests\Website\Web\Auth\UpdatePasswordRequest;

class AuthController extends Controller
{

	/*
	|--------------------------------------------------------------------------
	| Session-base Authentication Controller
	|--------------------------------------------------------------------------
	*/

  //redirect user to login page
	public function loginPage(){
		return view('website.pages.auth.login.index');
	}

	//Authenticated and log user in
	public function login(LoginRequest $request){
		//retrieve safe validated data
		$safeCredentials = $request->safe()->toArray();
		//check the credentials just against regular user not the admin
		$safeCredentials['is_admin'] = false;
		//check if user is not blocked by the admin
		$safeCredentials['is_active'] = true;
		//attempt to login and check the credentials 
		if(Auth::attempt($safeCredentials,$request->remember)){
			//redirect user to home page
			return redirect()->route('website.homePage');
		}
		//when invalid credentials
		return redirect()->back()->with(['error'=>'Incorrect credentials'])->withInput();
	}

	//redirect user to register page
	public function registerPage(){
		return view('website.pages.auth.register.index');
	}

	//register a new user
	public function register(RegisterRequest $request){
		//catch user name and email
		$userData = $request->safe()->only(['email','name']);
		//attach the encrypted password to user data
		$userData['password'] = bcrypt($request->password);
		//save user data to database
		User::create($userData);
		//redirect back to login page
		return redirect()->route('website.loginPage')->with(['success' => 'your account created successfully login now']);
	}

	//logout
	public function logout(){
		Auth::logout();
		//redirect user to login page
		return redirect()->route('website.loginPage');
	}


	//---------------------- email verification methods --------------------------------

	// show a notice page to inform the user that he/she must verify his/her email
	public function verificationNotice(){
		return view('website.pages.auth.email-verification.notice');
	}

	//handle and accept the verification link sent by user
	public function acceptVerificationLink(EmailVerificationRequest $request){
		//? This EmailVerificationRequest will automatically take care of validating the request's id and hash parameters.

		//call fulfill method will mark email as verified
		$request->fulfill();

		//redirect user to home page
		return view('website.pages.auth.email-verification.email-verified');
	}

	//send email verification link
	public function sendVerificationEmail(Request $request){
		//send the verification link to authenticated user email address
		$request->user()->sendEmailVerificationNotification();
		//redirect user back
		return back()->with('success', 'Verification link sent!');
	}





	//--------------------------- Reset Password --------------------------------
	//#verify user email and send reset password link
	public function sendResetPasswordLink(Request $request){
		//validate email input
		$request->validate(['email' => 'required|email']);
		//redirect back with error if this email is for an admin account or is not exists
		$user = User::where('email',$request->email)->first();
		if (!$user || $user->is_admin) return back()->withErrors(['email' => "this email is not linked with any account"]);

		//use laravel Password facade to get user model by email and sends the link
		$resetLinkStatus = Password::sendResetLink($request->only('email'));
		//return response
		return $resetLinkStatus === Password::RESET_LINK_SENT
		? back()->with(['success' => "verification link sent to your email"])
		: back()->withErrors(['email' => "can not found this email"]);
	}

	//#redirect user to page for enter new password
	public function newPasswordPage($token) {
		return view('website.pages.auth.forgot-password.reset', ['token' => $token]);
	}

	//#update password
	public function updatePassword(UpdatePasswordRequest $request) {
		//get password reset required data from the user
		$userData = $request->only('email', 'password', 'password_confirmation', 'token');
		//redirect back with error if this email is for an admin account or is not exists
		$user = User::where('email', $userData['email'])->first();
		if(!$user || $user->is_admin) return back()->withErrors(['email' => "this email is not linked with any account"]);

		$updatePasswordStatus = Password::reset($userData, function ($user, $newPassword){
			//write the new password to users table
			$user->forceFill([
				'password' => Hash::make($newPassword)
			])->setRememberToken(Str::random(60));
			$user->save();

			//dispatch password changed event
			event(new PasswordReset($user));
		});
		//return response to user
		return $updatePasswordStatus === Password::PASSWORD_RESET
		? redirect()->route('website.login')->with('success', "Password updated successfully")
		: back()->withErrors(['email' => "invalid token"]);
	}
}
