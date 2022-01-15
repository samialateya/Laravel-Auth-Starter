<?php

namespace App\Http\Resources\Admin\Admins;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
	public function toArray($request)
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'email' => $this->email,
			'is_active' => $this->is_active,
			'role' => $this->adminType->name ?? 'user',
		];
	}
}
