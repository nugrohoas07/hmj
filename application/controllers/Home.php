<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct(){
        parent::__construct();
        cek_session();
    }

	public function index()
	{
        $idjabatan = $this->session->userdata('idjabatan');
        $jabatan = $this->session->userdata('jabatan');
        $status = $this->session->userdata('status');
        if($status=="1" && $jabatan!=""){
            if($jabatan=="Staff"){
                redirect('Staff');
            }elseif($jabatan=="Ketua Divisi"){
                redirect('Kadiv');
            }elseif($jabatan=="Ketua Bidang"){
                redirect('Kabid');
            }elseif($jabatan=="Bendahara"){
                redirect('Bendahara');
            }elseif($jabatan=="Sekretaris"){
                redirect('Sekretaris');
            }elseif($jabatan=="Ketua Umum"&&$status=="1"){
                redirect('Ketum');
            }elseif($jabatan=="Pendamping"){
                redirect('Pendamping');
            }elseif($jabatan=="Sekretaris Bidang"){
                redirect('Sekbid');
            }elseif($jabatan=="Wakil Ketua Umum"){
                redirect('Wakahim');
            }
        }else{
            if($idjabatan!=6&&$status=="3"){
                $out = array('hmj_login', 'username', 'nama', 'level', 'jabatan', 'status');
                $this->session->unset_userdata($out);
                $this->toastr->warning('Sudah Selesai');
                redirect('login');
            }elseif($idjabatan==6&&$status=='3'){
                redirect('Dpo');
            }else{
            redirect('Pendaftar'); }
        }
		
    }
    
    function panduan($file)
    {
        force_download('./buku_panduan/Buku-Panduan-Web-HMJTE-' . $file, NULL);
    }

    public function logout()
    {
        $out = array('hmj_login', 'username', 'nama', 'level', 'jabatan', 'status');
        $this->session->unset_userdata($out);
        $this->toastr->success('Berhasil Keluar');
        redirect('login');
    }
    
}