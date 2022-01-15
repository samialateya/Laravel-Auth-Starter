<?php

namespace App\Http\Requests\Admin\API\Admins;

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
			'name' => 'nullable | min:3',
			'email' => ['nullable', 'email', Rule::unique('users')->ignore($this->id)],
			'admin_type' => 'nullable | exists:admin_types,id'
		];
	}

	public function messages()
	{
		return [
			'name.min' => 'please enter a valid name',
			'email.unique' => 'this email is used before',
			'admin_type.exists' => 'the admin type you add is not exists',
		];
	}
}
