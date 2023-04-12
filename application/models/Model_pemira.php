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
}
