<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("model_user");
        $this->load->library('form_validation');
        $this->db2 = $this->load->database('master', TRUE);
        cek_session_login();
    }

    // public function index()
    // {
    //     $this->load->driver("session");
    //     $this->load->helper(array('form', 'url', 'captcha', 'security', 'string'));

    //     $this->form_validation->set_rules('userCaptcha', 'Captcha', 'required|callback_cek_captcha');
    //     $cap = $this->create_captcha();
    //     $data['cap_img'] = $cap['image'];
        
    //     //inisialisasi
    //     $a = $b = $hasil = 0;
    //     $str = $cap['word'];

    //     //isi tiap bilangan
    //     if (is_int(strpos($str, '+'))) {
    //         $a = substr($str, 0, strpos($str, '+') - 1) + 0;
    //         $b = substr($str, strpos($str, '+') + 1, strlen($str) - strpos($str, '+')) + 0;
    //         $hasil = $a + $b;
    //     } else {
    //         if (is_int(strpos($str, '-'))) {
    //             $a = substr($str, 0, strpos($str, '-') - 1) + 0;
    //             $b = substr($str, strpos($str, '-') + 1, strlen($str) - strpos($str, '-')) + 0;
    //             $hasil = abs($a - $b);
    //         }
    //     }
    //     $cap['word'] = '' . $hasil;

    //     if ($this->form_validation->run() == false) {
    //         $this->session->set_userdata('userCaptcha', $cap['word']);
    //         $this->load->view('Loginpage/login', $data);
    //     } else {
    //         $this->session->unset_userdata('userCaptcha');
    //         $this->aksi_login();
    //     }
    // }

    public function create_captcha()
    {
        $vals = array(
            'img_path' => 'captcha/',
            'img_url' => base_url() . 'captcha/',
            'font_path' => FCPATH . 'captcha/font/1.ttf',
            'font_size' => 400,
            'img_width' => '150',
            'img_height' => 40,
            'expiration' => 7200,
            'word_length' => 1,
            'colors'        => array(
                'background' => array(184, 244, 255),
                'border' => array(0, 0, 0),
                'text' => array(0, 0, 0),
                'grid' => array(50, 244, 255)
            )
        );

        $operator = '+-';
        $str = '';

        do {
            $a = random_string('numeric', 1) + 0;
        } while ($a == 0);
        do {
            $b = random_string('numeric', 1) + 0;
        } while ($b > $a);

        // random operator
        $opr = substr($operator, mt_rand(0, strlen($operator) - 1), 1);

        // operasi hitung
        if ($opr == '+') {
            // $hasil = $a + $b;
            $str = $a . ' + ' . $b;
        } else {
            // $hasil = $a - $b;
            $str = $a . ' - ' . $b;
        }

        $vals['word'] = $str; //isi
        $cap = create_captcha($vals); //fx dg isi
        return $cap;
    }

    public function cek_captcha($input)
    {
        if ($input == $this->session->userdata('userCaptcha')) {
            return TRUE;
        } else {
            $this->form_validation->set_message('cek_captcha', '%s ' . ' Salah!');
            return FALSE;
        }
    }

    function index()
    // function aksi_login()
    {
        $this->load->driver("session");
        $this->load->helper(array('form', 'url', 'captcha', 'security', 'string'));
        if(isset($_POST['masuk'])){
            
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->db2->where('username', $username);
        $this->db2->where('pwd_hash', md5($password));
        $query = $this->db2->get('user');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $user = $this->model_user->getUser($username);
            if ($user) {
                $jabatan = $this->model_user->getJabatan($user->jabatan)->jabatan;
                $status = $user->status;
            } else {
                switch ($row->level) {
                    case "1":
                    case "2":
                        $status = "0";
                        break;
                    case "11":
                        $jabatan = "Pendamping";
                        $status = "1";
                        break;
                    default:
                        $this->toastr->error('Maaf anda tidak diijinkan masuk');
                        redirect('Login');
                        break;
                }
                $idJabatan = $this->model_user->getIdJabatan($jabatan)->id_jabatan;
                $data = array(
                    'username' => $row->username,
                    'nama' => $row->nama_lengkap,
                    'email' => $row->email,
                    'no_hp' => $row->no_hp,
                    'jabatan' => ($idJabatan) ? $idJabatan  : "",
                    'status' => $status
                );
                $this->model_user->update($data, $row->username);
            }

            $data_session = array(
                'hmj_login' => "1",
                'username' => $row->username,
                'nama' => $row->nama_lengkap,
                'level' => $row->level,
                'jabatan' => ($jabatan) ? $jabatan : null,
                'idjabatan' => ($user->jabatan) ? $user->jabatan : null,
                'status' => $status
            );
            $this->session->set_userdata($data_session);
            redirect('home');
        } else {
            redirect('login');
        }
    }
        $this->load->view('Loginpage/login');
    }
}
