<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bendahara extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->load->model(array('model_user','model_proker','model_dana'));
        $this->load->library('form_validation');
        cek_session();
	}

	public function index()
	{
        $data["persetujuan"] = $this->model_dana->getDana($this->session->userdata('jabatan'));
        $data['pemasukan'] = $this->db->select_sum('pemasukan', 'pemasukan')->get_where('saldo', ("(role='1' OR status='1')"))->result();
        $data['pengeluaran'] = $this->db->select_sum('pengeluaran', 'pengeluaran')->get_where('saldo', ("(role='1' OR status='1')"))->result();
        $this->load->view('Bendahara/index', $data);
    }

    public function persetujuan()
    {
        $user = $this->session->userdata('jabatan');
        $saldo = $this->model_dana->getRekap();
        $id_saldo = $this->input->post('id_saldo');

        if (isset($_POST['setuju'])) {
            $post = $this->input->post('bukti');
            $bukti = $this->model_dana->_uploadBukti($post);
            $data = [
                'status' => '1',
                'bukti' => $bukti
            ];
            if($this->model_dana->persetujuan($id_saldo, $data, $saldo)){
            $this->toastr->success('Telah Menyetujui Pengajuan Dana');
            }else{
            $this->toastr->error('Gagal Menyetujui Pengajuan Dana');
            }
            redirect('bendahara/persetujuan');
        } elseif (isset($_POST['tolak'])) {
            $data = ['status' => '2'];
            if($this->model_dana->persetujuan($id_saldo, $data, $saldo)){
            $this->toastr->success('Telah Menolak Pengajuan Dana');
            }else{
            $this->toastr->error('Gagal Menolak Pengajuan Dana');
            }
            redirect('bendahara/persetujuan');
        }
        $data["saldo"] = $this->model_dana->getDana($user);
        $this->load->view('Bendahara/persetujuan', $data);
    }

    public function progress()
	{
        $data['progress'] = $this->model_proker->getProgress();
        $this->load->view('Bendahara/progress',$data);
    }

    public function laporan()
    {
        if(isset($_POST['setuju'])){
            if($this->model_proker->VerifLPJ()){
                $this->toastr->success('Laporan berhasil disetujui');
            }else{
                $this->toastr->error('Laporan gagal disetujui');
            }
            redirect(site_url('Bendahara/laporan')); }
        if(isset($_POST['tolak'])){
            if($this->model_proker->VerifLPJ()){
                $this->toastr->success('Laporan telah ditolak');
            }else{
                $this->toastr->error('Laporan gagal ditolak');
            }
            redirect(site_url('Bendahara/laporan')); }
        $this->db->where('lpj !=',"");
        $data['proker'] = $this->model_proker->getProker();
        $this->load->view('Bendahara/laporan', $data);
    }

    public function format()
    {
        if (isset($_POST['simpan'])) {
            if($this->model_dana->addFormat()){
            $this->toastr->success('Berhasil Menambah Format Dana');
            }else{
            $this->toastr->error('Gagal Menambah Format Dana');
            }
            redirect('bendahara/format');
        } elseif (isset($_POST['edit'])) {
            if($this->model_dana->editFormat()){
            $this->toastr->info('Edit Format Dana Berhasil');
            }else{
            $this->toastr->error('Edit Format Dana Gagal');
            }
            redirect('bendahara/format');
        } elseif (isset($_POST['hapus'])) {
            if($this->model_dana->hapusFormat()){
            $this->toastr->success('Hapus Format Dana Berhasil');
            }else{
            $this->toastr->error('Hapus Format Dana Gagal');
            }
            redirect('bendahara/format');
        }
        $data['format'] = $this->model_dana->getFormat();
        $this->load->view('Bendahara/format_pendanaan', $data);
    }

    public function addFormat()
	{
        $this->load->view('Bendahara/add_format');
    }

    public function rekap()
    {
        $data = $this->model_dana->getDataRekap();
        if (isset($_POST['tambah'])) {
            if($this->model_dana->inputRekap($data)){
            $this->toastr->success('Berhasil Menambah Rekap Dana');
            }else{
            $this->toastr->error('Gagal Menambah Rekap Dana');
            }
            redirect('bendahara/rekap');
        } elseif (isset($_POST['edit'])) {
            if($this->model_dana->editRekap($data)){
            $this->toastr->info('Edit Rekap Dana Berhasil');
            }else{
            $this->toastr->error('Edit Rekap Dana Gagal');
            }
            redirect('bendahara/rekap');
        } elseif (isset($_POST['hapus'])) {
            if($this->model_dana->hapusRekap($data)){
            $this->toastr->success('Hapus Rekap Dana Berhasil');
            }else{
            $this->toastr->error('Hapus Rekap Dana Gagal');
            }
            redirect('bendahara/rekap');
        }
        $data['saldo'] = $this->model_dana->getRekap();
        $this->load->view('Bendahara/rekap_pendanaan', $data);
    }

    public function addRekap()
	{
        $this->load->view('Bendahara/add_rekap');
    }

    public function lpj()
    {
        $user = $this->session->userdata('username');
        $id_lpj = $this->input->post('id_lpj');
        if (isset($_POST['simpan'])) {
            if ($this->model_user->addLpj($user)) {
                $this->toastr->success('Berhasil Menambah LPJ');
                redirect('bendahara/lpj');
            } else {
                $this->toastr->error('Gagal Menambah LPJ');
                redirect('bendahara/addLpj');
            }
        } elseif (isset($_POST['edit'])) {
            if($this->model_user->editLpj($id_lpj)){
            $this->toastr->info('Edit LPJ Berhasil');
            }else{
            $this->toastr->error('Edit LPJ Gagal');
            }
            redirect('bendahara/lpj');
        } elseif (isset($_POST['hapus'])) {
            if($this->model_user->hapusLpj($id_lpj)){
            $this->toastr->success('Hapus LPJ Berhasil');
            }else{
            $this->toastr->error('Hapus LPJ Gagal');
            }
            redirect('bendahara/lpj');
        }
        $data['lpj'] = $this->db->get_where('lpj', ['username' => $user])->result();
        $this->load->view('Bendahara/lpj', $data);
    }

    public function addLpj()
    {
        $this->load->view('Bendahara/lpj_tambah');
    }

    public function timeline(){
        $data["proker"] = $this->model_proker->getProker();
        $this->load->view('Bendahara/timeline',$data);
    }
    
}