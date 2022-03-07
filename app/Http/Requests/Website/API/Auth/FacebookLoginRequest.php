<?php

namespace App\Http\Requests\Website\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class FacebookLoginRequest extends FormRequest
{

	public function rules()
	{
		return [
			'access_token' => 'required',
			'email' => 'required',
			'name' => 'nullable | min:3',
			'image' => 'nullable | url',
		];
	}

	public function messages()
	{
		return [
			'access_token.required' => 'Access Token is required.',
			'email.required' => 'Email is required.',
			'name.min' => 'Name must be at least 3 characters.',
			'image.url' => 'send image url.',
		];
	}
}
