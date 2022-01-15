<?php

namespace App\Http\Resources\User\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
			'avatar' => asset($this->getAvatarLink())
		];
	}
}
