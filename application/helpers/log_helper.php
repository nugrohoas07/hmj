<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function cek_session(){
	$CI = & get_instance();
	$session = $CI->session->userdata('hmj_login');
	$menu = strtolower($CI->uri->segment(1));
	$jabatan = $CI->session->userdata('jabatan');
	if($session!="1"){
		redirect('login');
	} elseif (($menu == 'pendamping' && $jabatan != 'Pendamping') || ($menu == 'ketum' && $jabatan != 'Ketua Umum') || ($menu == 'wakahim' && $jabatan != 'Wakil Ketua Umum') || ($menu == 'sekretaris' && $jabatan != 'Sekretaris') || ($menu == 'bendahara' && $jabatan != 'Bendahara') || ($menu == 'kabid' && $jabatan != 'Ketua Bidang') || ($menu == 'sekbid' && $jabatan != 'Sekretaris Bidang') || ($menu == 'kadiv' && $jabatan != 'Ketua Divisi') || ($menu == 'staff' && $jabatan != 'Staff') || ($menu == 'pendaftar' && $jabatan != '')) {
		redirect('home');
	}
}

function cek_session_login(){
	$CI = & get_instance();
	$session = $CI->session->userdata('hmj_login');
	if($session=="1"){
		redirect('home');
	}
}
