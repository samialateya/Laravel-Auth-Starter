<?php

namespace App\Http\Requests\Website\Web\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{

	public function authorize()
	{
		return true;
	}
	public function rules()
	{
		return [
			'token' => 'required',
			'email' => 'required',
			'password' => 'required | min:4 | confirmed',
		];
	}

	public function messages()
	{
		return [
			'password.required' => 'password field is required',
			'password.min' => 'password field must be more than 3 characters',
			'password.confirmed' => 'password confirmation field did not match the password'
		];
	}
}
