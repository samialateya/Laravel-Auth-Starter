<?php

namespace App\Http\Requests\Website\Web\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
{

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'id' => 'required',
			'avatar' => 'required | mimes:jpeg,jpg,png,svg | max:10000' // max 10000kb
		];
	}

	public function messages()
	{
		return [
			'required' => 'image is required',
			'mimes' => 'you must upload an image',
			'max' => 'the image must be at over 10MB'
		];
	}
}
