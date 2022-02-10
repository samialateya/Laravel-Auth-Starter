<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Admin\Web\UsersController;
use App\Http\Controllers\Admin\Web\AdminsController;
use App\Http\Controllers\Website\Web\AuthController;
use App\Http\Controllers\Website\Web\HomeController;
use App\Http\Controllers\Website\Web\OAuthController;
use App\Http\Controllers\Website\Web\ProfileController;
use App\Http\Controllers\Admin\Web\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\Web\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\Web\ProfileController as AdminProfileController;

/*
|--------------------------------------------------------------------------
| website Routes
|--------------------------------------------------------------------------
*/

Route::name('website.')->middleware('user')->group(function () {
	//------------------- Home Page routes -----------------------;
	Route::get('/', [HomeController::class, 'homePage'])->middleware('auth')->name('homePage');

	//------------------- Authentication routes -----------------------;
	Route::middleware('guest')->group(function () {
		//render login page
		Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage');
		//execute login logic to authenticated user
		Route::post('/login', [AuthController::class, 'login'])->name('login');

		//render register page
		Route::get('/register', [AuthController::class, 'registerPage'])->name('registerPage');
		//execute registration logic
		Route::post('/register', [AuthController::class, 'register'])->name('register');

		//------------------- forget password ---------------------
		//#request reset password link Page
		Route::view('/forgot-password', 'website.pages.auth.forgot-password.request')->name('password.request');
		//#verify user email and send reset password link
		Route::post('/forgot-password', [AuthController::class,'sendResetPasswordLink'])->name('password.sendLink');
		//#update password page
		Route::get('/reset-password/{token}', [AuthController::class, 'newPasswordPage'])->name('password.reset');
		//#update password
		Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');

		//------------------- Social login ---------------------
		//#redirect to a OAuth provider login page
		Route::get('/oauth/{provider}', [OAuthController::class, 'redirectToProvider'])->name('social.redirect');
		//#execute OAuth provider login logic
		Route::get('/oauth/{provider}/callback', [OAuthController::class, 'handleProviderCallback'])->name('social.callback');
	});
	//logout
	Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
	
	//------------------- Profile control routes -----------------------;
	Route::prefix('/profile')->middleware('auth')->group(function (){
		//render profile page
		Route::get('/', [ProfileController::class, 'profilePage'])->name('profilePage');
		Route::middleware('verified')->group(function(){ // access only by users that verified there emails
			//render update profile page
			Route::get('/update', [ProfileController::class, 'updateProfilePage'])->name('updateProfilePage');
			//update profile
			Route::post('/update', [ProfileController::class, 'updateProfile'])->name('updateProfile');
			//update avatar picture
			Route::post('/update/avatar', [ProfileController::class, 'updateAvatar'])->name('updateAvatar');
			//remove avatar
			Route::post('/avatar/remove', [ProfileController::class, 'removeAvatar'])->name('removeAvatar');
		});

	});
});




//######################## laravel needed routes ########################;

//---------------------- email verification routes --------------------------------
Route::prefix('/verification')->name('verification.')->middleware('auth')->group(function(){
	//view notice page to inform the user that he must verify his email
	Route::get('/notice', [AuthController::class, 'verificationNotice'])->name('notice');
	//send email verification link
	Route::post('/send', [AuthController::class, 'sendVerificationEmail'])->name('send');
	//handle and accept verification links
	Route::get('/verify/{id}/{hash}', [AuthController::class, 'acceptVerificationLink'])->middleware('signed')->name('verify');
});

//#inter new password page
Route::get('/reset-password/{token}', [AuthController::class, 'newPasswordPage'])->name('password.reset');




/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::name('admin.')->prefix('admin')->group(function () {
	//redirect any access to primary route to dashboard route
	Route::get('/',function (){ return redirect()->route('admin.homePage');})->middleware(['adminAuth']);
	//------------------- Home Page routes -----------------------;
	Route::get('/dashboard', [AdminHomeController::class, 'homePage'])->middleware(['adminAuth'])->name('homePage');

	//------------------- Authentication routes -----------------------;
	Route::middleware('adminGuest')->group(function () {
		//render login page
		Route::get('/login', [AdminAuthController::class, 'loginPage'])->name('loginPage');
		//execute login logic to authenticated user
		Route::post('/login', [AdminAuthController::class, 'login'])->name('login');
	});
	//logout
	Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware(['adminAuth'])->name('logout');

	//------------------- Profile control routes -----------------------;
	Route::prefix('/profile')->middleware(['adminAuth'])->group(function () {
		//render update profile page
		Route::get('/update', [AdminProfileController::class, 'updateProfilePage'])->name('updateProfilePage');
		//update profile
		Route::post('/update', [AdminProfileController::class, 'updateProfile'])->name('updateProfile');
		//update password
		Route::post('/updatePassword', [AdminProfileController::class, 'updatePassword'])->name('updatePassword');
	});

	//------------------- Admins control routes -----------------------;
	Route::prefix('admins')->name('admins.')->middleware(['adminAuth'])->group(function () {
		//show admins list
		Route::get('/', [AdminsController::class, 'adminsListPage'])->name('listPage');
		//show page to add new admin
		Route::get('/add', [AdminsController::class, 'addAdminPage'])->name('addAdminPage');
		//add new admin
		Route::post('/add', [AdminsController::class, 'addAdmin'])->name('addAdmin');
		//show page to update admin information
		Route::get('/update/{admin}', [AdminsController::class, 'updateAdminPage'])->name('updateAdminPage');
		//update admin basic information
		Route::post('/update', [AdminsController::class, 'updateAdmin'])->name('updateAdmin');
		//update admin password
		Route::post('/update-password', [AdminsController::class, 'updatePassword'])->name('updatePassword');
		//delete admin
		Route::post('/delete', [AdminsController::class, 'deleteAdmin'])->name('deleteAdmin');
		//toggle admin status
		Route::post('/status', [AdminsController::class, 'toggleAdminStatus'])->name('toggleAdminStatus');
	});


	//------------------- users control routes -----------------------
	Route::prefix('users')->name('users.')->middleware('adminAuth')->group(function () {
		//show users list
		Route::get('/', [UsersController::class, 'usersListPage'])->name('listPage');
		//delete user
		Route::post('/delete', [UsersController::class, 'deleteUser'])->name('deleteUser');
		//toggle user status
		Route::post('/status', [UsersController::class, 'toggleUserStatus'])->name('toggleUserStatus');
	});
});