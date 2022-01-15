<?php

namespace App\Policies\Admin;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminsPolicy
{
	use HandlesAuthorization;

	public function create(User $user)
	{
		//allow only super admins to create a new admins
		return $user->admin_type == 1;
	}

	public function update(User $currentAuthenticatedUser, User $adminToUpdate)
	{
		//allow an admin to update his own profile
		if ($currentAuthenticatedUser->id == $adminToUpdate->id) return true;
		//allow only super admins to update other admins profile
		else return $currentAuthenticatedUser->admin_type == 1;
	}

	public function delete(User $currentAuthenticatedUser, User $adminToDelete)
	{
		//prevent user from deleting his own account
		if ($currentAuthenticatedUser->id == $adminToDelete->id) return false;
		//allow only super admins to delete other admins profile
		else return $currentAuthenticatedUser->admin_type == 1;
	}

}
