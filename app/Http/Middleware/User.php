<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class User
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next)
	{
		//redirect admin session to user login page
		if($request->user() && $request->user()->isAdmin()){
			//clear admin session
			auth()->logout();
			//redirect user to login page
			return redirect()->route('website.loginPage');
		}
		return $next($request);
	}
}
