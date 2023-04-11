<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ketum extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user', 'model_proker', 'model_surat'));
        $this->load->library('form_validation');
        cek_session();
    }

    public function index()
    {
        $data['persetujuan'] = $this->model_surat->getPersetujuan($this->session->userdata('jabatan'));
        $data["pendaftar"] = $this->db->get_where('dokumen_user', array('status' => "0"))->num_rows();
        $data["proker"] = $this->model_proker->getProkerYear()->num_rows();
        $data["progress"] = $this->model_proker->getProgress();
        $this->load->view('Ketua Umum/index',$data);
    }

    function addProker()
    {
        $data["anggota"] = $this->model_user->getAnggota();
        $this->load->view('Ketua Umum/pengajuan_form', $data);
    }

    public function proker()
    {
        if (isset($_POST['tambah'])) {
            if ($this->model_proker->inputProker()) {
                $this->toastr->success('Berhasil mengajukan proker');
            } else {
                $this->toastr->error('Gagal mengajukan proker');
            }
            redirect(site_url('ketum/proker'));
        }
        if (isset($_POST['edit'])) {
            if ($this->model_proker->updateProker()) {
                $this->toastr->success('Berhasil mengupdate proker');
            } else {
                $this->toastr->error('Gagal mengupdate proker');
            }
            redirect(site_url('ketum/proker'));
        }
        if (isset($_POST['hapus'])) {
            if ($this->model_proker->deleteProker()) {
                $this->toastr->success('Berhasil menghapus proker');
            } else {
                $this->toastr->error('Gagal menghapus proker');
            }
            redirect(site_url('ketum/proker'));
        }
        if (isset($_POST['ulang'])) {
            if ($this->model_proker->verifProker("0")) {
                $this->toastr->success('Proker berhasil diajukan ulang');
            } else {
                $this->toastr->error('Proker gagal diajukan ulang');
            }
            redirect(site_url('ketum/proker'));
        }
        $data["anggota"] = $this->model_user->getAnggota();
        $data["proker"] = $this->model_proker->getProker();
        $this->load->view("Ketua Umum/pengajuan", $data);
    }

     public function persetujuan()
    {
        $user = $this->session->userdata('jabatan');
        if (isset($_POST['setuju'])) {
            if ($this->model_surat->addSetuju($user)) {
                $this->toastr->success('Telah Menyetujui');
            } else {
                $this->toastr->error('Gagal Menyetujui');
            }
            redirect('Ketum/persetujuan');
        } elseif (isset($_POST['tolak'])) {
            $this->model_surat->tolakPersetujuan($user);
            if ($this->toastr->error('Telah Menolak')) {
            } else {
                $this->toastr->error('Gagal Menolak');
            }
            redirect('Ketum/persetujuan');
        }
        $data['persetujuan'] = $this->model_surat->getPersetujuan($user);
        $this->load->view('Ketua Umum/persetujuan', $data);
    }

    public function timeline()
    {
        if (isset($_POST['edit'])) {
            if ($this->model_proker->updateProkerAll()) {
                $this->toastr->success('Berhasil mengupdate proker');
            } else {
                $this->toastr->error('Gagal mengupdate proker');
            }
            redirect('ketum/timeline');
        }
        if (isset($_POST['selesai'])) {
            if ($this->model_proker->verifProker("3")) {
                $this->toastr->success('Status proker selesai');
            } else {
                $this->toastr->error('Gagal mengubah status proker');
            }
            redirect('ketum/timeline');
        }
        $data["anggota"] = $this->model_user->getAnggota();
        $data["proker"] = $this->model_proker->getProker();
        $this->load->view('Ketua Umum/timeline', $data);
    }

    public function progress()
    {
        $data["progress"] = $this->model_proker->getProgress();
        $this->load->view('Ketua Umum/progress', $data);
    }

    public function lpj()
    {
        $user = $this->session->userdata('username');
        $masuk = $this->db->select('*, YEAR(masuk) AS tahun_masuk')->get_where('user', ['username' => $user])->row_array();
        $tahun = (int)$masuk['tahun_masuk'] + 1;
        $usertahun = ['user' => $user, 'tahun' => $tahun];
        $id_lpj = $this->input->post('id_lpj');

        if (isset($_POST['simpan'])) {
            if ($this->model_user->addLpj($usertahun)) {
                $this->db->where('YEAR(masuk)', $masuk['tahun_masuk']);
                $this->db->where('status', '1');
                $this->db->set('status', '3');
                $this->db->update('user');

                $this->toastr->success('Berhasil Menambah LPJ');
                redirect('home/logout');
            } else {
                $this->toastr->error('Gagal Menambah LPJ');
                redirect('ketum/addLpj');
            }
        } elseif (isset($_POST['edit'])) {
            $this->model_user->editLpj($id_lpj);
            redirect('ketum/lpj');
        } elseif (isset($_POST['hapus'])) {
            $this->model_user->hapusLpj($id_lpj);
            $this->toastr->error('Hapus LPJ Berhasil');
            redirect('ketum/lpj');
        }
        $data['lpjproker'] = $this->db->get_where('proker', ['lpj_kadiv' => '1'])->result();
        $data['lpj'] = $this->db->get_where('lpj', ['tahun' => $tahun])->result();
        $data['ketum'] = $this->db->get_where('lpj', ['tahun' => $tahun, 'username' => $user])->result();
        $this->load->view('Ketua Umum/lpj', $data);
    }

    public function addLpj()
    {
        if($this->model_user->getKahimBaru($this->session->userdata('username')) == null){
            $this->toastr->error('Ketua Umum Baru Belum Ditentukan');
            redirect('ketum/lpj');
        }
        else{
            $this->load->view('Ketua Umum/lpj_tambah');
        }
    }

    public function rekrut(){
        if ($this->model_user->nilaiPendaftar()) {
            $pendaftar = $this->model_user->getPendaftar();
            $saw='';
        } elseif(!$this->model_user->isiNilaiWawancara() && !$this->model_user->isiTotalNilai()){
            $pendaftar = $this->model_user->totalNilai();
                $saw='sudah';
        }
        else {
            $pendaftar = $this->model_user->getPendaftar();
            $saw='wawancara';
            
            // foreach ($this->model_user->isiNilaiWawancara() as $row) {
            //         if ($row->nilai_organisasi != null && $row->nilai_penalaran != null && $row->nilai_kesejahteraan != null && $row->nilai_bakat != null && $row->nilai_pengabdian != null) {
            //         // if ($row->nilai_organisasi != null && $row->nilai_penalaran != null && $row->nilai_kesejahteraan != null && $row->nilai_bakat != null && $row->nilai_pengabdian != null && $row->nilai_ketum != null) {
                        
            //             $data = [
            //                     'id' => $row->id_dokumen,
            //                     'nilai_oka' => $row->nilai_organisasi,
            //                     'nilai_pk' => $row->nilai_penalaran,
            //                     'nilai_ksj' => $row->nilai_kesejahteraan,
            //                     'nilai_bakmin' => $row->nilai_bakat,
            //                     'nilai_pengmas' => $row->nilai_pengabdian,
            //                     // 'nilai_ketum' => $row->nilai_ketum
            //                 ];
                        
            //             $this->model_user->total_wawancara($data);
            //         }
            // }
            
            // foreach ($this->model_user->isiTotalNilai() as $row) {
            //             if ($row->krs != null) {
            //                 $krs = 1;
            //             } else {
            //                 $krs = 0;
            //             }
            //             if ($row->karya != null) {
            //                 $karya = 1;
            //             } else {
            //                 $karya = 0;
            //             }
            //             if ($row->pkkmb != null) {
            //                 $pkkmb = 1;
            //             } else {
            //                 $pkkmb = 0;
            //             }
                
            //         $data = [
            //                     'id' => $row->id_dokumen,
            //                     'pkkmb' => $pkkmb,
            //                     'krs' => $krs,
            //                     'karya' => $karya,
            //                     'total_wawancara' => $row->nilai_wawancara
            //                 ];
            //         $this->model_user->nilai_saw($data);
            // }
            
            // $pendaftar = $this->model_user->totalNilai();
            // $saw='sudah';
            
            // // $saw='wawancara';
            
            // if(!$this->model_user->isiNilaiWawancara() && !$this->model_user->isiTotalNilai()){
            //     $pendaftar = $this->model_user->totalNilai();
            //     $saw='sudah';
            // }
            
            // if($this->model_user->isiNilaiWawancara()==null && $this->model_user->isiTotalNilai()==null){
            //     $saw='';
            // }
            // else{
            //     $saw='sudah';
            // }
        }

        if (isset($_POST['nilai'])) {//yang akan digunakan proses hitung saw
            foreach ($this->model_user->isiNilaiWawancara() as $row) {
            //         if ($row->nilai_organisasi != null && $row->nilai_penalaran != null && $row->nilai_kesejahteraan != null && $row->nilai_bakat != null && $row->nilai_pengabdian != null) {
                        $data = [
                                'id' => $row->id_dokumen,
                                'nilai_oka' => $row->nilai_organisasi,
                                'nilai_pk' => $row->nilai_penalaran,
                                'nilai_ksj' => $row->nilai_kesejahteraan,
                                'nilai_bakmin' => $row->nilai_bakat,
                                'nilai_pengmas' => $row->nilai_pengabdian,
                                // 'nilai_ketum' => $row->nilai_ketum
                            ];
                        
                        $this->model_user->total_wawancara($data);
            //         }
            }
            
            foreach ($this->model_user->isiTotalNilai() as $row) {
                        if ($row->krs != null) {
                            $krs = 1;
                        } else {
                            $krs = 0;
                        }
                        if ($row->karya != null) {
                            $karya = 1;
                        } else {
                            $karya = 0;
                        }
                        if ($row->pkkmb != null) {
                            $pkkmb = 1;
                        } else {
                            $pkkmb = 0;
                        }
                
                    $data = [
                                'id' => $row->id_dokumen,
                                'pkkmb' => $pkkmb,
                                'krs' => $krs,
                                'karya' => $karya,
                                'total_wawancara' => $row->nilai_wawancara
                            ];
                    $this->model_user->nilai_saw($data);
            }
            $this->toastr->success('Perhitungan SAW Berhasil');
            redirect('ketum/rekrut');
            
            // $pendaftar = $this->model_user->totalNilai();
            // $saw='sudah';
        }
        // if (isset($_POST['nilai'])) {
        //     if ($this->model_user->nilai_wawancara('ketum')) {
        //         $this->toastr->success('Berhasil Menilai Wawancara');
        //     } else {
        //         $this->toastr->error('Gagal Menilai Wawancara');
        //     }
        //     redirect('ketum/rekrut');
        // }
        if (isset($_POST['terima'])) {
            $post = $this->input->post();
            $this->status = "2";
            $date = date('Y-m-d H:i:s');
            $terima = $this->db->update('dokumen_user', $this, array('id_dokumen' => $post['id_dok']));
            $staff = [
                'jabatan' => '1',
                'masuk' => $date,
                'status' => '1'
            ];
            $aktif = $this->db->update('user', $staff, array('username' => $post['username']));;
            if ($terima && $aktif) {
                $this->toastr->success('Berhasil menerima pendaftar');
            } else {
                $this->toastr->error('Gagal menerima pendaftar');
            }
            redirect('ketum/rekrut');
        }
        if (isset($_POST['tolak'])) {
            $post = $this->input->post();
            $this->status = "1";
            $this->keterangan = $post['alasan'];
            $tolak = $this->db->update('dokumen_user', $this, array('id_dokumen' => $post['id_dok']));
            if ($tolak) {
                $this->toastr->success('Berhasil menolak pendaftar');
            } else {
                $this->toastr->error('Gagal menolak pendaftar');
            }
            redirect('ketum/rekrut');
        }
        if (isset($_POST['pendaftaran'])) {
            if ($this->model_user->setPendaftaran()) {
                $this->toastr->success('Berhasil mengupdate jadwal pendaftaran');
            } else {
                $this->toastr->error('Gagal mengupdate jadwal pendaftaran');
            }
            redirect('ketum/rekrut');
        }
        $data["saw"] = $saw;
        $data["pendaftar"] = $pendaftar;
        $data["pendaftaran"] = $this->db->get_where('pendaftaran', ["id" => "pendaftaran"])->row();
        $data["list_bidang"] = $this->model_user->getAllBidang();
        $this->load->view("Ketua Umum/recruitment", $data);
    }

    public function anggota(){
        if(isset($_POST['edit'])){
            if($this->model_user->updateAnggota()){
                $this->toastr->success('Berhasil mengupdate anggota');
            }else{
                $this->toastr->error('Gagal mengupdate anggota');
            }
            redirect('Ketum/anggota');
        }
        $data["anggota"] = $this->model_user->getAnggotaAktif();
        $data["list_jabatan"] = $this->model_user->getAllJabatan();
        $data["list_bidang"] = $this->model_user->getAllBidang();
        $this->load->view("Ketua Umum/manage_anggota",$data);
    }

    function listDivisi($id_bidang)
    {
        $data = $this->model_user->getDivisibyBidang($id_bidang);
        echo json_encode($data);
    }

    function download($dir, $file)
    {
        force_download('./upload/' . $dir . '/' . $file, NULL);
    }
}
