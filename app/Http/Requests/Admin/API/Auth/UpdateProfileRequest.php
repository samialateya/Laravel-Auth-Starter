<?php

namespace App\Http\Requests\Admin\API\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
	public function authorize()
	{
		return $this->user()->isAdmin();
	}
	
	public function rules()
	{
		return [
			'name' => 'nullable | min:3',
			'email' => ['nullable', 'email', Rule::unique('users')->ignore($this->user()->id)],
		];
	}

	public function messages()
	{
		return [
			'name.min' => 'please enter a valid name',
			'email.unique' => 'this email is used before'
		];
	}
}
