<?php

namespace App\Http\Controllers\Admin\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
	//show list of all users
	public function usersListPage()
	{
		$users = User::where('is_admin', false)->orderBy('name')->paginate(10);
		return view('admin.pages.users.index', ['users' => $users]);
	}

	//delete user
	public function deleteUser(Request $request)
	{
		$user = User::findOrFail($request->id);
		//apply authorization check
		abort_unless($this->authorize('update', $user), 403);
		$user->delete();
		return redirect()->back()->with(['success' => 'user deleted successfully']);
	}


	// toggle user status
	public function toggleUserStatus(Request $request)
	{
		$user = User::findOrFail($request->id);
		//apply authorization check
		abort_unless($this->authorize('update', $user), 403);
		$user->is_active = !$user->is_active;
		$user->save();
		return redirect()->back()->with(['success' => 'user status was changed successfully']);
	}
}
