<?php

class Model_dana extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

// ajukan ulang dana
    public function ajukanDana($data)
    {
        if ($data['ulang'] == 1) {
            $this->db->where('id_saldo', $data['id_saldo']);
            $this->db->set('status', $data['status']);
            $this->db->set('tgl_ajukan', $data['tgl_ajukan']);
            return $this->db->update('saldo');
        }
        return $this->db->insert('saldo', $data);
    }

    public function editDana($data, $id_saldo)
    {
        $this->db->where('id_saldo', $id_saldo);
        $this->db->set('tgl_ajukan', $data['tgl_ajukan']);
        return $this->db->update('saldo', $data);
    }

    public function hapusDana($id_saldo)
    {
        return $this->db->delete('saldo', ['id_saldo' => $id_saldo]);
    }

// persetujuan dana pada bendahara dan pengajuan dana pada staff
    public function getDana($user)
    {
        if ($user == 'Bendahara') {
            $this->db->select('*, user.nama AS nama, proker.nama_proker AS proker, proker.status AS ket, user.status AS aktif, saldo.status AS status');
            $this->db->where('role', '0');
            $this->db->where('saldo.status', '0');
            $this->db->join('proker', 'proker.id_proker = saldo.id_proker', 'left');
            $this->db->join('user', 'user.username = proker.ketua', 'left');
            return $this->db->get('saldo')->result();
        }
        return $this->db->get_where('saldo', ['id_proker' => $user])->result();
    }

// proses persetujuan dana oleh bendahara
    public function persetujuan($id_saldo, $data, $saldo)
    {
        $now = date('Y-m-d H:i:s');
        $post = $this->input->post();
        $pengeluaran = $post['pengeluaran'];
        $sisa = $saldo['sisa'];

        if ($data['status'] == 1) {
            $sisa = 0 - $pengeluaran;
        }
        $this->db->where('id_saldo', $id_saldo);
        $this->db->set('tgl_terima', $now);
        $this->db->set('sisa', $sisa);
        return $this->db->update('saldo', $data);
    }

    public function inputRekap($data)
    {
        $now = date('Y-m-d H:i:s');
        $post = $this->input->post();

        $sisa = $data['sisa'];
        $pemasukan = $post['pemasukan'];
        $pengeluaran = $post['pengeluaran'];

        if ($pemasukan == null) {
            $pemasukan = 0;
        } elseif ($pengeluaran == null) {
            $pengeluaran = 0;
        }

        $sisa = $pemasukan - $pengeluaran;

        $this->tanggal = $post["tanggal"];
        $this->keperluan = $post["keperluan"];
        $this->sumber = $post["sumber"];
        $this->pemasukan = $post["pemasukan"];
        $this->pengeluaran = $post["pengeluaran"];
        $this->sisa = $sisa;
        $this->bukti = $this->_uploadBukti();
        $this->role = "1";
        $this->tgl_ajukan = $now;
        $this->tgl_terima = $now;
        return $this->db->insert('saldo', $this);
    }

    public function editRekap($data)
    {
        $now = date('Y-m-d H:i:s');
        $post = $this->input->post();

        $id_saldo = $post['id_saldo'];
        $pemasukan = $data['pemasukan'];
        $pengeluaran = $data['pengeluaran'];

        if ($post['pemasukan'] != $data['pemasukan'] || $post['pengeluaran'] != $data['pengeluaran']) {
            if ($post['pemasukan'] != $data['pemasukan']) {
                $pemasukan = $post['pemasukan'];
            } elseif ($post['pengeluaran'] != $data['pengeluaran']) {
                $pengeluaran = $post['pengeluaran'];
            }
            $sisa = $pemasukan - $pengeluaran;
        }

        if ($_FILES['bukti']['name'] == "") {
            $bukti = $post['bukti_ada'];
        } else {
            $bukti = $this->_uploadBukti();
        }

        $this->db->where('id_saldo', $id_saldo);
        $this->db->set('tanggal', $post["tanggal"]);
        $this->db->set('keperluan', $post["keperluan"]);
        $this->db->set('sumber', $post["sumber"]);
        $this->db->set('pemasukan', $pemasukan);
        $this->db->set('pengeluaran', $pengeluaran);
        $this->db->set('sisa', $sisa);
        $this->db->set('bukti', $bukti);
        $this->db->set('tgl_terima', $now);
        return $this->db->update('saldo');
    }

    public function hapusRekap($data)
    {
        $post = $this->input->post();
        $id_saldo = $post['id_saldo'];
        $sisaakhir = $data['sisa'];
        $sisahapus = $post['sisa'];

        $sisa = $sisaakhir - $sisahapus;

        $this->db->where('id_saldo', $id_saldo);
        $this->db->set('sisa', $sisa);
        $this->db->update('saldo');

        return $this->db->delete('saldo', ['id_saldo' => $id_saldo]);
    }

