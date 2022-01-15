<?php

namespace App\Http\Requests\Admin\Web\Admins;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'id' => 'required',
			'name' => 'required | min:3',
			'email' => ['required', 'email', Rule::unique('users')->ignore($this->id)],
			'admin_type' => 'required | exists:admin_types,id'
		];
	}

	public function messages()
	{
		return [
			'name.required' => 'name field is required',
			'name.min' => 'please enter a valid name',
			'email.required' => 'the email field is required',
			'email.unique' => 'this email is used before',
			'admin_type.required' => 'admin type field is required',
			'admin_type.exists' => 'the admin type you add is not exists',
		];
	}
}
