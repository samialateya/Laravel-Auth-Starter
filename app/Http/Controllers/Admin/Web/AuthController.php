<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\Web\Auth\LoginRequest;

class AuthController extends Controller
{

	/*
	|--------------------------------------------------------------------------
	| Session-base Authentication Controller
	|--------------------------------------------------------------------------
	*/

  //redirect user to login page
	public function loginPage(){
		return view('admin.pages.auth.login.index');
	}

	//Authenticated and log user in
	public function login(LoginRequest $request){
		//retrieve safe validated data
		$safeCredentials = $request->safe()->toArray();
		//check for user type
		$safeCredentials['is_admin'] = true;
		//check if user is not blocked by the admin
		$safeCredentials['is_active'] = true;
		//attempt to login and check the credentials 
		if(Auth::attempt($safeCredentials,$request->remember)){
			//redirect user to home page
			return redirect()->route('admin.homePage');
		}
		//when invalid credentials
		return redirect()->back()->with(['error'=>'Incorrect credentials']);
	}


	//logout
	public function logout(){
		Auth::logout();
		//redirect user to login page
		return redirect()->route('admin.loginPage');
	}

}
