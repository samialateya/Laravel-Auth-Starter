<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\API\UsersController;
use App\Http\Controllers\Admin\API\AdminsController;
use App\Http\Controllers\Website\API\AuthController;
use App\Http\Controllers\Website\API\OAuthController;
use App\Http\Controllers\Website\API\ProfileController;
use App\Http\Controllers\Admin\API\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\API\ProfileController as AdminProfileController;

/*
|--------------------------------------------------------------------------
| website Routes
|--------------------------------------------------------------------------
*/
Route::prefix('user')->group(function () {
	//------------------- Authentication routes -----------------------;
	//login
	Route::post('/login', [AuthController::class, 'login']);
	//register
	Route::post('/register', [AuthController::class, 'register'])->name('register');
	//send reset password link
	Route::post('/forgot-password', [AuthController::class, 'sendResetPasswordLink']);
	//send email verification link
	Route::post('/verify-email', [AuthController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
	//logout
	Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
	//------------------- Social login -----------------------;
	//google login
	Route::post('/google-login', [OAuthController::class, 'googleLogin']);

	//------------------- Profile control routes -----------------------;
	Route::prefix('/profile')->middleware('auth:sanctum')->group(function () {
		//get profile information
		Route::get('/', [ProfileController::class, 'getProfileInfo']);
		Route::prefix('update')->middleware('verified')->group(function () { // access only by users that verified there emails
			//update profile
			Route::post('/', [ProfileController::class, 'updateProfile']);
			//update avatar picture
			Route::post('/change-avatar', [ProfileController::class, 'updateAvatar']);
			//remove avatar
			Route::post('/remove-avatar', [ProfileController::class, 'removeAvatar']);
		});
	});
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::name('admin.')->prefix('admin')->group(function () {
	//------------------- Authentication routes -----------------------;
	Route::name('auth.')->group(function () {
		//login
		Route::post('/login', [AdminAuthController::class, 'login']);
		//logout
		Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware('auth:sanctum');
	});

	//------------------- Profile control routes -----------------------;
	Route::prefix('/profile')->middleware(['auth:sanctum', 'adminAuth'])->group(function () {
		//get profile information
		Route::get('/', [AdminProfileController::class, 'getProfileInfo']);
		Route::prefix('update')->group(function () {
			//update profile
			Route::post('/', [AdminProfileController::class, 'updateProfile']);
			//update password
			Route::post('/password', [AdminProfileController::class, 'updatePassword']);
		});
	});

	//------------------- Admins control routes -----------------------;
	Route::prefix('/admins')->middleware(['auth:sanctum', 'adminAuth'])->group(function () {
		//fetch admin roles
		Route::get('/roles', [AdminsController::class, 'rolesList']);
		//fetch list of admins
		Route::get('/', [AdminsController::class, 'adminsList']);
		//fetch single admin information
		Route::get('/admin/{adminID}', [AdminsController::class, 'adminInfo']);
		//add new admin
		Route::post('/add', [AdminsController::class, 'addAdmin']);
		//update admin information
		Route::prefix('update')->group(function () {
			//update basic information
			Route::post('/', [AdminsController::class, 'updateAdminInfo']);
			//update password
			Route::post('/password', [AdminsController::class, 'updatePassword']);
			//Activate admin account
			Route::get('/activate/{adminID}', [AdminsController::class, 'activateAdminAccount']);
			//block admin account
			Route::get('/block/{adminID}', [AdminsController::class, 'blockAdminAccount']);
		});
		//delete admin
		Route::post('/delete', [AdminsController::class, 'deleteAdmin']);
	});

	//------------------- Users control routes -----------------------;
	Route::prefix('/users')->middleware(['auth:sanctum', 'adminAuth'])->group(function () {
		//fetch list of all users
		Route::get('/', [UsersController::class, 'usersList']);
		//fetch single user information
		Route::get('/user/{userID}', [UsersController::class, 'userInfo']);
		//toggle user status
		Route::post('change-statue', [UsersController::class, 'changeUserStatue']);
		//delete user
		Route::post('/delete', [UsersController::class, 'deleteUser']);
	});
});

