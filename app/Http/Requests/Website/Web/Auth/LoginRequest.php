<?php

namespace App\Http\Requests\Website\Web\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'email' => 'required | email',
			'password' => 'required | min:4',
		];
	}

	public function messages(){
		return [
			'email.required' => 'email field is required',
			'password.required' => 'password field is required',
			'password.min' => 'password field must be more than 3 characters'
		];
	}
}
