<?php section('head'); ?>
<style type="text/css">
.circle {
 border-radius: 50%;
 height: 100px;
 width: 100px;
 overflow: hidden;
 display: flex;
 justify-content: center;
 align-items: center;
}
</style>
<?php endsection(); ?>
<?php section('contents'); ?>
<?php
$nim = $this->session->userdata('username');
$mhsdata = $this->model_user->getKTM($nim);
$img = 'https://api.um.ac.id/akademik/operasional/GetFoto.ptikUM?nim='.$nim.'&angkatan='.$mhsdata['tahun_masuk'].'';
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Home') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle circle"
                       src="<?= $img ?>"
                       onerror="this.src='<?= base_url('assets/') ?>dist/img/default.png'"
                       alt="User profile picture">
                </div>
                <h3 class="profile-username text-center"><?= ucwords(strtolower($this->session->userdata('nama'))) ?></h3>
                <p class="text-muted text-center"><?= $this->session->userdata('username') ?></p>
                <?php if($this->session->userdata('jabatan')!=""){ ?>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item text-center">
                    <b><?= $this->session->userdata('jabatan') ?></b>
                  </li>
                  <?php
                    $user = $this->model_user->getUser($this->session->userdata('username'));
                    $bidang = $this->model_user->getBidang($user->bidang)->bidang;
                    $divisi = $this->model_user->getDivisi($user->divisi)->divisi;
                  ?>
                  <?php if($bidang!="-"){ ?>
                  <li class="list-group-item text-center">
                    <?= $bidang ?>
                  </li>
                  <?php } if($divisi!="-"){ ?>
                  <li class="list-group-item text-center">
                    <?= $divisi ?>
                  </li>
                  <?php } ?>
                </ul>
                <?php } ?>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#profil" data-toggle="tab">Profile</a></li>
                  <li class="nav-item"><a class="nav-link" href="#pass" data-toggle="tab">Ganti Password</a></li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="profil">
                    <div class="form-horizontal">
                      <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <input readonly type="text" class="form-control" id="nama" value="<?= ucwords(strtolower($mhsdata['nama_lengkap'])) ?>">
                        </div>
                      </div>
                      <?php
                        $prodi = $this->db_master->get_where('prodi', array('kode_prodi' => $mhsdata['kode_prodi']))->row();
                        $jenjang = $this->db_master->get_where('jenjang', array('id_jenjang' => $mhsdata['jenjang']))->row();
                      ?>
                      <div class="form-group row">
                        <label for="prodi" class="col-sm-2 col-form-label">Program Studi</label>
                        <div class="col-sm-10">
                          <input readonly type="text" class="form-control" id="prodi" value="<?= $jenjang->nama_jenjang." ".$prodi->nama_prodi ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="angkatan" class="col-sm-2 col-form-label">Angkatan/Off</label>
                        <div class="col-sm-10">
                          <input readonly type="text" class="form-control" id="angkatan" value="<?= $mhsdata['tahun_masuk']."/ ".$mhsdata['offering'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input readonly type="email" class="form-control" id="email" value="<?= $mhsdata['email'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="notelp" class="col-sm-2 col-form-label">No Telepon</label>
                        <div class="col-sm-10">
                          <input readonly type="text" class="form-control" id="notelp" value="<?= $mhsdata['no_hp'] ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button class="btn btn-primary" data-toggle="modal" data-target="#edit" onclick="getEdit(this);" data-username="<?= $this->session->userdata('username') ?>" data-email="<?= $mhsdata['email'] ?>" data-nohp="<?= $mhsdata['no_hp'] ?>">Edit Profile</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="pass">
                    <form role="form" action="<?= site_url('Profile/ganti_pass') ?>" class="form-submit" method="post">
                      <div class="form-group ">
                        <label for="oldpass" >Password Lama</label>
                        <input type="password" class="form-control" name="oldpass" id="oldpass" placeholder="Password Lama" data-validation="required">
                      </div>
                      <div class="form-group ">
                        <label for="newpass" >Password Baru</label>
                        <input type="password" class="form-control" name="newpass_confirmation" id="newpass1" placeholder="Password Baru" data-validation="required">
                      </div>
                      <div class="form-group ">
                        <label for="newpass2" >Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" name="newpass" id="newpass2" placeholder="Konfirmasi Password Baru" data-validation="confirmation">
                      </div>
                      <div class="form-group ">
                        <input type="hidden" name="gantipass">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('Profile/editprofile') ?>" class="form-submit" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="form-group">
                      <label for="email_edit">Email</label>
                      <input type="email" class="form-control" id="email_edit" name="email" placeholder="Email Aktif" data-validation="required email server" data-validation-url="<?= site_url('Profile/cek_email'); ?>">
                  </div>
                  <div class="form-group">
                      <label for="nohp_edit">No Telepon</label>
                      <input type="text" class="form-control" id="nohp_edit" name="nohp" placeholder="No Telepon" data-validation="required number length" data-validation-length="10-15">
                  </div>
              </div>
              <div class="modal-footer">
                  <input type="hidden" name="username" id="username_edit">
                  <input type="hidden" name="edit_profil">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              </div>
            </form>
        </div>
    </div>
</div>
<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
    function getEdit(identifier){
      var button = $(identifier);
      var username = button.data('username');
      var email = button.data('email');
      var nohp = button.data('nohp');

      $('#username_edit').val(username);
      $('#email_edit').val(email);
      $('#nohp_edit').val(nohp);
    }     
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>