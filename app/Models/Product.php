<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $table = 'tb_product';
  protected $fillable = [
	'name','harga','created_at','updated_at'
  ];
}
