<?php

namespace App\Models;

use App\Models\AdminType;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EmailVerification\VerifyEmailQueued;

class User extends Authenticatable implements MustVerifyEmail 
{
	
	use HasApiTokens, HasFactory, Notifiable;

	const AVATAR_HTTP_PATH = "assets/uploads/user/profile/";
	const AVATAR_DISK_PATH = "assets\\uploads\\user\\profile\\"; //for linux use "/" instead of "\"

	const ADMIN_TYPES_ID = [
		'super_admin' => 1,
		'editor' => 2
	];
	protected $fillable = [
		'name',
		'email',
		'password',
		'is_admin',
		'admin_type',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	//to eager load admin types when we fetch User Model from Auth Facades
	protected $with = ['adminType'];

	//returns user's profile image
	public function getAvatarLink(){
		//if a user uploads an image
		if($this->avatar)
			//return the path of the image
			return asset(self::AVATAR_HTTP_PATH.$this->avatar);
		else
			//return the default avatar
			return asset(self::AVATAR_HTTP_PATH.'default.svg');
	}

	//check if current user is an administrator
	public function isAdmin(){
		//it may seems useless but think of it, if the logic of choosing the admin is changed
		//you just need to edit the function only ^_*
		return $this->is_admin;
	}

	// define the relation with admin type table
	public function adminType(){
		return $this->belongsTo(AdminType::class, 'admin_type');
	}

	/**
	 * to queue verification email to be able to sending it in background :
	 * first we create @VerifyEmailQueued notification class that will be queued
	 * @VerifyEmailQueued will extends the default @VerifyEmail notification class setup by laravel for sending the verification
	 * lastly we need to tell the user model to use our @VerifyEmailQueued notification class for sending verification email
	 */
	
	public function sendEmailVerificationNotification()
	{
		$this->notify(new VerifyEmailQueued);
	}
}
