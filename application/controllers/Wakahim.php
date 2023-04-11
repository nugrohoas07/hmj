<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wakahim extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->load->model(array('model_user','model_proker'));
        $this->load->library('form_validation');
        cek_session();
	}

	public function index()
	{
        $data["progress"] = $this->model_proker->getProgress();
        $data["proker"] = $this->model_proker->getProkerYear()->num_rows();
        $this->load->view('Wakil Ketua Umum/index',$data);
    }

    public function progress()
	{
        $data["progress"] = $this->model_proker->getProgress();
        $this->load->view('Wakil Ketua Umum/progress',$data);
    }

    public function laporan()
	{
        $data['proker'] = $this->model_proker->getProker();
        $this->load->view('Wakil Ketua Umum/laporan',$data);
    }

    public function timeline(){
        $data["proker"] = $this->model_proker->getProker();
        $this->load->view('Wakil Ketua Umum/timeline',$data);
    }
    
}