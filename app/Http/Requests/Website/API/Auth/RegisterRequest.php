<?php

namespace App\Http\Requests\Website\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'name' => 'required | min:3',
			'email' => 'required | email | unique:users',
			'password' => 'required | min:4 | confirmed',
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
			'password.confirmed' => 'password confirmation field did not match the password'
		];
	}
}
