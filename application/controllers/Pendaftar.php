<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftar extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->load->model(array('model_user','model_proker','model_pemira'));
        $this->load->library('form_validation');
        cek_session();
	}

	public function index()
	{
        $data["pemira"] = $this->db->get_where('pemira', ["YEAR(waktu_input)" => date('Y')])->row();
        $data["info"] = $this->db->get_where('pendaftaran', ["id" => "pendaftaran"])->row();
        $this->load->view('Pendaftar/index',$data);
    }

    function daftar()
    {
        // mengatasi nembak link
        $info = $this->db->get_where('pendaftaran', ["id" => "pendaftaran"])->row();
        $date = date('Y-m-d');
        $username = $this->session->userdata("username");
        $daftar = $this->db->get_where('dokumen_user', array('username' => $username, 'status' => '0'))->row();
        $tolak = $this->db->get_where('dokumen_user', array('username' => $username, 'status' => '1'))->row();
        $terima = $this->db->get_where('dokumen_user', array('username' => $username, 'status' => '2'))->row();

        if (!$tolak) {
            if (!$terima) {
                if (!$daftar) {
                    if (empty($info) || $info->status == "1" || $date < $info->pengumpulan_awal || $date > $info->pengumpulan_akhir) {
                    // if ((!empty($info)) || $info->status == "0" || ($date <= $info->pengumpulan_awal && $date >= $info->pengumpulan_akhir)) {
                        $this->toastr->error('Pendaftaran Ditutup');
                        redirect('pendaftar');
                    } else {
                        if (isset($_POST['daftar'])) {
                            if ($this->model_user->daftarBaru()) {
                                $this->toastr->success('Berhasil mendaftar');
                            } else {
                                $this->toastr->error('Gagal mendaftar');
                            }
                            redirect('pendaftar');
                        }
                        $data["list_bidang"] = $this->model_user->getAllBidang();
                        $data["info"] = $info;
                        $this->load->view('Pendaftar/daftar', $data);
                    }
                } else {
                    $this->toastr->info('Anda Sudah Mendaftar');
                    redirect('pendaftar');
                }
            } else {
                $this->toastr->success('Anda Diterima');
                redirect('pendaftar');
            }
        } else {
            $this->toastr->error('Anda Tidak DIterima');
            redirect('pendaftar');
        }
    }

    function listDivisi($id_bidang){
        $data = $this->model_user->getDivisibyBidang($id_bidang);
        echo json_encode($data);
    }

    // SPK SPK SPK SPK SPK

    public function profil_calon()
    {
        $data["calon"] = $this->model_pemira->getCalon();
        $this->load->view('Pendaftar/profil_calon', $data);
    }

    public function detail_calon($nim)
    {
        $data["calon"] = $this->db->get_where('calon_ketua', ["nim" => $nim])->row();
        $this->load->view('Pendaftar/detail_calon', $data);
    }

    public function review_calon()
    {
        $this->load->view('Pendaftar/review');
    }

    public function spk()
    {
        $this->load->view('Pendaftar/spk');
    }
    
}