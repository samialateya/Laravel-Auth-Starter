<?php

namespace App\Http\Resources\User\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
			'avatar' => asset($this->getAvatarLink()),
			'access_token' => $this->createToken('auth_token')->plainTextToken,
		];
	}
}
