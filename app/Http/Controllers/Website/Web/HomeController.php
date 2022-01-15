<?php

namespace App\Http\Controllers\Website\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /*
	|--------------------------------------------------------------------------
	| Website Home Page Controller
	|--------------------------------------------------------------------------
	*/

	//redirect user to home page
	public function homePage(){
		return view('website.pages.home.index');
	}
}
