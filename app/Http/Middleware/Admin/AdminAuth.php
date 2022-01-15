<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
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
		//?if a user is authenticated and he is an admin continue
		if($request->user() && $request->user()->is_admin)
			return $next($request);

		//?if an admin is not authenticated
		//then return un authorized response if it's and API request
		if($request->expectsJson()) return response(['error' => 'Un Authorized'], 403);
		//or redirect to admin login page 
		return redirect()->route('admin.loginPage');
	}
}
