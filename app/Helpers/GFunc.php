<?php

namespace App\Helpers;


use Illuminate\Support\Facades\DB;
/*use App\Models\Menu;*/
use Illuminate\Support\Facades\Crypt;


class GFunc{

	public static function ymd2dmy($date1) {
		$out="";
		if(strlen($date1)>=10){
			$out = \DateTime::createFromFormat('Y-m-d', $date1)->format('d-m-Y');
		}
		return $out;
	}
	
	public static function dmy2ydm($date1) {
		$out="";
		if(strlen($date1)>=10){
			$old_date = explode('/', $date1); 
			$out = $old_date[2].'-'.$old_date[1].'-'.$old_date[0];
		}
		return $out;
	}
	
	public static function numFormat($data,$dec=0){
	
		 return number_format($data,$dec,".",",");
	}
	
	public static function removeComa($data){
		return str_replace(',', '', $data);
	
	}
	
	public static function generateRandom($length = 64) {
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$count = mb_strlen($chars);

		for ($i = 0, $result = ''; $i < $length; $i++) {
			$index = rand(0, $count - 1);
			$result .= mb_substr($chars, $index, 1);
		}

		return $result;
	}
	
	public static function generate_simple_password($length){
		$chars =  'ABCDEFGHJKLMNPQRSTUVWXYZ'.
				'23456789';

		$str = '';
		$max = strlen($chars) - 1;

		for ($i=0; $i < $length; $i++)
			$str .= $chars[mt_rand(0, $max)];

		return $str;
	}
	
	public static function encryptMe($parameter){
		$enkripsi= Crypt::encrypt($parameter);		
		return $enkripsi;
	}
	
	public static function decryptMe($token){
		$data= Crypt::decrypt($token);
		return $data;
	}


	public static function getMonthName($xmonth){
		$month = array (
			'','January','February','March','April','May','June','July','August','September','October','November','December'
		);
		return $month[$xmonth];

	} 

	public static function getJatuhTempo($curmonth,$curyear){
		$next_month=1;
		$next_year=2021;
		if ($curmonth<12){
			$next_month=$curmonth+1;
			$next_year=$curyear;
		} else {
			$next_month=1;
			$next_year=$curyear+1;
		}
		
		return $next_year.'-'.($next_month<10?'0'.$next_month:$next_month).'-20';
	} 

	public static function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = GFunc::penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = GFunc::penyebut($nilai/10)." puluh". GFunc::penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . GFunc::penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = GFunc::penyebut($nilai/100) . " ratus" . GFunc::penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . GFunc::penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = GFunc::penyebut($nilai/1000) . " ribu" . GFunc::penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = GFunc::penyebut($nilai/1000000) . " juta" . GFunc::penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = GFunc::penyebut($nilai/1000000000) . " milyar" . GFunc::penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = GFunc::penyebut($nilai/1000000000000) . " trilyun" . GFunc::penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
}

?>