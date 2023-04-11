<?php

class Model_user extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    $this->db2 = $this->load->database('master', TRUE);
  }

  function getUser($username) //mendapatkan data 1 user
  {
    return $this->db->get_where('user', array('username' => $username))->row();
  }

  function editProfile()
  { //update email dan no hp untuk role selain pendamping
    $post = $this->input->post();
    $this->email = $post['email'];
    $this->no_hp = $post['nohp'];
    $hmj = $this->db->update('user', $this, array('username' => $post['username']));
    $master = $this->db2->update('user', $this, array('username' => $post['username']));
    if ($hmj && $master) return true;
    else return false;
  }

  function editProfileDosen()
  { //update email,no hp dan foto untuk role pendamping
    $post = $this->input->post();
    if ($_FILES['foto']['name'] == "") {
      $foto = $post["old_foto"];
    } else {
      $foto = $this->_uploadFoto();
    }
    $email = $post['email'];
    $no_hp = $post['nohp'];
    $data = array(
      'foto' => $foto,
      'email' => $email,
      'no_hp' => $no_hp,
    );
    $data2 = array(
      'email' => $email,
      'no_hp' => $no_hp,
    );
    $hmj = $this->db->update('user', $data, array('username' => $post['username']));
    $master = $this->db2->update('user', $data2, array('username' => $post['username']));
    if ($hmj && $master) return true;
    else return false;
  }

  function getAnggota() //mendapatkan data semua user dengan role staff
  {
    return $this->db->get_where('user', array('jabatan' => "1"))->result();
  }

  function getAnggotaAktif() //mendapatkan data semua user dengan role selain pendamping yang statusnya masih aktif dan berhenti
  {
    $this->db->order_by('nama', 'ASC');
    $this->db->where('status', '1');
    $this->db->where('jabatan !=', '8');
    $this->db->or_where('status', '2');
    return $this->db->get('user')->result();
  }

  function getAnggotabyBidang() //mendapatkan data staff aktif dengan bidang yang sama dengan user yang login(untuk KABID)
  {
    $username = $this->session->userdata('username');
    $bidang = $this->model_user->getUser($username)->bidang;
    return $this->db->get_where('user', array('jabatan' => "1", 'bidang' => $bidang))->result();
  }

  function getStatus()
  {
    return $this->db->get_where('user', array('id_bidang' => $id_bidang))->row();
  }

  function getAllJabatan() //mendapatkan semua list role jabatan
  {
    return $this->db->get('role_jabatan')->result();
  }

  function getJabatan($id_jabatan) //mendapatkan nama jabatan
  {
    return $this->db->get_where('role_jabatan', array('id_jabatan' => $id_jabatan))->row();
  }

  function getNama($username) //mendapatkan nama/data user
  {
    return $this->db->get_where('user', array('username' => $username))->row();
  }

  function getIdJabatan($jabatan) //mendapatkan id jabatan
  {
    return $this->db->get_where('role_jabatan', array('jabatan' => $jabatan))->row();
  }

  function getAllBidang() //mendapatkan list semua role bidang
  {
    return $this->db->get('role_bidang')->result();
  }

  function getBidang($id_bidang) //mendapatkan nama bidang
  {
    return $this->db->get_where('role_bidang', array('id_bidang' => $id_bidang))->row();
  }

  function getAllDivisi() //mendapatkan list semua role divisi
  {
    return $this->db->get('role_divisi')->result();
  }

  function getDivisi($id_divisi) //mendapatkan nama divisi
  {
    return $this->db->get_where('role_divisi', array('id_divisi' => $id_divisi))->row();
  }

  function getDivisibyBidang($id_bidang) //mendapatkan divisi berdasarkan bidang lewat parameter
  {
    $this->db->where('id_bidang', $id_bidang);
    return $this->db->get('role_divisi')->result();
  }

  function getPendaftar() //mendapatkan list pendaftar yang baru mendaftar
  {
    $this->db->where('status', '0');
    return $this->db->get('dokumen_user')->result();
  }
  
  function isiNilaiWawancara(){ //mendapatkan list pendaftar yang nilai wawancaranya null
      return $this->db->get_where('dokumen_user',("(status='0' AND nilai_wawancara is null)"))->result();
  }
  
  function isiTotalNilai(){ //mendapatkan list pendaftar yang total nilainya null
      return $this->db->get_where('dokumen_user',("(status='0' AND total_nilai is null)"))->result();
  }

  function updateAnggota() //mengupdate posisi organisasi seorang anggota
  {
    $post = $this->input->post();
    $this->jabatan = $post["jabatan"];
    $this->bidang = $post["bidang"];
    $this->divisi = $post["divisi"];
    $this->status = $post["status"];
    return $this->db->update('user', $this, array('username' => $post['username']));
  }

  function update($data, $username)
  {
    if ($this->db->get_where('user', array('username' => $username))->row()) {
      $this->db->where('username', $username);
      $this->db->update('user', $data);
    } else {
      $this->db->insert('user', $data);
    }
  }

  function setPendaftaran()
  { //mengedit tanggal dan status pendaftaran anggota baru
    $post = $this->input->post();
    $this->id = "pendaftaran";
    $this->pengumpulan_awal = $post["kumpul"];
    $this->pengumpulan_akhir = $post["kumpuls"];
    $this->administrasi_awal = $post["admin"];
    $this->administrasi_akhir = $post["admins"];
    $this->wawancara_awal = $post["wawancara"];
    $this->wawancara_akhir = $post["wawancaras"];
    $this->pengumuman = $post["pengumuman"];
    // $this->formulir = $post["formulir"];
    $this->persyaratan = $post["syarat"];
    $this->link_persyaratan = $post["link_syarat"];
    $this->status = $post["status"];
    if ($this->db->get_where('pendaftaran', array('id' => "pendaftaran"))->row()) {
      $this->db->where('id', "pendaftaran");
      return $this->db->update('pendaftaran', $this);
    } else {
      return $this->db->insert('pendaftaran', $this);
    }
  }

  function nilaiPendaftar()
  {
    return $this->db->get_where('dokumen_user', ("(nilai_organisasi is null OR nilai_penalaran is null OR nilai_kesejahteraan is null OR nilai_bakat is null OR nilai_pengabdian is null) AND status='0'"))->result();
    // return $this->db->get_where('dokumen_user', ("(nilai_organisasi is null OR nilai_penalaran is null OR nilai_kesejahteraan is null OR nilai_bakat is null OR nilai_pengabdian is null OR nilai_ketum is null) AND status='0'"))->result();
  }

  function totalNilai()
  {
    $this->db->order_by('total_nilai', 'DESC');
    return $this->db->get_where('dokumen_user', ['status' => '0'])->result();
  }

  function daftarBaru()
  { //input data pendaftar baru
    $post = $this->input->post();
    $username = $post['username'];
    $sertif = $_FILES['dokumen_lain']['name'] == null ? null : $this->_uploadSertif(); //sertif PKKMB
    $form = $_FILES['form']['name'] == null ? null : $this->_uploadForm(); //KRS
    if ($_FILES['karya']['name'] == null) {
      if ($post['karya'] == null) {
        $karya = null;
      } else {
        $karya = $post['karya'];
      }
    } else {
      $karya = $this->_uploadKarya();
    }
    $bidang = $post['bidang'];
    $divisi = $post['divisi'];
    $data1 = array(
      'username' => $username,
      // 'dokumen_lain' => $sertif,
      // 'form' => $form,
      'pkkmb' => $sertif,
      'krs' => $form,
      'karya' => $karya,
      'status' => "0"
    );
    $daftar1 = $this->db->insert('dokumen_user', $data1);
    $data2 = array(
      'bidang' => $bidang,
      'divisi' => $divisi
    );
    $daftar2 = $this->db->update('user', $data2, array('username' => $username));
    if ($daftar1 && $daftar2) return true;
    else return false;
  }

  function nilai_wawancara($nilai)
  { //input nilai wawancara
    $post = $this->input->post();
    $id = $post['id_dok'];
    // if ($nilai == 'ketum') {
    //   $this->nilai_ketum = $post['nilai_ketum'];
    // } else
    if ($nilai == 'kabid') {
      if ($post['kabid'] == 2) {
        $this->nilai_organisasi = $post['nilai_kabid'];
        $this->catatan_organisasi = $post['catatan_kabid'];
      } elseif ($post['kabid'] == 3) {
        $this->nilai_penalaran = $post['nilai_kabid'];
        $this->catatan_penalaran = $post['catatan_kabid'];
      } elseif ($post['kabid'] == 4) {
        $this->nilai_kesejahteraan = $post['nilai_kabid'];
        $this->catatan_kesejahteraan = $post['catatan_kabid'];
      } elseif ($post['kabid'] == 5) {
        $this->nilai_bakat = $post['nilai_kabid'];
        $this->catatan_bakat = $post['catatan_kabid'];
      } elseif ($post['kabid'] == 6) {
        $this->nilai_pengabdian = $post['nilai_kabid'];
        $this->catatan_pengabdian = $post['catatan_kabid'];
      }
    }
    return $this->db->update('dokumen_user', $this, ['id_dokumen' => $id]);
  }
  
  function total_wawancara($data){//total nilai wawancara pada kolom nilai wawancara
      $id = $data['id'];
    $nilai_wawancara = ($data['nilai_oka'] + $data['nilai_pk'] + $data['nilai_ksj'] + $data['nilai_bakmin'] + $data['nilai_pengmas']) / 5;
    // $nilai_wawancara = ($data['nilai_oka'] + $data['nilai_pk'] + $data['nilai_ksj'] + $data['nilai_bakmin'] + $data['nilai_pengmas'] + $data['nilai_ketum']) / 6;
      
      $max_oka = $this->db->select_max('nilai_organisasi')->get_where('dokumen_user',['status' => '0'])->row();
    $max_pk = $this->db->select_max('nilai_penalaran')->get_where('dokumen_user',['status' => '0'])->row();
    $max_ksj = $this->db->select_max('nilai_kesejahteraan')->get_where('dokumen_user',['status' => '0'])->row();
    $max_bakmin = $this->db->select_max('nilai_bakat')->get_where('dokumen_user',['status' => '0'])->row();
    $max_pengmas = $this->db->select_max('nilai_pengabdian')->get_where('dokumen_user',['status' => '0'])->row();
    // $max_ketum = $this->db->select_max('nilai_ketum')->get_where('dokumen_user',['status' => '0'])->row();

    $max = ($max_oka->nilai_organisasi + $max_pk->nilai_penalaran + $max_ksj->nilai_kesejahteraan + $max_bakmin->nilai_bakat + $max_pengmas->nilai_pengabdian) / 5;
    // $max = ($max_oka->nilai_organisasi + $max_pk->nilai_penalaran + $max_ksj->nilai_kesejahteraan + $max_bakmin->nilai_bakat + $max_pengmas->nilai_pengabdian + $max_ketum->nilai_ketum) / 6;
    $rata2_wawancara = $nilai_wawancara / $max;
    
    
      return $this->db->update('dokumen_user', ['nilai_wawancara'=>round($rata2_wawancara,3)], ['id_dokumen'=>$id]);
  }

  function nilai_saw($data)
  {
    $pkkmb = $data['pkkmb'] / 1;
    $krs = $data['krs'] / 1;
    $karya = $data['karya'] / 1;

    $max_wawancara = $this->db->select_max('nilai_wawancara')->get_where('dokumen_user',['status' => '0'])->row();
    
    $rata2_wawancara = $data['total_wawancara'] / $max_wawancara->nilai_wawancara;

    $nilai = (0.2 * $pkkmb) + (0.15 * $krs) + (0.15 * $karya) + (0.5 * $rata2_wawancara);
    
    $this->total_nilai = round($nilai,3);
    return $this->db->update('dokumen_user', $this, ['id_dokumen' => $data['id']]);
  }

  private function _uploadFoto() //fungsi upload foto
  {
    $username = $this->session->userdata("username");
    $config = array();
    $config['upload_path']          = './upload/foto/';
    $config['allowed_types']        = 'jpg|jpeg|png';
    $config['file_name']            = $username . "_Foto";
    $config['overwrite']        = false;
    $config['max_size']             = 5120;
    $config['file_ext_tolower']     = true;

    $this->load->library('upload', $config, 'fotoupload');
    $this->fotoupload->initialize($config);
    if ($this->fotoupload->do_upload('foto')) {
      return $this->fotoupload->data("file_name");
    } else {
      $this->toastr->error('Maaf gagal mengupload foto');
      redirect($this->uri->uri_string());
    }
  }

  private function _uploadForm() //fungsi upload formulir jadi KRS
  {
    $username = $this->session->userdata("username");
    $config = array();
    // $config['upload_path']          = './upload/form/';
    $config['upload_path']          = './upload/krs/';
    $config['allowed_types']        = 'jpg|jpeg|png|pdf';
    $config['file_name']            = $username . "-KRS";
    $config['overwrite']        = false;
    $config['max_size']             = 5120;
    $config['file_ext_tolower']     = true;

    $this->load->library('upload', $config, 'formupload');
    $this->formupload->initialize($config);
    if ($this->formupload->do_upload('form')) {
      return $this->formupload->data("file_name");
    } else {
      $this->toastr->error('Gagal mengupload KRS');
      redirect($this->uri->uri_string());
    }
  }

  private function _uploadKarya() //fungsi upload karya
  {
    $username = $this->session->userdata("username");
    $config = array();
    $config['upload_path']          = './upload/karya/';
    $config['allowed_types']        = 'jpg|jpeg|png|pdf';
    $config['file_name']            = $username . "-Karya";
    $config['overwrite']        = false;
    $config['max_size']             = 5120;
    $config['file_ext_tolower']     = true;

    $this->load->library('upload', $config, 'karyaupload');
    $this->karyaupload->initialize($config);
    if ($this->karyaupload->do_upload('karya')) {
      return $this->karyaupload->data("file_name");
    } else {
      $this->toastr->error('Gagal mengupload file karya');
      redirect($this->uri->uri_string());
    }
  }

  private function _uploadSertif() //fungsi upload sertifikat jadi sertif PKKMB
  {
    $username = $this->session->userdata("username");
    // $config['upload_path']          = './upload/dokumen_lain/';
    $config['upload_path']          = './upload/pkkmb/';
    $config['allowed_types']        = 'jpg|jpeg|png|pdf';
    $config['file_name']            = $username . "-PKKMB";
    $config['overwrite']            = false;
    $config['max_size']             = 5120;
    $config['file_ext_tolower']     = true;

    $this->load->library('upload', $config, 'sertifupload');
    $this->sertifupload->initialize($config);
    if ($this->sertifupload->do_upload('dokumen_lain')) {
      return $this->sertifupload->data("file_name");
    } else {
      $this->toastr->error('Gagal mengupload sertifikat');
      redirect($this->uri->uri_string());
    }
  }

  public function getDemis()
  {
    $this->db->select('*, role_jabatan.jabatan AS role, YEAR(masuk) AS tahun');
    $this->db->where('status', '3');
    $this->db->where('user.jabatan', '6');
    $this->db->join('role_jabatan', 'role_jabatan.id_jabatan = user.jabatan', 'left');
    return $this->db->get('user')->result();
  }
  public function getPengurus()
  {
    $tahun = $this->input->get('tahun');
    $tambah = (int)$tahun + 1;
    $this->db->select('*');
    $this->db->where('status', '3');
    $this->db->where('YEAR(masuk) = ' . $tahun . ' OR YEAR(masuk) =' . $tambah, null, false);

    $this->db->where('user.masuk >=', '1');
    return $this->db->get('user')->result();
    // $query = ''
  }

  public function editDemisioner()
  {
    $post = $this->input->post();
    $username = $post['username'];
    $email = $post['email'];
    $no_hp = $post['no_hp'];

    $this->db->where('username', $username);
    $this->db->set('email', $email);
    $this->db->set('no_hp', $no_hp);
    $this->db2->where('username', $username);
    $this->db2->set('email', $email);
    $this->db2->set('no_hp', $no_hp);
    $data = $this->db2->update('user', $this);
    $data2 = $this->db->update('user', $this);
    return $data && $data2;
  }
  public function editPengurus()
  {
    $post = $this->input->post();
    $username = $post['username'];
    $email = $post['email'];
    $no_hp = $post['no_hp'];

    $this->db->where('username', $username);
    $this->db->set('email', $email);
    $this->db->set('no_hp', $no_hp);
    $this->db2->where('username', $username);
    $this->db2->set('email', $email);
    $this->db2->set('no_hp', $no_hp);
    $data = $this->db2->update('user', $this);
    $data2 = $this->db->update('user', $this);
    return $data && $data2;
  }

  // mencari kahim baru apakah sudah ditentukan atau belum
  public function getKahimBaru($user)
  {
    $kahim = $this->db->select('YEAR(masuk) AS tahun')->get_where('user', ['username' => $user])->row();
    $tahun = $kahim->tahun;
    $tambah = (int)$tahun + 1;
    return $this->db->get_where('user', ['jabatan' => '6', 'YEAR(masuk)' => $tambah])->result();
  }

  public function addLpj($user)
  {
    if (is_array($user)) {
      $this->username = $user['user'];
      $now = $user['tahun'];
    } else {
      $this->username = $user;
      $now = date('Y') + 1;
    }

    $this->lpj = $this->_uploadLpj();
    $this->tahun = $now;
    return $this->db->insert('lpj', $this);
  }

  public function editLpj($id_lpj)
  {
    if ($_FILES['lampiran']['name'] == "") {
      $this->toastr->info('Tidak Ada Data Yang Diedit');
    } else {
      $this->db->where('id_lpj', $id_lpj);
      $this->db->set('lpj', $this->_uploadLpj());
      $this->toastr->info('Berhasil Edit LPJ');
      return $this->db->update('lpj');
    }
  }

  public function hapusLpj($id_lpj)
  {
    return $this->db->delete('lpj', ['id_lpj' => $id_lpj]);
  }

  public function _uploadLpj() //fungsi upload LPJ
  {
    $jabatan = $this->session->userdata('jabatan');

    $config['upload_path']          = './upload/lpj/';
    $config['allowed_types']        = 'docx|rar|zip';
    $config['file_name']            = 'LPJ ' . $jabatan; // uniqid();
    $config['overwrite']            = true;
    $config['max_size']             = 51200;
    $config['file_ext_tolower']     = true;

    $this->load->library('upload', $config, 'lpj_upload');
    $this->lpj_upload->initialize($config);

    if ($this->lpj_upload->do_upload('lampiran')) {
      return $this->lpj_upload->data("file_name");
    } else {
      $this->toastr->error('Gagal Upload LPJ');
      redirect($this->uri->uri_string());
    }
  }

  // mengambil data user dari db master sesuai
  public function getKTM($user)
  {
    return $this->db2->get_where('user', ['username' => $user])->row_array();
  }
}
