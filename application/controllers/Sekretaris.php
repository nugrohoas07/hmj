<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sekretaris extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user', 'model_proker', 'model_surat', 'model_pemira'));
        $this->load->library('form_validation');
        cek_session();
    }

    public function index()
    {
        $data['persetujuan'] = $this->model_surat->getPersetujuan($this->session->userdata('jabatan'));
        $data['rekap'] = $this->model_surat->getRekap($this->session->userdata('jabatan'));
        $data['format'] = $this->model_surat->getFormat($this->session->userdata('jabatan'));
        $data["log_progress"] = $this->model_proker->getProgress($this->session->userdata('jabatan'));
        $this->load->view('Sekretaris/index', $data);
    }

    public function persetujuan()
    {
        $user = $this->session->userdata('jabatan');
        if (isset($_POST['setuju'])) {
            if ($this->model_surat->addSetuju($user)) {
                $this->toastr->success('Telah Menyetujui');
            } else {
                $this->toastr->error('Laporan Gagal Disetujui');
            }
            redirect('sekretaris/persetujuan');
        }
        if (isset($_POST['tolak'])) {
            if ($this->model_surat->tolakPersetujuan($user)) {;
                $this->toastr->error('Telah Menolak');
            } else {
                $this->toastr->error('Laporan Gagal Ditolak');
            }
            redirect('sekretaris/persetujuan');
        }
        $data['persetujuan'] = $this->model_surat->getPersetujuan($user);
        $this->load->view('Sekretaris/persetujuan', $data);
    }


    public function progress()
    {
        $data['progress'] = $this->model_proker->getProgress();
        $this->load->view('Sekretaris/progress', $data);
    }

    public function laporan()
    {
        if (isset($_POST['setuju'])) {
            if ($this->model_proker->VerifLPJ()) {
                $this->toastr->success('Laporan berhasil disetujui');
            } else {
                $this->toastr->error('Laporan Gagal Disetujui');
            }
            redirect(site_url('Sekretaris/laporan'));
        }
        if (isset($_POST['tolak'])) {
            if ($this->model_proker->VerifLPJ()) {
                $this->toastr->success('Laporan Telah Ditolak');
            } else {
                $this->toastr->error('Laporan Gagal Ditolak');
            }
            redirect(site_url('Sekretaris/laporan'));
        }
        $this->db->where('lpj !=', "");
        $data['proker'] = $this->model_proker->getProker();
        $this->load->view('Sekretaris/laporan', $data);
    }

    public function lpj()
    {
        $user = $this->session->userdata('username');
        $id_lpj = $this->input->post('id_lpj');
        if (isset($_POST['simpan'])) {
            if ($this->model_user->addLpj($user)) {
                $this->toastr->success('Berhasil Menambah LPJ');
                redirect('Sekretaris/lpj');
            } else {
                $this->toastr->error('Gagal Menambah LPJ');
                redirect('Sekretaris/addLpj');
            }
        } elseif (isset($_POST['edit'])) {
            $this->model_user->editLpj($id_lpj);
            // $this->toastr->info('Edit LPJ Berhasil');
            redirect('Sekretaris/lpj');
        } elseif (isset($_POST['hapus'])) {
            $this->model_user->hapusLpj($id_lpj);
            $this->toastr->error('Hapus LPJ Berhasil');
            redirect('Sekretaris/lpj');
        }
        $data['lpj'] = $this->db->get_where('lpj', ['username' => $user])->result();
        $this->load->view('Sekretaris/lpj', $data);
    }

    public function addLpj()
    {
        $this->load->view('Sekretaris/lpj_tambah');
    }

    public function format_surat()
    {
        if (isset($_POST['simpan'])) {
            $this->model_surat->addFormat();
            if ($this->toastr->success('Berhasil Menambah')) {
            } else {
                $this->toastr->error('Gagal Menambah');
            }
            redirect('sekretaris/format_surat');
        } elseif (isset($_POST['edit'])) {
            $this->model_surat->editFormat();
            if ($this->toastr->info('Edit Berhasil')) {
            } else {
                $this->toastr->error('Gagal Mengupdate');
            }
            redirect('sekretaris/format_surat');
        } elseif (isset($_POST['hapus'])) {
            $this->model_surat->hapusFormat();
            if ($this->toastr->error('Hapus Berhasil')) {
            } else {
                $this->toastr->error('Gagal Menghapus');
            }
            redirect('sekretaris/format_surat');
        }
        $data['format'] = $this->model_surat->getFormat();
        $this->load->view('Sekretaris/format_persuratan', $data);
    }

    public function addFormat()
    {
        $this->load->view('Sekretaris/add_format');
    }

    public function rekap_surat()
    {
        if (isset($_POST['simpan'])) {
            $this->model_surat->addRekap();
            if ($this->toastr->success('Berhasil Menambah')) {
            } else {
                $this->toastr->error('Gagal Menambah');
            }
            redirect('sekretaris/rekap_surat');
        } elseif (isset($_POST['edit'])) {
            $this->model_surat->editRekap();
            if ($this->toastr->info('Edit Berhasil')) {
            } else {
                $this->toastr->error('Gagal Mengupdate');
            }
            redirect('sekretaris/rekap_surat');
        } elseif (isset($_POST['hapus'])) {
            $this->model_surat->hapusRekap();
            if ($this->toastr->error('Hapus Berhasil')) {
            } else {
                $this->toastr->error('Gagal Menghapus');
            }
            redirect('sekretaris/rekap_surat');
        }
        $data['rekap'] = $this->model_surat->getRekap();
        $this->load->view('Sekretaris/rekap_persuratan', $data);
    }
    public function addRekap()
    {
        $this->load->view('Sekretaris/add_rekap');
    }

    public function timeline()
    {
        $data["proker"] = $this->model_proker->getProker();
        $this->load->view('Sekretaris/timeline', $data);
    }

    // SAW
    
    public function detail_pemira()
    {
        if (isset($_POST['simpan'])) {
            $this->model_pemira->setPemira();
            if ($this->toastr->success('Berhasil Menambah')) {
            } else {
                $this->toastr->error('Gagal Menambah');
            }
            redirect('sekretaris/detail_pemira');
        }
        $data["pemira"] = $this->db->get_where('pemira', ["YEAR(waktu_input)" => date('Y')])->row();
        $this->load->view('Sekretaris/detail_pemira', $data);
    }

    public function profil_calon()
    {

        $data["calon"] = $this->model_pemira->getCalonThisYear();
        $this->load->view('Sekretaris/profil_calon', $data);
    }

    public function tambahCalon()
    {
        $this->load->view('Sekretaris/add_calon');
    }

    public function editCalon($nim)
    {
        $data["calon"] = $this->db->get_where('calon_ketua', ["nim" => $nim])->row();
        $this->load->view('Sekretaris/edit_calon', $data);
    }

    public function update_calon()
    {
        if (isset($_POST['simpan'])) {
            $this->model_pemira->inputCalon();
            if ($this->toastr->success('Berhasil Menambah')) {
            } else {
                $this->toastr->error('Gagal Menambah');
            }
            redirect('sekretaris/profil_calon');
        }
        if (isset($_POST['edit'])) {
            $this->model_pemira->editCalon();
            if ($this->toastr->success('Berhasil Edit Calon')) {
            } else {
                $this->toastr->error('Gagal Edit Calon');
            }
            redirect('sekretaris/profil_calon');
        }
        if (isset($_POST['hapus'])) {
            $this->model_pemira->hapusCalon();
            if ($this->toastr->success('Berhasil Menghapus')) {
            } else {
                $this->toastr->error('Gagal Menghapus');
            }
            redirect('sekretaris/profil_calon');
        }
    }


}
