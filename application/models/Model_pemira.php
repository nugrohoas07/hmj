<?php

class Model_pemira extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('model_user'));
        $this->db2 = $this->load->database('master', TRUE);
    }

    //mendapatkan calon tahun ini
    function getCalon()
    {
        $this->db->where('YEAR(waktu_input)', date('Y'));
        return $this->db->get('calon_ketua')->result();
    }

    //mendapatkan calon single
    function getSpesificCalon()
    {
        $this->db->where('YEAR(waktu_input)', date('Y'));
        return $this->db->get('calon_ketua')->result();
    }

    //menambahkan calon ketua
    function inputCalon()
    {
        $post = $this->input->post();
        $this->nama = $post["nama"];
        $this->nim = $post["nim"];
        $this->prodi = $post["prodi"];
        $this->angkatan = $post["angkatan"];
        $this->semester = $post["semester"];
        $this->ipk = $post["ipk"];
        $this->visi_misi = $post["vm"];
        $this->pengalaman_org = $post["po"];
        $this->foto = $this->_uploadFotoCalon();
        return $this->db->insert('calon_ketua', $this);
    }

    //mengedit data calon ketua
    public function editCalon()
    {
        $post = $this->input->post();
        $this->nama = $post["nama"];
        $this->nim = $post["nim"];
        $this->prodi = $post["prodi"];
        $this->angkatan = $post["angkatan"];
        $this->semester = $post["semester"];
        $this->ipk = $post["ipk"];
        $this->visi_misi = $post["vm"];
        $this->pengalaman_org = $post["po"];
        if ($_FILES['foto']['name'] == "") {
            $this->foto = $post["old_foto"];
        } else {
            $this->foto = $this->_uploadFotoCalon();
        }
        return $this->db->update('calon_ketua', $this, array('nim' => $post['nim']));
    }

    //menghapus calon
    function hapusCalon()
    {
        $post = $this->input->post();
        return $this->db->delete('calon_ketua', array("nim" => $post['nim']));
    }

    // upload foto calon
    private function _uploadFotoCalon()
    {
        $config = array();
        $config['upload_path']          = './upload/foto/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['file_name']            = $this->nim . "_FotoCalon";
        $config['overwrite']            = true;
        $config['max_size']             = 2048;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config, 'foto_upload');
        $this->foto_upload->initialize($config);
        if ($this->foto_upload->do_upload('foto')) {
            return $this->foto_upload->data("file_name");
        } else {
            $this->toastr->error('Gagal mengupload foto');
            redirect($this->uri->uri_string());
        }
    }

    //menambah/mengedit jadwal pemira
    function setPemira()
    { 
        $post = $this->input->post();
        $this->status = $post["status"];
        $this->kamp_tulis_awal = $post["ktulis_start"];;
        $this->kamp_tulis_akhir = $post["ktulis_end"];;
        $this->kamp_lisan = $post["klisan"];
        $this->lok_lisan = $post["lokasi_lisan"];
        $this->debat = $post["debat"];
        $this->lok_debat = $post["lokasi_debat"];
        $this->pemilihan = $post["pemilihan"];
        $this->lok_pemilihan = $post["lokasi_pemilihan"];
        $this->pengumuman = $post["pengumuman"];
        $this->keterangan = $post["info"];
        if ($this->db->get_where('pemira', array( 'YEAR(waktu_input)' => date('Y') ))->row()) {
            $this->db->where('YEAR(waktu_input)', date('Y'));
            return $this->db->update('pemira', $this);
        } else {
            return $this->db->insert('pemira', $this);
        }
    }

    //mendapatkan list semua proker
    public function getProker()
    {
        $this->db->order_by('tgl_pelaksanaan', 'DESC');
        return $this->db->get('proker')->result();
    }

    //mendapatkan list proker berdasarkan divisi user yang login
    public function getProkerbyDivisi()
    {
        $username = $this->session->userdata('username');
        $divisi = $this->model_user->getUser($username)->divisi;
        $this->db->where('divisi', $divisi);
        $this->db->order_by('tgl_pelaksanaan', 'DESC');
        $query = $this->db->get('proker');
        return $query;
    }

    //mendapatkan list proker berdasarkan bidang user yang login
    public function getProkerbyBidang()
    {
        $username = $this->session->userdata('username');
        $bidang = $this->model_user->getUser($username)->bidang;
        $this->db->where('bidang', $bidang);
        $this->db->order_by('tgl_pelaksanaan', 'DESC');
        $query = $this->db->get('proker');
        return $query;
    }

    //mendapatkan proker tahun ini
    function getProkerYear()
    {
        $this->db->where('status', "2");
        $this->db->where('YEAR(tgl_pelaksanaan)', date('Y'));
        $this->db->or_where('status', "3");
        return $this->db->get('proker');
    }

    //mendapatkan id proker dari username ketua
    function getIdProker($username)
    {
        return $this->db->get_where('proker', ['ketua' => $username])->row();
    }

    //mendapatkan data proker yg berasal dari id proker parameter
    public function getNamaProker($id_proker)
    {
        return $this->db->get_where('proker', array('id_proker' => $id_proker))->row();
    }

    //mendapatkan proker yang belum dikerjakan dan masih progress untuk staff
    public function getProkerAktif()
    {
        $username = $this->session->userdata('username');
        $this->db->where("(status='1' OR status='2') AND ketua ='$username' ");
        return $this->db->get('proker')->result();
    }

    //mendapatkan list semua progress
    public function getProgress()
    {
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get('log_progress')->result();
    }

    //mendapatkan list progress staff yang login
    public function getStaffProgress()
    {
        $username = $this->session->userdata('username');
        $this->db->select('*');
        $this->db->where('ketua', $username);
        $this->db->from('proker');
        $this->db->join('log_progress', 'proker.id_proker = log_progress.id_proker');
        $this->db->order_by('tanggal', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //mendapatkan progress berdasarkan divisi untuk kadiv
    public function getProgressbyDivisi()
    {
        $username = $this->session->userdata('username');
        $divisi = $this->model_user->getUser($username)->divisi;
        $this->db->select('*');
        $this->db->where('divisi', $divisi);
        $this->db->from('proker p');
        $this->db->join('log_progress l', 'p.id_proker = l.id_proker');
        $this->db->order_by('l.tanggal', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //mendapatkan progress berdasarkan bidang untuk kabid
    public function getProgressbyBidang()
    {
        $username = $this->session->userdata('username');
        $bidang = $this->model_user->getUser($username)->bidang;
        $this->db->select('*');
        $this->db->where('bidang', $bidang);
        $this->db->from('proker p');
        $this->db->join('log_progress l', 'p.id_proker = l.id_proker');
        $this->db->order_by('l.tanggal', 'DESC');
        $query = $this->db->get();
        return $query;
    }

    //mendapatkan list proker yang dikerjakan staff
    function getStaffProker()
    {
        $ketua = $this->session->userdata('username');
        $this->db->order_by('tgl_pelaksanaan', 'DESC');
        return $this->db->get_where('proker', array('ketua' => $ketua))->result();
    }

    //input pengajuan proker baru
    function inputProker()
    {
        $post = $this->input->post();
        $this->nama_proker = $post["namaproker"];
        $this->ketua = $post["ketua"];
        $this->bidang = $this->model_user->getUser($post["ketua"])->bidang;
        $this->divisi = $this->model_user->getUser($post["ketua"])->divisi;
        $this->tgl_pelaksanaan = $post["tglproker"];
        $this->tgl_selesai = $post["tglselesai"];
        $this->status = "0";
        return $this->db->insert('proker', $this);
    }

    //menolak atau menyetujui proker
    function verifProker($status)
    {
        $post = $this->input->post();
        $this->status = $status;
        return $this->db->update('proker', $this, array('id_proker' => $post['id_proker']));
    }

    //mengupdate sebagian data proker
    public function updateProker()
    {
        $post = $this->input->post();
        $this->nama_proker = $post["namaproker"];
        $this->ketua = $post["ketua"];
        $this->tgl_pelaksanaan = $post["tglproker"];
        $this->tgl_selesai = $post["tglselesai"];
        $this->bidang = $this->model_user->getUser($post["ketua"])->bidang;
        $this->divisi = $this->model_user->getUser($post["ketua"])->divisi;
        return $this->db->update('proker', $this, array('id_proker' => $post['id_proker']));
    }

    //mengupdate semua data proker
    public function updateProkerAll()
    {
        $post = $this->input->post();
        $this->nama_proker = $post["proker"];
        $this->ketua = $post["ketua"];
        $this->bidang = $this->model_user->getUser($post["ketua"])->bidang;
        $this->divisi = $this->model_user->getUser($post["ketua"])->divisi;
        $this->tgl_pelaksanaan = $post["tglproker"];
        $this->tgl_selesai = $post["tglselesai"];
        if ($_FILES['panitia']['name'] == "") {
            $this->panitia = $post["old_panitia"];
        } else {
            $this->panitia = $this->_uploadPanitia();
        }
        if ($_FILES['evaluasi']['name'] == "") {
            $this->evaluasi = $post["old_evaluasi"];
        } else {
            $this->evaluasi = $this->_uploadEvaluasi();
        }
        if ($_FILES['lpj']['name'] == "") {
            $this->lpj = $post["old_lpj"];
        } else {
            $this->lpj = $this->_uploadLpj();
        }
        return $this->db->update('proker', $this, array('id_proker' => $post['id_proker']));
    }

    //menghapus proker
    public function deleteProker()
    {
        $post = $this->input->post();
        return $this->db->delete('proker', array("id_proker" => $post['id_proker']));
    }

    //fungsi upload file kepanitiaan
    function uploadPanitia()
    {
        $post = $this->input->post();
        $this->nama_proker = $post["proker"];
        if ($_FILES['panitia']['name'] == "") {
            $this->panitia = $post["old_panitia"];
        } else {
            $this->panitia = $this->_uploadPanitia();
        }
        return $this->db->update('proker', $this, array('id_proker' => $post['id_proker']));
    }

    //fungsi proses upload file kepanitiaan
    private function _uploadPanitia()
    {
        $config = array();
        $config['upload_path']          = './upload/proker/';
        $config['allowed_types']        = 'jpg|jpeg|png|pdf|docx';
        $config['file_name']            = $this->nama_proker . "_Panitia";
        $config['overwrite']            = false;
        $config['max_size']             = 2048;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config, 'panitia_upload');
        $this->panitia_upload->initialize($config);
        if ($this->panitia_upload->do_upload('panitia')) {
            return $this->panitia_upload->data("file_name");
        } else {
            $this->toastr->error('Gagal mengupload file panitia');
            redirect($this->uri->uri_string());
        }
    }

    //hapus file kepanitiaan
    function deletePanitia()
    {
        $post = $this->input->post();
        $this->panitia = null;
        return $this->db->update('proker', $this, array('id_proker' => $post['id_proker']));
    }

    //fungsi upload file evaluasi
    function uploadEvaluasi()
    {
        $post = $this->input->post();
        $this->nama_proker = $post["proker"];
        if ($_FILES['evaluasi']['name'] == "") {
            $this->evaluasi = $post["old_evaluasi"];
        } else {
            $this->evaluasi = $this->_uploadEvaluasi();
        }
        return $this->db->update('proker', $this, array('id_proker' => $post['id_proker']));
    }

    //fungsi proses upload file evaluasi
    private function _uploadEvaluasi()
    {
        $config = array();
        $config['upload_path']          = './upload/proker/';
        $config['allowed_types']        = 'jpg|jpeg|png|pdf|docx';
        $config['file_name']            = $this->nama_proker . "_Evaluasi";
        $config['overwrite']            = false;
        $config['max_size']             = 2048;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config, 'evaluasi_upload');
        $this->evaluasi_upload->initialize($config);
        if ($this->evaluasi_upload->do_upload('evaluasi')) {
            return $this->evaluasi_upload->data("file_name");
        } else {
            $this->toastr->error('Gagal mengupload file evaluasi');
            redirect($this->uri->uri_string());
        }
    }

    //hapus file evaluasi
    function deleteEvaluasi()
    {
        $post = $this->input->post();
        $this->evaluasi = null;
        return $this->db->update('proker', $this, array('id_proker' => $post['id_proker']));
    }

    //fungsi upload file LPJ
    function uploadLpj()
    {
        $post = $this->input->post();
        $this->nama_proker = $post["proker"];
        $this->lpj_sekum = "0";
        $this->lpj_bendum = "0";
        $this->lpj_kabid = "0";
        $this->lpj_kadiv = "0";
        if ($_FILES['laporan']['name'] == "") {
            $this->lpj = $post["old_laporan"];
        } else {
            $this->lpj = $this->_uploadLpj();
        }
        return $this->db->update('proker', $this, array('id_proker' => $post['id_proker']));
    }

    //fungsi proses upload file LPJ
    private function _uploadLpj()
    {
        $id_bidang = $this->model_user->getUser($this->session->userdata('username'))->bidang;
        $id_divisi = $this->model_user->getUser($this->session->userdata('username'))->divisi;
        $bidang = $this->model_user->getBidang($id_bidang)->bidang;
        $divisi = $this->model_user->getDivisi($id_divisi)->divisi;

        $config = array();
        $config['upload_path']          = './upload/proker/';
        $config['allowed_types']        = 'docx';
        $config['file_name']            = "LPJ_(" . $bidang . ')_(' . $divisi . ')_(' . $this->nama_proker . ')';
        $config['overwrite']            = false;
        $config['max_size']             = 5120;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config, 'lpj_upload');
        $this->lpj_upload->initialize($config);
        if ($this->lpj_upload->do_upload('laporan')) {
            return $this->lpj_upload->data("file_name");
        } else {
            $this->toastr->error('Gagal mengupload file laporan');
            redirect($this->uri->uri_string());
        }
    }

    //hapus file LPJ
    function deleteLpj()
    {
        $post = $this->input->post();
        $this->lpj = null;
        $this->lpj_sekum = "0";
        $this->lpj_bendum = "0";
        $this->lpj_kabid = "0";
        $this->lpj_kadiv = "0";
        return $this->db->update('proker', $this, array('id_proker' => $post['id_proker']));
    }

    //verifikasi LPJ untuk bendahara hingga kadiv
    function verifLpj()
    {
        $post = $this->input->post();
        if ($post['jabatan'] == "Bendahara") {
            $this->lpj_bendum = $post['status'];
        } elseif ($post['jabatan'] == "Sekretaris") {
            $this->lpj_sekum = $post['status'];
        } elseif ($post['jabatan'] == "Ketua Bidang") {
            $this->lpj_kabid = $post['status'];
        } elseif ($post['jabatan'] == "Ketua Divisi") {
            $this->lpj_kadiv = $post['status'];
        }
        return $this->db->update('proker', $this, array('id_proker' => $post['id_proker']));
    }

    //input progress proker
    function inputProgress()
    {
        $post = $this->input->post();
        $this->id_proker = $post["proker"];
        $this->tanggal = $post["tgl"];
        $this->kegiatan = $post["kegiatan"];
        $this->kendala = $post["kendala"];
        return $this->db->insert('log_progress', $this);
    }

    //update progress proker
    function updateProgress()
    {
        $post = $this->input->post();
        $this->id_proker = $post["proker"];
        $this->tanggal = $post["tgl"];
        $this->kegiatan = $post["kegiatan"];
        $this->kendala = $post["kendala"];
        return $this->db->update('log_progress', $this, array('id_progress' => $post['id_progress']));
    }

    //menambahkan masukan oleh pendamping
    function updateMasukan()
    {
        $post = $this->input->post();
        $this->masukan = $post["masukan"];
        return $this->db->update('log_progress', $this, array('id_progress' => $post['id_progress']));
    }

    //menghapus progress
    function deleteProgress()
    {
        $post = $this->input->post();
        return $this->db->delete('log_progress', array("id_progress" => $post['id_progress']));
    }
}
