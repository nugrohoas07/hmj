<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user', 'model_proker', 'model_dana', 'model_surat'));
        $this->load->library('form_validation');
        cek_session();
    }

    public function index()
    {
        $user = $this->session->userdata('username');
        if ($this->model_proker->getIdProker($this->session->userdata('username')) != null) {
            $user = $this->model_proker->getIdProker($user)->id_proker;
        }
        $data["surat"] = $this->model_surat->getSurat($user);
        $data["saldo"] = $this->model_dana->getDana($user);
        
        //OJOK DIBUSEK
        $data['progress'] = $this->model_proker->getStaffProgress()->num_rows();//OJOK DIBUSEK
        $this->load->view('Staff/index',$data);
    }
    
    public function format()
    {
        $data['format'] = $this->db->get('format_surat')->result();
        $this->load->view('Staff/format', $data);
    }

    public function dana()
    {
        $user = $this->session->userdata('username');
        if ($this->model_proker->getIdProker($user) !== null) {
            $user = $this->model_proker->getIdProker($user)->id_proker;
        } else {
            $this->toastr->error('Proker Belum Aktif');
            redirect('staff');
        }
        $now = date('Y-m-d H:i:s');
        $sumber = "HMJ";

        if (isset($_POST['ajukan'])) {
            $post = $this->input->post();
            $tanggal = $post["tanggal"];
            $keperluan = $post["keperluan"];
            $pengeluaran = $post["pengeluaran"];
            $data = [
                'id_proker' => $user,
                'tanggal' => $tanggal,
                'keperluan' => $keperluan,
                'pengeluaran' => $pengeluaran,
                'sumber' => $sumber,
                'tgl_ajukan' => $now
            ];
            if($this->model_dana->ajukanDana($data)){
            $this->toastr->success('Berhasil Mengajukan Dana');
            }else{
            $this->toastr->error('Gagal Mengajukan Dana');
            }
            redirect('staff/dana');
        } elseif (isset($_POST['edit'])) {
            $post = $this->input->post();
            $id_saldo = $post["id_saldo"];
            $tanggal = $post["tanggal"];
            $keperluan = $post["keperluan"];
            $pengeluaran = $post["pengeluaran"];
            $data = [
                'tanggal' => $tanggal,
                'keperluan' => $keperluan,
                'pengeluaran' => $pengeluaran,
                'tgl_ajukan' => $now
            ];
            if($this->model_dana->editDana($data, $id_saldo)){
            $this->toastr->info('Edit Pengajuan Dana Berhasil');
            }else{
            $this->toastr->error('Edit Pengajuan Dana Gagal');
            }
            redirect('staff/dana');
        } elseif (isset($_POST['hapus'])) {
            $id_saldo = $this->input->post('id_saldo');
            if($this->model_dana->hapusDana($id_saldo)){
            $this->toastr->success('Hapus Pengajuan Dana Berhasil');
            }else{
            $this->toastr->error('Hapus Pengajuan Dana Gagal');
            }
            redirect('staff/dana');
        } elseif (isset($_POST['ulang'])) {
            $id_saldo = $this->input->post('id_saldo');
            $data = [
                'id_saldo' => $id_saldo,
                'status' => '0',
                'tgl_ajukan' => $now,
                'ulang' => 1
            ];
            if($this->model_dana->ajukanDana($data)){
            $this->toastr->success('Berhasil Mengajukan Ulang Dana');
            }else{
            $this->toastr->error('Gagal Mengajukan Ulang Dana');
            }
            redirect('staff/dana');
        }
        $data["saldo"] = $this->model_dana->getDana($user);
        $this->load->view('Staff/dana', $data);
    }

    public function addDana()
    {
        $this->load->view("Staff/add_dana");
    }

    public function panitia()
    {
        if ($this->model_proker->getIdProker($this->session->userdata('username')) !== null) {
            
        if (isset($_POST['upload'])) {
            if ($this->model_proker->uploadPanitia()) {
                $this->toastr->success('Berhasil mengupload file panitia');
            } else {
                $this->toastr->error('Gagal mengupload file panitia');
            }
            redirect(site_url('Staff/panitia'));
        }
        if (isset($_POST['hapus'])) {
            if ($this->model_proker->deletePanitia()) {
                $this->toastr->success('Berhasil menghapus file panitia');
            } else {
                $this->toastr->error('Gagal menghapus file panitia');
            }
            redirect(site_url('Staff/panitia'));
        }
        $data['proker'] = $this->model_proker->getStaffProker();
        $this->load->view("Staff/panitia", $data);
        } else {
            $this->toastr->error('Proker Belum Aktif');
            redirect('staff');
        }
    }

    public function surat()
    {
        // $name = $this->session->userdata('username');
        // // $user = $this->model_proker->getIdProker($name);
        // $user = $this->model_proker->getIdProker($name)->id_proker;
        $user = $this->session->userdata('username');
        if ($this->model_proker->getIdProker($user) !== null) {
            $user = $this->model_proker->getIdProker($user)->id_proker;
        } else {
            $this->toastr->error('Proker Belum Aktif');
            redirect('staff');
        }

        if (isset($_POST['simpan'])) {
            if ($this->model_surat->addSurat($user)) {
                $this->toastr->success('Berhasil Mengajukan');
            } else {
                $this->toastr->error('Gagal Mengajukan');
            }
            redirect('staff/surat');
        } elseif (isset($_POST['edit'])) {
            if ($this->model_surat->editSurat()) {
                $this->toastr->info('Edit Berhasil');
            } else {
                $this->toastr->error('Gagal Mengupdate');
            }
            redirect('staff/surat');
        } elseif (isset($_POST['hapus'])) {
            if ($this->model_surat->hapusSurat()) {
                $this->toastr->error('Hapus Berhasil');
            } else {
                $this->toastr->error('Gagal Menghapus');
            }
            redirect('staff/surat');
        } elseif (isset($_POST['ajukan'])) {
            if ($this->model_surat->ajukanSurat()) {
                $this->toastr->success('Berhasil Mengajukan Ulang');
            } else {
                $this->toastr->error('Gagal Mengajukan Ulang');
            }
            redirect('staff/surat');
        }

        $data["surat"] = $this->model_surat->getSurat($user);
        $this->load->view('Staff/surat', $data);
    }

    public function addSurat()
    {
        $this->load->view("Staff/add_surat");
    }

    public function laporan()
    {
        if ($this->model_proker->getIdProker($this->session->userdata('username')) !== null) {
        if (isset($_POST['upload_eva'])) {
            if ($this->model_proker->uploadEvaluasi()) {
                $this->toastr->success('Berhasil mengupload file evaluasi');
            } else {
                $this->toastr->error('Gagal mengupload file evaluasi');
            }
            redirect(site_url('Staff/laporan'));
        }
        if (isset($_POST['hapus_eva'])) {
            if ($this->model_proker->deleteEvaluasi()) {
                $this->toastr->success('Berhasil menghapus file evaluasi');
            } else {
                $this->toastr->error('Gagal menghapus file evaluasi');
            }
            redirect(site_url('Staff/laporan'));
        }
        if (isset($_POST['upload_lap'])) {
            if ($this->model_proker->uploadLpj()) {
                $this->toastr->success('Berhasil mengupload file laporan');
            } else {
                $this->toastr->error('Gagal mengupload file laporan');
            }
            redirect(site_url('Staff/laporan'));
        }
        if (isset($_POST['hapus_lap'])) {
            if ($this->model_proker->deleteLpj()) {
                $this->toastr->success('Berhasil menghapus file laporan');
            } else {
                $this->toastr->error('Gagal menghapus file laporan');
            }
            redirect(site_url('Staff/laporan'));
        }
        if (isset($_POST['ulang_lap'])) {
            $ulang = $this->db->update('proker', array('lpj_sekum' => "0", 'lpj_bendum' => "0", 'lpj_kabid' => "0", 'lpj_kadiv' => "0"), array('id_proker' => $this->input->post('id_proker')));
            if ($ulang) {
                $this->toastr->success('Laporan berhasil diajukan ulang');
            } else {
                $this->toastr->error('Laporan gagal diajukan ulang');
            }
            redirect(site_url('Staff/laporan'));
        }
        $data['proker'] = $this->model_proker->getStaffProker();
        $this->load->view("Staff/laporan", $data);
        } else {
            $this->toastr->error('Proker Belum Aktif');
            redirect('staff');
        }
    }

    public function progress()
    {
        if ($this->model_proker->getIdProker($this->session->userdata('username')) !== null) {
        if (isset($_POST['tambah'])) {
            if ($this->model_proker->inputProgress()) {
                $this->db->update('proker', array('status' => "2"), array('id_proker' => $this->input->post('proker')));
                $this->toastr->success('Berhasil menambahkan progress');
            } else {
                $this->toastr->error('Gagal menambahkan progress');
            }
            redirect(site_url('Staff/progress'));
        }
        if (isset($_POST['edit'])) {
            if ($this->model_proker->updateProgress()) {
                $this->toastr->success('Berhasil mengupdate progress');
            } else {
                $this->toastr->error('Gagal mengupdate progress');
            }
            redirect(site_url('Staff/progress'));
        }
        if (isset($_POST['hapus'])) {
            if ($this->model_proker->deleteProgress()) {
                $this->toastr->success('Berhasil menghapus progress');
            } else {
                $this->toastr->error('Gagal menghapus progress');
            }
            redirect(site_url('Staff/progress'));
        }
        $data["listprok"] = $this->model_proker->getProkerAktif();
        $data["progress"] = $this->model_proker->getStaffProgress()->result();
        $this->load->view("Staff/progress", $data);
        } else {
            $this->toastr->error('Proker Belum Aktif');
            redirect('staff');
        }
    }

    public function addProgress()
    {
        $data["proker"] = $this->model_proker->getProkerAktif();
        $this->load->view("Staff/add_progress", $data);
    }

    public function timeline()
    {
        $data["proker"] = $this->model_proker->getProker();
        $this->load->view('Staff/timeline', $data);
    }
}
