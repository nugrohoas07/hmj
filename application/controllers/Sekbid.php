<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekbid extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->load->model(array('model_user','model_proker'));
        $this->load->library('form_validation');
        cek_session();
	}

	public function index()
	{
	    $data["progress"] = $this->model_proker->getProgressbyBidang()->result();
        $this->load->view('Sekretaris Bidang/index',$data);
    }

    public function progress()
	{
        $data["progress"] = $this->model_proker->getProgressbyBidang()->result();
        $this->load->view('Sekretaris Bidang/progress',$data);
    }

    public function laporan()
	{
        $data['proker'] = $this->model_proker->getProkerbyBidang()->result();
        $this->load->view('Sekretaris Bidang/laporan',$data);
    }

    public function timeline(){
        $data["proker"] = $this->model_proker->getProker();
        $this->load->view('Sekretaris Bidang/timeline',$data);
    }
    
}