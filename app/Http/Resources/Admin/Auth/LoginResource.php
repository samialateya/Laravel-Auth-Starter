<?php

namespace App\Http\Resources\Admin\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{

	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
			'access_token' => $this->createToken('auth_token')->plainTextToken,
		];
	}
}
