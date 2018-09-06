<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
	protected $table = 'tb_detail_order';
	protected $fillable = [
		'order_id','product_id','amount'
	];
}
