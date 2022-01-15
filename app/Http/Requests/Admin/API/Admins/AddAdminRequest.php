<?php

namespace App\Http\Requests\Admin\API\Admins;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AddAdminRequest extends FormRequest
{
	public function authorize()
	{
		//apply authorization check
		return $this->user()->can('create', User::class);
	}
	public function rules()
	{
		return [
			'name' => 'required | min:3',
			'email' => 'required | email | unique:users',
			'password' => 'required | min:4 | confirmed',
			'admin_type' => 'required | exists:admin_types,id'
		];
	}

	public function messages()
	{
		return [
			'name.required' => 'name field is required',
			'name.min' => 'please enter a valid name',
			'email.required' => 'email field is required',
			'email.unique' => 'this email is used before',
			'password.required' => 'password field is required',
			'password.min' => 'password field must be more than 3 characters',
			'password.confirmed' => 'password confirmation field did not match the password',
			'admin_type.required' => 'admin type field is required',
			'admin_type.exists' => 'the admin type you add is not exists',
		];
	}
}
