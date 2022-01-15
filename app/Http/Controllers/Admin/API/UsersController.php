<?php

namespace App\Http\Controllers\Admin\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Users\UserResource;
use App\Http\Requests\Admin\API\Users\UserStatusRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends Controller
{
	//fetch list of all users
	public function usersList()
	{
		$users = User::where('is_admin', false)->orderBy('name')->paginate(10);
		return UserResource::collection($users);
	}

	//fetch single user information 
	public function userInfo($id)
	{
		try {
			$users = User::where('id', $id)->where('is_admin', false)->firstOrFail();
			return new UserResource($users);
		} catch (ModelNotFoundException $e) {
			return response(['error' => 'user not found'], 404);
		}
	}

	//change user statue
	public function changeUserStatue(UserStatusRequest $request)
	{
		try {
			$user = User::where('id', $request->id)->where('is_admin', false)->firstOrFail();
			//apply authorization check
			abort_unless($this->authorize('update', $user), 403);
			$user->is_active = $request->statue;
			$user->save();
			return response(['message' => 'user account is changes successfully'], 200);
		} catch (ModelNotFoundException $e) {
			return response(['error' => 'user not found'], 404);
		}
	}

	//delete user
	public function deleteUser(Request $request)
	{
		try {
			$user = User::where('id', $request->id)->where('is_admin', false)->firstOrFail();
			//apply authorization check
			abort_unless($this->authorize('delete', $user), 403);
			$user->delete();
			return response(['message' => 'user account is deleted successfully'], 200);
		} catch (ModelNotFoundException $e) {
			return response(['error' => 'user not found'], 404);
		}
	}
}
