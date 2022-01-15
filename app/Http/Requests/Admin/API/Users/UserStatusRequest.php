<?php

namespace App\Http\Requests\Admin\API\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserStatusRequest extends FormRequest
{
	public function rules()
	{
		return [
			'id' => 'required',
			'statue' => 'required | boolean',
		];
	}

	public function messages()
	{
		return [
			'id.required' => 'user id is required',
			'statue.required' => 'the statue field is required',
			'statue.boolean' => 'the statue field must be either True for (activate) or False fro (block)'
		];
	}
}
