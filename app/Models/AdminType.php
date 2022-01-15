<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminType extends Model
{
	use HasFactory;

	public $timestamps = false;
	protected $fileable = ['name', 'description'];
}
