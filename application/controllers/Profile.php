<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model(array('model_user'));
        cek_session();
     }

	public function index()
	{
        if($this->session->userdata('jabatan')=="Pendamping"){
            $this->load->view('Profile/profile_dosen');
        }else if($this->session->userdata('jabatan')!=""){
            $this->load->view('Profile/profile');
        }else{
            $data["info"] = $this->db->get_where('pendaftaran', ["id" => "pendaftaran"])->row();
            $this->load->view('Profile/profile',$data);
        }
    }

    function editprofile(){
        if(isset($_POST['edit_profil'])){
            if($this->model_user->editProfile()){
                $this->toastr->success('Berhasil mengupdate profil');
            }else{
                $this->toastr->error('Gagal mengupdate profil');
            }
            redirect('Profile');
        }
        if(isset($_POST['edit_profil_dosen'])){
            if($this->model_user->editProfileDosen()){
                $this->toastr->success('Terima kasih profil berhasil diupdate');
            }else{
                $this->toastr->error('Maaf profil gagal diupdate');
            }
            redirect('Profile');
        }
    }

    function ganti_pass(){
        if(isset($_POST['gantipass'])){
            $username = $this->session->userdata('username');
            $old = md5($this->input->post('oldpass'));
            $new = md5($this->input->post('newpass'));
            $query = "SELECT pwd_hash FROM user WHERE username = '$username'";
            $cek = $this->db_master->query($query)->row();
            if($cek->pwd_hash!=$old){
                $this->toastr->error('Password lama salah');
            }else{
                $this->db_master->update('user', array('pwd_hash' => $new), array('username' => $username));
                $this->toastr->success('Berhasil ganti password');
            }
            redirect('Profile');
        }
    }

    function cek_email(){
        if(isset($_POST['email'])){
            $email = $_POST['email'];
            $user = $this->session->userdata('username');
        
            $query = $this->db->query("SELECT email FROM user WHERE email = '$email' AND username != '$user'");
            $cekEmail = $query->row();
        
            if($cekEmail){
                $response = array('valid' => false, 'message' => 'Email already registered');
            }else{
                $response = array('valid' => true);
            }
        }
        echo json_encode($response);
    }

    
}