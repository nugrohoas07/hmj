<?php

class Model_Surat extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function addSurat($user)
    {
        $tanggal = $this->input->post('tanggal');
        $perihal = $this->input->post('perihal');
        $keterangan = $this->input->post('keterangan');

        $this->id_proker = $user;
        $this->tanggal = $tanggal;
        $this->perihal = $perihal;
        $this->keterangan = $keterangan;
        $this->lampiran = $this->_uploadSurat();

        return $this->db->insert('dokumen_proker', $this);
    }

    public function ajukanSurat()
    {
        $post = $this->input->post();
        $id_dokumen = $post['id_dokumen'];


        $this->db->where('id_dokumen', $id_dokumen);
        $this->db->set('status', '0');
        $this->db->set('no_surat', null);
        $this->db->set('tolak', null);
        return $this->db->update('dokumen_proker', $this);
    }


    public function editSurat()
    {
        $post = $this->input->post();
        $id_dokumen = $post['id_dokumen'];
        $tanggal = $post['tanggal'];
        $perihal = $post['perihal'];
        $keterangan = $post['keterangan'];
        // $status = $post['status'];

        if ($_FILES['lampiran']['name'] == "") {
            $lampiran = $post['lampiran_ada'];
        } else {
            $lampiran = $this->_uploadSurat();
        }

        $this->db->where('id_dokumen', $id_dokumen);
        $this->db->set('tanggal', $tanggal);
        $this->db->set('perihal', $perihal);
        $this->db->set('keterangan', $keterangan);
        // $this->db->set('status', $status);
        $this->db->set('lampiran', $lampiran);
        return $this->db->update('dokumen_proker', $this);
    }

    public function hapusSurat()
    {
        $id_dokumen = $this->input->post('id_dokumen');
        return $this->db->delete('dokumen_proker', ['id_dokumen' => $id_dokumen]);
    }

    public function getSurat($user)
    {
        return $this->db->get_where('dokumen_proker', ['id_proker' => $user])->result();
    }
    // public function getSurat()
    // {
    //     return $this->db->get('dokumen_proker')->result();
    // }

    public function getProkerSurat($user)
    {
        return $this->db->get('')->result();
    }

