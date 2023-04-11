<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabid extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->load->model(array('model_user','model_proker'));
        $this->load->library('form_validation');
        cek_session();
	}

	public function index()
	{
        $data["proker"] = $this->model_proker->getProkerbyBidang()->result();
        $data["progress"] = $this->model_proker->getProgressbyBidang()->result();
        $data["pendaftar"] = $this->db->get_where('dokumen_user', array('status' => "0"))->num_rows();
        $this->load->view('Ketua Bidang/index',$data);
    }

    public function persetujuan()
	{
        $this->load->view('Ketua Bidang/persetujuan');
    }

    public function progress()
	{
        $data["progress"] = $this->model_proker->getProgressbyBidang()->result();
        $this->load->view('Ketua Bidang/progress',$data);
    }

    public function laporan()
	{
	    if(isset($_POST['setuju'])){
            if($this->model_proker->VerifLPJ()){
                $this->toastr->success('Laporan berhasil disetujui');
            }else{
                $this->toastr->error('Laporan gagal disetujui');
            }
            redirect(site_url('Kabid/laporan')); }
        if(isset($_POST['tolak'])){
            if($this->model_proker->VerifLPJ()){
                $this->toastr->success('Laporan telah ditolak');
            }else{
                $this->toastr->error('Laporan gagal ditolak');
            }
            redirect(site_url('Kabid/laporan')); }
	    
        $data['proker'] = $this->model_proker->getProkerbyBidang()->result();
        $this->load->view('Ketua Bidang/laporan',$data);
    }

    public function pengajuan()
	{
        if(isset($_POST['tambah'])){
            if($this->model_proker->inputProker()){
                $this->toastr->success('Berhasil mengajukan proker');
            }else{
                $this->toastr->error('Gagal mengajukan proker');
            }
            redirect(site_url('Kabid/pengajuan'));
        }
        if(isset($_POST['edit'])){
            if($this->model_proker->updateProker()){
                $this->toastr->success('Berhasil mengupdate proker');
            }else{
                $this->toastr->error('Gagal mengupdate proker');
            }
            redirect(site_url('Kabid/pengajuan'));
        }
        if(isset($_POST['hapus'])){
            if($this->model_proker->deleteProker()){
                $this->toastr->success('Berhasil menghapus proker');
            }else{
                $this->toastr->error('Gagal menghapus proker');
            }
            redirect(site_url('Kabid/pengajuan'));
        }
        if(isset($_POST['ulang'])){
            if($this->model_proker->verifProker("0")){
                $this->toastr->success('Proker berhasil diajukan ulang');
            }else{
                $this->toastr->error('Proker gagal diajukan ulang');
            }
            redirect(site_url('Kabid/pengajuan'));
        }
        $data["anggota"] = $this->model_user->getAnggotabyBidang();
        $data["proker"] = $this->model_proker->getProkerbyBidang()->result();
        $this->load->view('Ketua Bidang/pengajuan',$data);
    }

    public function addPengajuan()
	{
        $data["anggota"] = $this->model_user->getAnggotabyBidang();
        $this->load->view('Ketua Bidang/add_pengajuan',$data);
    }

    public function lpj()
    {
        $user = $this->session->userdata('username');
        $id_lpj = $this->input->post('id_lpj');
        if (isset($_POST['simpan'])) {
            if ($this->model_user->addLpj($user)) {
                $this->toastr->success('Berhasil Menambah LPJ');
                redirect('Kabid/lpj');
            } else {
                $this->toastr->error('Gagal Menambah LPJ');
                redirect('Kabid/addLpj');
            }
        } elseif (isset($_POST['edit'])) {
            if($this->model_user->editLpj($id_lpj)){
            $this->toastr->info('Edit LPJ Berhasil');
            }else{
            $this->toastr->error('Edit LPJ Gagal');
            }
            redirect('Kabid/lpj');
        } elseif (isset($_POST['hapus'])) {
            if($this->model_user->hapusLpj($id_lpj)){
            $this->toastr->success('Hapus LPJ Berhasil');
            }else{
            $this->toastr->error('Hapus LPJ Gagal');
            }
            redirect('Kabid/lpj');
        }
        $data['lpjproker'] = $this->db->get_where('proker', ['lpj_kabid' => '1'])->result();
        $data['lpj'] = $this->db->get_where('lpj', ['username' => $user])->result();
        $this->load->view('Ketua Bidang/lpj', $data);
    }

    public function addLpj()
    {
        $this->load->view('Ketua Bidang/lpj_tambah');
    }

    public function timeline(){
        $data["proker"] = $this->model_proker->getProker();
        $this->load->view('Ketua Bidang/timeline',$data);
    }

    public function rekrut()
    {
        if(!$this->model_user->isiNilaiWawancara() && !$this->model_user->isiTotalNilai()){
            $saw = 'sudah';
        }else{
            $saw = '';
        }
        
        if (isset($_POST['nilai'])) {
            if ($this->model_user->nilai_wawancara('kabid')) {
                $this->toastr->success('Berhasil Menilai Wawancara');
            } else {
                $this->toastr->error('Gagal Menilai Wawancara');
            }
            redirect('Kabid/rekrut');
        }
        
        $data["saw"] = $saw;
        // $data["saw"] = $saw;
        $data["pendaftar"] = $this->model_user->getPendaftar();
        $data["pendaftaran"] = $this->db->get_where('pendaftaran', ["id" => "pendaftaran"])->row();
        $data["list_bidang"] = $this->model_user->getAllBidang();
        $this->load->view("Ketua Bidang/recruitment", $data);
    }
}