<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'tb_order';
	protected $fillable = [
		'code','customer','created_at','updated_at'
	];
}