public function addSetuju($user)
    {
        // $post = $this->input->post();
        // $id_dokumen = $post['id_dokumen'];


        // $this->lampiran = $this->_uploadSurat();
        // $this->db->where('id_dokumen', $id_dokumen);
        // return $this->db->update('dokumen_proker', $this);
        $post = $this->input->post();
        $this->lampiran = $this->_uploadSurat();

        if ($user == 'Pendamping') {
            $this->db->set('status', '5');
            $this->db->set('tolak', null);
        } elseif ($user == 'Ketua Umum') {
            $this->db->set('status', '3');
            $this->db->set('tolak', null);
        } elseif ($user == 'Sekretaris') {
            $this->db->set('status', '1');
            $this->db->set('tolak', null);
        }

        return $this->db->update('dokumen_proker', $this, array('id_dokumen' => $post['id_dokumen']));
    }

    public function persetujuan()
    {
        $tanggal = $this->input->post('tanggal');
        $perihal = $this->input->post('perihal');
        $tujuan = $this->input->post('tujuan');

        $this->nama_form = $perihal;
        $this->keterangan = $tujuan;
        $this->file = $this->_uploadSurat();

        return $this->db->insert('dokumen_proker', $this);
    }

    // public function setujuPersetujuan($user)
    // {

    //     $post = $this->input->post();
    //     $id_dokumen = $post['id_dokumen'];
    //     $this->db->where('id_dokumen', $id_dokumen);

    //     if ($user == 'Pendamping') {
    //         $this->db->set('status', '5');
    //         $this->db->set('tolak', null);
    //     } elseif ($user == 'Ketua Umum') {
    //         $this->db->set('status', '3');
    //         $this->db->set('tolak', null);
    //     } elseif ($user == 'Sekretaris') {
    //         $no_surat = $post['no_surat'];
    //         $this->db->set('status', '1');
    //         $this->db->set('tolak', null);
    //         $this->db->set('no_surat', $no_surat);
    //     }

    //     return $this->db->update('dokumen_proker', $this);
    // }

    public function tolakPersetujuan($user)
    {
        $post = $this->input->post();
        $keterangan = $post['keterangan'];
        $id_dokumen = $post['id_dokumen'];
        $this->db->where('id_dokumen', $id_dokumen);

        if ($user == 'Pendamping') {
            $this->db->set('status', '6');
            $this->db->set('tolak', $keterangan);
        } elseif ($user == 'Ketua Umum') {
            $this->db->set('status', '4');
            $this->db->set('tolak', $keterangan);
        } elseif ($user == 'Sekretaris') {
            $this->db->set('status', '2');
            $this->db->set('tolak', $keterangan);
        }

        return $this->db->update('dokumen_proker', $this);
    }

    public function getPersetujuan($user)
    {
        if ($user == 'Pendamping') {
            $tampil = $this->db->where('status', '3')->or_where('status', '5')->or_where('status', '6')->get('dokumen_proker');
            return $tampil->result();
        } elseif ($user == 'Ketua Umum') {
            $tampil = $this->db->where('status', '1')->or_where('status', '3')->or_where('status', '4')->get('dokumen_proker');
            return $tampil->result();
        } elseif ($user == 'Sekretaris') {
            return $this->db->get_where('dokumen_proker')->result();
        }
    }

    public function addRekap()
    {
        $tanggal = $this->input->post('tanggal');
        $no_dok = $this->input->post('no_dok');
        $nama_dok = $this->input->post('nama_dok');
        $keterangan = $this->input->post('keterangan');
        $status = $this->input->post('status');

        $this->tanggal = $tanggal;
        $this->no_dok = $no_dok;
        $this->nama_dok = $nama_dok;
        $this->keterangan = $keterangan;
        $this->status = $status;
        $this->lampiran = $this->_uploadRekap();

        return $this->db->insert('dokumen_umum', $this);
    }

    public function editRekap()
    {
        $post = $this->input->post();
        $id_dokumen = $post['id_dokumen'];
        $tanggal = $post['tanggal'];
        $no_dok = $post['no_dok'];
        $nama_dok = $post['nama_dok'];
        $keterangan = $post['keterangan'];
        $status = $post['status'];

        if ($_FILES['lampiran']['name'] == "") {
            $lampiran = $post['lampiran_ada'];
        } else {
            $lampiran = $this->_uploadRekap();
        }

        $this->db->where('id_dokumen', $id_dokumen);
        $this->db->set('tanggal', $tanggal);
        $this->db->set('no_dok', $no_dok);
        $this->db->set('nama_dok', $nama_dok);
        $this->db->set('keterangan', $keterangan);
        $this->db->set('status', $status);
        $this->db->set('lampiran', $lampiran);
        return $this->db->update('dokumen_umum', $this);
    }

    public function hapusRekap()
    {
        $id_dokumen = $this->input->post('id_dokumen');
        return $this->db->delete('dokumen_umum', ['id_dokumen' => $id_dokumen]);
    }

    public function getRekap()
    {
        return $this->db->get('dokumen_umum')->result();
    }

    public function addFormat()
    {
        $tanggal = $this->input->post('tanggal');
        $perihal = $this->input->post('perihal');
        $tujuan = $this->input->post('tujuan');

        $this->tanggal = $tanggal;
        $this->nama_form = $perihal;
        $this->keterangan = $tujuan;
        $this->file = $this->_uploadFormat();
        $this->role = '0';

        return $this->db->insert('format_surat', $this);
    }

    public function editFormat()
    {
        $post = $this->input->post();
        $id_form = $post['id_form'];
        $tanggal = $post['tanggal'];
        $perihal = $post['perihal'];
        $tujuan = $post['tujuan'];

        if ($_FILES['contoh']['name'] == "") {
            $contoh = $post['contoh_ada'];
        } else {
            $contoh = $this->_uploadFormat();
        }

        $this->db->where('id_form', $id_form);
        $this->db->set('tanggal', $tanggal);
        $this->db->set('nama_form', $perihal);
        $this->db->set('keterangan', $tujuan);
        $this->db->set('file', $contoh);
        return $this->db->update('format_surat', $this);
    }

    public function getFormat()
    {
        return $this->db->get_where('format_surat', ['role' => '0'])->result();
    }

    public function hapusFormat()
    {
        $id_form = $this->input->post('id_form');
        return $this->db->delete('format_surat', ['id_form' => $id_form]);
    }

    public function addLpj()
    {
    }

    public function editLpj($id_lpj)

    {
        if ($_FILES['lampiran']['name'] == "") {
            $lpj = $this->input->post('lpj_ada');
        } else {
            //        $lpj = $this->_uploadBukti();
        }
        $this->db->where('id_lpj', $id_lpj);
        $this->db->set('lpj', $lpj);
        return $this->db->update('lpj');
    }

    public function hapusLpj($id_lpj)
    {
        return $this->db->delete('lpj', ['id_lpj' => $id_lpj]);
    }

    public function laporan($id_proker, $status)
    {
        $this->db->where('id_proker', $id_proker);
        $this->db->set('lpj_sekum', $status);
        return $this->db->update('proker');
    }

    public function _uploadFormat()
    {
        $config['upload_path']          = './upload/format_surat/';
        $config['allowed_types']        = 'docx';
        $config['file_name']            = uniqid();
        $config['overwrite']            = false;
        $config['max_size']             = 2048;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config);

        $this->upload->do_upload('contoh');
        return $this->upload->data("file_name");
    }

    public function _uploadLpj()
    {
        $config['upload_path']          = './upload/lpj/';
        $config['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config['file_name']            = uniqid();
        $config['overwrite']            = false;
        $config['max_size']             = 5120;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config);

        $this->upload->do_upload('lampiran');
        return $this->upload->data("file_name");
    }

    public function _uploadRekap()
    {
        $config['upload_path']          = './upload/surat_keluar_masuk/';
        $config['allowed_types']        = 'jpg|jpeg|png|docx|pdf';
        $config['file_name']            = uniqid();
        $config['overwrite']            = false;
        $config['max_size']             = 5120;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config);

        $this->upload->do_upload('lampiran');
        return $this->upload->data("file_name");
    }

    public function _uploadSurat()
    {
        $config['upload_path']          = './upload/surat_proker/';
        $config['allowed_types']        = 'docx';
        $config['file_name']            = uniqid();
        $config['overwrite']            = true;
        $config['max_size']             = 2048;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config);

        $this->upload->do_upload('lampiran');
        return $this->upload->data("file_name");
    }
}
