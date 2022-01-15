<?php

namespace App\Notifications\EmailVerification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\VerifyEmail;

class VerifyEmailQueued extends VerifyEmail implements ShouldQueue
{
  use Queueable;

	//this notification class just used to queue sending email verification

	/**
	 * To setup queue worker :
	 * 1- php artisan queue:table php artisan migrate
	 * 2- set the queue connection to use the database QUEUE_CONNECTION=database
	 * 3- php artisan queue:work
	 * this notification will save a job in the jobs table 
	 * laravel queue worker will dispatch those jobs in the background
	 */
}
