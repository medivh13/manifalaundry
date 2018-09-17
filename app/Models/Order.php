<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'tb_order';
	protected $fillable = [
		'code','customer','alamat','telp','keterangan','created_at','updated_at','tgl_selesai','status_bayar',
		'tgl_bayar','jml_bayar','jml_kembali','pemasukan'
	];
}
