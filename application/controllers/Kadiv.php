<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kadiv extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->load->model(array('model_user','model_proker'));
        $this->load->library('form_validation');
        cek_session();
	}

	public function index()
	{
	    $data["progress"] = $this->model_proker->getProgressbyDivisi()->result();
        $this->load->view('Ketua Divisi/index',$data);
    }

    public function persetujuan()
	{
        $this->load->view('Ketua Divisi/persetujuan');
    }

    public function progress()
	{
        $data["progress"] = $this->model_proker->getProgressbyDivisi()->result();
        $this->load->view('Ketua Divisi/progress',$data);
    }

    public function laporan()
	{
        if(isset($_POST['setuju'])){
            if($this->model_proker->VerifLPJ()){
                $this->toastr->success('Laporan berhasil disetujui');
            }else{
                $this->toastr->error('Laporan gagal disetujui');
            }
            redirect(site_url('kadiv/laporan')); }
        if(isset($_POST['tolak'])){
            if($this->model_proker->VerifLPJ()){
                $this->toastr->success('Laporan telah ditolak');
            }else{
                $this->toastr->error('Laporan gagal ditolak');
            }
            redirect(site_url('kadiv/laporan')); }
	    
        $data['proker'] = $this->model_proker->getProkerbyDivisi()->result();
        $this->load->view('Ketua Divisi/laporan',$data);
    }

    public function lpj()
    {
        $user = $this->session->userdata('username');
        $id_lpj = $this->input->post('id_lpj');
        if (isset($_POST['simpan'])) {
            if ($this->model_user->addLpj($user)) {
                $this->toastr->success('Berhasil Menambah LPJ');
                redirect('kadiv/lpj');
            } else {
                $this->toastr->error('Gagal Menambah LPJ');
                redirect('kadiv/addLpj');
            }
        } elseif (isset($_POST['edit'])) {
            if($this->model_user->editLpj($id_lpj)){
            $this->toastr->info('Edit LPJ Berhasil');
            }else{
            $this->toastr->error('Edit LPJ Gagal');
            }
            redirect('kadiv/lpj');
        } elseif (isset($_POST['hapus'])) {
            if($this->model_user->hapusLpj($id_lpj)){
            $this->toastr->success('Hapus LPJ Berhasil');
            }else{
            $this->toastr->error('Hapus LPJ Gagal');
            }
            redirect('kadiv/lpj');
        }
        $data['lpjproker'] = $this->db->get_where('proker', ['lpj_kadiv' => '1'])->result();
        $data['lpj'] = $this->db->get_where('lpj', ['username' => $user])->result();
        $this->load->view('Ketua Divisi/lpj', $data);
    }

    public function addLpj()
    {
        $this->load->view('Ketua Divisi/lpj_tambah');
    }

    public function timeline(){
        $data["proker"] = $this->model_proker->getProker();
        $this->load->view('Ketua Divisi/timeline',$data);
    }
    
}