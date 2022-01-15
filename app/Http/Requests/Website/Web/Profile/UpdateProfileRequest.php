<?php

namespace App\Http\Requests\Website\Web\Profile;

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
			'password' => 'nullable | min:4',
		];
	}

	public function messages()
	{
		return [
			'name.required' => 'name field is required',
			'name.min' => 'please enter a valid name',
			'password.min' => 'password field must be more than 3 characters',
		];
	}
}
