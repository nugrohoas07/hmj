<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dpo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user', 'model_proker'));
        $this->load->library('form_validation');
        cek_session();
    }

    public function index()
    {
        $data['progress'] = $this->model_proker->getProgress();
        $this->load->view('DPO/index',$data);
    }

    public function demisioner()
    {
        if (isset($_POST['edit'])) {
            if($this->model_user->editDemisioner()){
                $this->toastr->info('Edit Berhasil');
            }else{
                $this->toastr->error('Gagal Mengupdate');
            }
            redirect('Dpo/demisioner');
        }
        $data['demis'] = $this->model_user->getDemis();
        $this->load->view('DPO/demisioner', $data);
    }

    public function progress()
    {
        $data['progress'] = $this->model_proker->getProgress();
        $this->load->view('DPO/progress', $data);
    }

    public function timeline()
    {
        $data["proker"] = $this->model_proker->getProker();
        $this->load->view('DPO/timeline', $data);
    }
    
    public function pengurus()
    {
        if (isset($_POST['lihat'])) {
            $this->model_user->Pengurus();
            redirect('Dpo/demisioner');
        } elseif (isset($_POST['edit'])) {
            if($this->model_user->editPengurus()){
                $this->toastr->info('Edit Berhasil');
            }else{
                $this->toastr->error('Gagal Mengupdate');
            }
            $tahun = $this->input->get('tahun');
            redirect('Dpo/pengurus?tahun='.$tahun);
        }
        $data['pengurus'] = $this->model_user->getPengurus();
        $this->load->view('DPO/pengurus', $data);
    }
   
}
