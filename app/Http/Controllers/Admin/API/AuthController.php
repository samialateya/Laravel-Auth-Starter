<?php

namespace App\Http\Controllers\Admin\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Admin\Auth\LoginResource;
use App\Http\Requests\Admin\API\Auth\LoginRequest;

class AuthController extends Controller
{
	//Authenticated and log user in
	public function login(LoginRequest $request)
	{
		//retrieve safe validated data
		$safeCredentials = $request->safe()->toArray();
		//check for user type
		$safeCredentials['is_admin'] = true;
		//check if user is not blocked by the admin
		$safeCredentials['is_active'] = true;
		//attempt to login and check the credentials 
		if (Auth::attempt($safeCredentials, $request->remember)) {
			//return response with current admin information
			$admin = User::where('email', $request->email)->first();
			return new LoginResource($admin);
		}
		//when invalid credentials
		return response(['error' => 'Invalid credentials'], 401);
	}

	//log user out and revoke current token
	public function logout(Request $request){
		//delete admin token
		$request->user()->currentAccessToken()->delete();
		return response(['message' => 'success'], 200);
	}
}
