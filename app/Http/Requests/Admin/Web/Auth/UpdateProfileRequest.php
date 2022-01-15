<?php

namespace App\Http\Requests\Admin\Web\Auth;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
			'email' => ['required', 'email', Rule::unique('users')->ignore($this->user()->id)],
		];
	}

	public function messages()
	{
		return [
			'name.required' => 'name field is required',
			'name.min' => 'please enter a valid name',
			'email.required' => 'the email field is required',
			'email.unique' => 'this email is used before'
		];
	}
}
