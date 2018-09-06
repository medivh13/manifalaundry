<?php


//ByMedivh13
use Carbon\Carbon;

function formatPrice($price){
	return number_format($price,2,",",".");
}
function priceToInt($price){
	//inibuat yg ada cent nya..
	return (int) str_replace([',00','.'], '', $price);
}
function rollbackPrice($price){
	//inibuat yg ga ada cent nya..
	return (int) str_replace(['.'], '', $price);
}
function thisday(){
	$data = Carbon::now('Asia/Jakarta')->format('Y-m-d G:i:s');
	
	return $data;
}

function justDay(){
	$data = Carbon::now('Asia/Jakarta')->format('Y-m-d');
	
	return $data;
}

function awalbulan(){
	$data = new Carbon('first day of this month', 'Asia/Jakarta');
	return $data;
}
function akhirbulan(){
	$data = new Carbon('last day of this month', 'Asia/Jakarta');
	return $data;
}
?>
