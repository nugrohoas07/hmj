<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendamping extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user', 'model_proker', 'model_surat'));
        cek_session();
    }

    public function index()
    {
        $this->db->where('status',"0");
        $data["proker"] = $this->model_proker->getProker();
        $data['persetujuan'] = $this->model_surat->getPersetujuan($this->session->userdata('jabatan'));
        $data['rekap'] = $this->model_surat->getRekap($this->session->userdata('jabatan'));
        $this->load->view('Pendamping/index',$data);
    }

    public function proker()
    {
        if (isset($_POST['setuju'])) {
            if ($this->model_proker->verifProker("1")) {
                $this->toastr->success('Proker telah disetujui');
            } else {
                $this->toastr->error('Gagal menyetujui proker');
            }
            redirect(site_url('Pendamping/proker'));
        }
        if (isset($_POST['tolak'])) {
            if ($this->model_proker->verifProker("4")) {
                $this->toastr->success('Proker telah ditolak');
            } else {
                $this->toastr->error('Gagal menolak proker');
            }
            redirect(site_url('Pendamping/proker'));
        }
        $this->db->where('status', "0");
        $data["proker"] = $this->model_proker->getProker();
        $this->load->view("Pendamping/proker", $data);
    }

    public function progress()
    {
        if (isset($_POST['update'])) {
            if ($this->model_proker->updateMasukan()) {
                $this->toastr->success('Berhasil memberi masukan');
            } else {
                $this->toastr->error('Gagal memberi masukan');
            }
            redirect(site_url('Pendamping/progress'));
        }
        $data["progress"] = $this->model_proker->getProgress();
        $this->load->view('Pendamping/progress', $data);
    }

    public function persetujuan()
    {
        $user = $this->session->userdata('jabatan');
        if (isset($_POST['setuju'])) {
            $this->model_surat->addSetuju($user);
            if ($this->toastr->success('Terimakasih, Telah Menyetujui')) {
            } else {
                $this->toastr->error('Mohon Maaf, Gagal Menyetujui');
            }
            redirect('pendamping/persetujuan');
        } elseif (isset($_POST['tolak'])) {
            $this->model_surat->tolakPersetujuan($user);
            if ($this->toastr->error('Terimakasih, Telah Menolak')) {
            } else {
                $this->toastr->error('Mohon Maaf, Gagal Menolak');
            }
            redirect('pendamping/persetujuan');
        }
        $data['persetujuan'] = $this->model_surat->getPersetujuan($user);
        $this->load->view('Pendamping/persetujuan', $data);
    }
    
    public function rekap()
    {
        $data['rekap'] = $this->model_surat->getRekap();
        $this->load->view('Pendamping/rekap_surat', $data);
    }

    public function timeline()
    {
        $data["proker"] = $this->model_proker->getProker();
        $this->load->view('Pendamping/timeline', $data);
    }
    public function setuju($id = null)
    {
        if (!isset($id)) show_404();
        $this->status = "1";
        $this->db->update('proker', $this, array('id_proker' => $id));
        redirect('pendamping');
    }
}
