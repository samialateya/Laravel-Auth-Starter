<?php

namespace App\Exceptions;

use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Handler extends ExceptionHandler
{
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var string[]
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var string[]
	 */
	protected $dontFlash = [
		'current_password',
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->reportable(function (Throwable $e) {
			//
		});

		$this->renderable(function (HttpException $e, $request) {
			//handle un verified email exceptions for api's
			$unVerifiedEmailMessage = "Your email address is not verified.";
			if ($request->is('api/*') && $e->getMessage() == $unVerifiedEmailMessage) {
				return response()->json([
					'error' => 'Un Verified Email'
				], 403);
			}
		});
		
		$this->renderable(function (AccessDeniedHttpException $e, $request) {
			//handle un authorized api requests
			if ($request->is('api/*')) {
				return response()->json([
					'error' => 'Un Authorized'
				], 403);
			}
		});
	}
}
