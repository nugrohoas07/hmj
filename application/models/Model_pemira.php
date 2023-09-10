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
    function getSpesificCalon($nim)
    {
        return $this->db->get_where('calon_ketua', ["nim" => $nim])->row();
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
        $this->pemilihan_akhir = $post["pemilihan_end"];
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

    function getKriteria()
    {
        return $this->db->get('kriteria')->result();
    }
    
    function inputReviewCalon()
    {
        $post = $this->input->post();
        $id_user = $this->session->userdata("username");
        $id_calon = $post["id_calon"];
        $id_kriteria = $post["id_kriteria"];
        $nilai_kriteria = $post["nilai_kriteria"];
        $komentar = $post["komentar"];
        $anonim = isset($_POST['anonim']) ? 1 : 0;
        foreach($id_kriteria as $key => $id)
        {
            if(!empty($nilai_kriteria[$key]))
            {
                $data = array(
                    'id_user' => $id_user,
                    'id_calon' => $id_calon,
                    'id_kriteria' => $id,
                    'nilai' => $nilai_kriteria[$key]
                );
                if($this->cekNilai($id_user,$id_calon,$id))
                {
                    $this->db->where('id_user', $id_user);
                    $this->db->where('id_calon', $id_calon);
                    $this->db->where('id_kriteria', $id);
                    $this->db->update('nilai_calon', $data);
                }else {
                    $this->db->insert('nilai_calon', $data);
                }
            }else {
                if($this->cekNilai($id_user,$id_calon,$id)){
                    $this->db->where('id_user', $id_user);
                    $this->db->where('id_calon', $id_calon);
                    $this->db->where('id_kriteria', $id);
                    $this->db->delete('nilai_calon');
                }
            }
        }
        if(!empty($komentar))
        {
            $komen = array(
                'id_user' => $id_user,
                'id_calon' => $id_calon,
                'komentar' => $komentar,
                'anonim' => $anonim
            );
            if($this->cekReview($id_user, $id_calon))
            {
                $this->db->where('id_user', $id_user);
                $this->db->where('id_calon', $id_calon);
                $this->db->update('komentar', $komen);
            }else {
                return $this->db->insert('komentar', $komen);
            }
        }else {
            if($this->cekReview($id_user, $id_calon))
            {
                $this->db->where('id_user', $id_user);
                $this->db->where('id_calon', $id_calon);
                $this->db->delete('komentar');
            }
        }
    }

    function cekNilai($user_id, $calon_id, $id_kriteria)
    {
        $this->db->where('id_user', $user_id);
        $this->db->where('id_calon', $calon_id);
        $this->db->where('id_kriteria', $id_kriteria);
        $result = $this->db->get('nilai_calon');
        return $result->num_rows() > 0 ? true : false;
    }

    function cekReview($user_id, $calon_id)
    {
        $this->db->where('id_user', $user_id);
        $this->db->where('id_calon', $calon_id);
        $result = $this->db->get('komentar');
        return $result->num_rows() > 0 ? true : false;
    }

    function getKomentarByUser($calon_id)
    {
        $user_id = $this->session->userdata("username");
        $this->db->where('id_user', $user_id);
        $this->db->where('id_calon', $calon_id);
        return $this->db->get('komentar')->row();
    }

    function getNilaiByUser($calon_id)
    {
        $user_id = $this->session->userdata("username");
        $this->db->where('id_user', $user_id);
        $this->db->where('id_calon', $calon_id);
        return $this->db->get('nilai_calon')->result();
    }

    function inputBobot()
    {
        $post = $this->input->post();
        $user_id = $this->session->userdata("username");
        $id_kriteria = $post["id_kriteria"];
        $bobot = $post["bobot"];
        foreach($id_kriteria as $krit => $id)
        {
            $data = array (
                'id_user' => $user_id,
                'id_kriteria' => $id,
                'bobot' => $bobot[$krit]
            );
            $this->db->insert('bobot', $data);
        }
    }
}
