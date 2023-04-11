<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function to_date($data){
	$year = substr($data, 0, 4);
	$moon = substr($data, 5, 2);
	$day = substr($data, 8, 2);
	$date = $day.'-'.$moon.'-'.$year;
	return $date;
}

function us_date($data){
	$year = substr($data, 0, 4);
	$moon = substr($data, 5, 2);
	$day = substr($data, 8, 2);
	$date = $moon.'/'.$day.'/'.$year;
	return $date;
}

function to_date_time($data){
	$year = substr($data, 0, 4);
	$moon = substr($data, 5, 2);
	$day = substr($data, 8, 2);
	$time = substr($data, 11);
	$date = $day.'-'.$moon.'-'.$year.' '.$time;
	return $date;
}

function tanggal_indo($tanggal){
	$bulan = array(
						1 => 'Januari',
						'Februari',
						'Maret',
						'April',
						'Mei',
						'Juni',
						'Juli',
						'Agustus',
						'September',
						'Oktober',
						'November',
						'Desember'
					);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}
