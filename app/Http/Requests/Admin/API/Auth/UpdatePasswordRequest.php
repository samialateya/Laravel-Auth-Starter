<?php

namespace App\Http\Requests\Admin\API\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
	public function authorize()
	{
		return $this->user()->isAdmin();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'password' => 'required | min:4 | confirmed',
		];
	}

	public function messages()
	{
		return [
			'password.required' => 'password field is required',
			'password.min' => 'password field must be more than 3 characters',
			'password.confirmed' => 'password confirmation field did not match'
		];
	}
}
