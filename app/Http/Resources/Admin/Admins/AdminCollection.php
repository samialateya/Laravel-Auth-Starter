<?php

namespace App\Http\Resources\Admin\Admins;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminCollection extends ResourceCollection
{

	public function toArray($request)
	{
		return [
			'data' => $this->collection,
		];
	}
}
