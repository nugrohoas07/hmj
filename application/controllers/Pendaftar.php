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
        $data["calon"] = $this->model_pemira->getCalonThisYear();
        $this->load->view('Pendaftar/profil_calon', $data);
    }

    public function detail_calon($nim)
    {
        $data["calon"] = $this->model_pemira->getSpesificCalon($nim);
        $this->load->view('Pendaftar/detail_calon', $data);
    }

    public function review_calon($nim)
    {
        $data["calon"] = $this->model_pemira->getSpesificCalon($nim);
        $data["kriteria"] = $this->model_pemira->getKriteria();
        $data["komentar"] = $this->model_pemira->getKomentarByUser($nim);
        $data["nilai"] = $this->model_pemira->getNilaiByUser($nim);
        $this->load->view('Pendaftar/review', $data);
    }

    public function input_ulasan()
    {
        if (isset($_POST['simpan'])) {
            $this->model_pemira->inputReviewCalon();
            if ($this->toastr->success('Berhasil Review')) {
            } else {
                $this->toastr->error('Gagal Review');
            }
            redirect('Pendaftar/profil_calon');
        }
    }

    public function kriteria_bobot()
    {
        $data["kriteria"] = $this->model_pemira->getKriteria();
        $data["myKriteria"] = $this->model_pemira->getMyKriteria();
        $this->load->view('Pendaftar/kriteria_bobot', $data);
    }

    public function input_bobot()
    {
        if (isset($_POST['simpan'])) {
            $this->model_pemira->inputBobot();
            if ($this->toastr->success('Berhasil Bobot')) {
            } else {
                $this->toastr->error('Gagal Bobot');
            }
            redirect('Pendaftar/spk');
        }
    }

    function spk()
    {
        $data["calon"] = $this->model_pemira->getCalonThisYear();
        $data["myKriteria"] = $this->model_pemira->getMyKriteria();
        $this->load->view('Pendaftar/spk', $data);
    }

    public function get_bobot_usr($id_kriteria)
    {
        $bobotData = $this->model_pemira->getBobotByUser($id_kriteria);
        if ($bobotData) {
            // Prepare the data as JSON
            $jsonResponse = json_encode(array('bobot_value' => $bobotData->bobot));
            
            // Set the response content type to JSON
            $this->output->set_content_type('application/json');
            
            // Output the JSON response
            $this->output->set_output($jsonResponse);
        } else {
            // Data not found, return an empty JSON response
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode(array('bobot_value' => '')));
        }
    }
}