// menampilkan rekap dana dari pengajuan dana proker
    public function getRekap()
    {
        $this->db->select('*, user.nama AS nama, proker.nama_proker AS proker, proker.status AS ket, user.status AS aktif, saldo.status AS status');
        $this->db->where("(role='1' OR saldo.status='1')", null, false);
        $this->db->join('proker', 'proker.id_proker = saldo.id_proker', 'left');
        $this->db->join('user', 'user.username = proker.ketua', 'left');
        return $this->db->get('saldo')->result();
    }

// menampilkan rekap dana yg diinput oleh bendahara
    public function getDataRekap(){
        $this->db->order_by('tgl_terima', 'DESC');
        return $this->db->get_where('saldo', ("(role='1' OR status='1')"))->row_array();   
    }

    public function addFormat()
    {
        $keperluan = $this->input->post('keperluan');

        $this->nama_form = 'Pendanaan';
        $this->keterangan = $keperluan;
        $this->file = $this->_uploadFormat();
        $this->role = '1';

        return $this->db->insert('format_surat', $this);
    }

    public function editFormat()
    {
        $post = $this->input->post();
        $id_form = $post['id_form'];
        $ket = $post['keperluan'];

        if ($_FILES['contoh']['name'] == "") {
            $contoh = $post['contoh_ada'];
        } else {
            $contoh = $this->_uploadFormat();
        }

        $this->db->where('id_form', $id_form);
        $this->db->set('keterangan', $ket);
        $this->db->set('file', $contoh);
        return $this->db->update('format_surat');
    }

    public function getFormat()
    {
        return $this->db->get_where('format_surat', ['role' => '1'])->result();
    }

    public function hapusFormat()
    {
        $id_form = $this->input->post('id_form');
        return $this->db->delete('format_surat', ['id_form' => $id_form]);
    }

    public function laporan($id_proker, $status)
    {
        $this->db->where('id_proker', $id_proker);
        $this->db->set('lpj_bendum', $status);
        return $this->db->update('proker');
    }

    public function _uploadFormat()
    {
        $format = $this->input->post('keperluan');
        
        $config['upload_path']          = './upload/format_dana/';
        $config['allowed_types']        = 'docx';
        $config['file_name']            = $format.'_'.date('Y-m-d');
        $config['overwrite']            = true;
        $config['max_size']             = 2048;
        $config['file_ext_tolower']     = true;
        
        $this->load->library('upload', $config, 'contoh_upload');
        $this->contoh_upload->initialize($config);

        if ($this->contoh_upload->do_upload('contoh')) {
            return $this->contoh_upload->data("file_name");
        } else {
            $this->toastr->error('Gagal Upload Contoh Format ' . $keperluan . '');
            redirect($this->uri->uri_string());
        }
    }

    public function _uploadBukti()
    {
        $id_saldo = $this->input->post('id_saldo');
        $id_proker = $this->input->post('id_proker');
        $saldo = $this->db->get_where('saldo', ['id_saldo' => $id_saldo])->row_array();
        $proker = $this->db->get_where('proker', ['id_proker' => $id_proker])->row_array();
        if($saldo['keperluan'] == null || $saldo['role'] == '1'){
            $keperluan = $this->input->post('keperluan');
            $nama = $this->session->userdata('jabatan');
        }
        else{
            $nama = $proker['ketua'];
            $nama_proker = $proker['nama_proker'];
            $keperluan = $saldo['keperluan'];
        }
        
        $config['upload_path']          = './upload/saldo/';
        $config['allowed_types']        = 'jpg|jpeg|png|pdf';
        $config['file_name']            = 'bukti_' . $nama .'_'. $nama_proker .'_'. $keperluan;
        $config['overwrite']            = true;
        $config['max_size']             = 2048;
        $config['file_ext_tolower']     = true;

        $this->load->library('upload', $config, 'bukti_upload');
        $this->bukti_upload->initialize($config);

        if ($this->bukti_upload->do_upload('bukti')) {
            return $this->bukti_upload->data("file_name");
        } else {
            $this->toastr->error('Gagal Upload Bukti ' . $keperluan . '');
            redirect($this->uri->uri_string());
        }
    }
}
