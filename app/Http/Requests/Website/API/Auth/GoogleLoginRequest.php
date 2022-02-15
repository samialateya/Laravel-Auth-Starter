<?php

namespace App\Http\Requests\Website\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class GoogleLoginRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'id_token' => 'required',
			'name' => 'nullable | min:3',
			'image' => 'nullable | url',
		];
	}

	public function messages()
	{
		return [
			'id_token.required' => 'ID Token is required.',
			'name.min' => 'Name must be at least 3 characters.',
			'image.url' => 'send image url.',
		];
	}
}
