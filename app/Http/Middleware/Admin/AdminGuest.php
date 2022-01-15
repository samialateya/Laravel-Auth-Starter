<?php

namespace App\Http\Middleware\Admin;

use Closure;
use Illuminate\Http\Request;

class AdminGuest
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
			//check if current user is authenticated and he/she is an admin
			if($request->user() && $request->user()->isAdmin())
				return redirect()->route('admin.homePage');
      return $next($request);
    }
}
