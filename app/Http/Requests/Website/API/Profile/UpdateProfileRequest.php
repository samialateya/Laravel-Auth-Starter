<?php

namespace App\Http\Requests\Website\API\Profile;

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
			'name' => 'nullable | min:3',
			'password' => 'nullable | min:4',
		];
	}

	public function messages()
	{
		return [
			'name.min' => 'please enter a valid name',
			'password.min' => 'password field must be more than 3 characters',
		];
	}
}
