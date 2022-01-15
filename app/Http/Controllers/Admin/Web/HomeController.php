<?php

namespace App\Http\Controllers\Admin\Web;

use App\Models\User;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
  /*
	|--------------------------------------------------------------------------
	| Admin Home Page Controller
	|--------------------------------------------------------------------------
	*/

	//redirect user to home page
	public function homePage(){
		//get number of users
		$usersNO = User::where('is_admin',false)->count();
		//get number of admins
		$adminsNO = User::where('is_admin', true)->count();
		return view('admin.pages.home.index',['usersNO' => $usersNO, 'adminsNO' => $adminsNO]);
	}
}
