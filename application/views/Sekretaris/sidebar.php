<?php
$nim = $this->session->userdata('username');
$angkatan = $this->model_user->getKTM($nim);
$img = 'https://api.um.ac.id/akademik/operasional/GetFoto.ptikUM?nim=' . $nim . '&angkatan=' . $angkatan['tahun_masuk'] . '';
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link">
    <img src="<?= base_url('assets/') ?>img/logo hmj.png" alt="Logo HMJ" class="brand-image img-circle ">
    <span class="brand-text font-weight-light"><b>HMJ Teknik Elektro</b></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-2 pb-1 d-flex">
      <div class="image">
        <img src="<?= $img ?>" onerror="this.src='<?= base_url('assets/') ?>dist/img/user2-160x160.jpg'" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="<?= site_url('Profile'); ?>" class="d-block"><?= $this->session->userdata('nama'); ?></a>
      </div>
    </div>

    <!--jabatan    -->
    <div class="pt-0 pb-1 brand-link text-center">
      <small class="brand-text">
        <?= $this->session->userdata('jabatan') ?>
      </small>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?php echo site_url('Sekretaris') ?>" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('Sekretaris/persetujuan') ?>" class="nav-link">
            <i class="nav-icon fas fa-balance-scale"></i>
            <p> Persetujuan</p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Program Kerja<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo site_url('Sekretaris/timeline') ?>" class="nav-link">
                <i class="far fa-calendar-alt nav-icon"></i>
                <p>Timeline</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('Sekretaris/progress') ?>" class="nav-link">
                <i class="far fa-calendar-check nav-icon"></i>
                <p>Progress</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('Sekretaris/laporan') ?>" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>Laporan Kegiatan</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-school"></i>
            <p>PEMIRA<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo site_url('Sekretaris/detail_pemira') ?>" class="nav-link">
                <i class="fas fa-newspaper nav-icon"></i>
                <p>Informasi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('Sekretaris/profil_calon') ?>" class="nav-link">
                <i class="fa fa-users nav-icon"></i>
                <p>Profil Calon</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('Sekretaris/format_surat') ?>" class="nav-link">
            <i class="nav-icon fas fa-envelope-open-text"></i>
            <p>Format Persuratan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('Sekretaris/rekap_surat') ?>" class="nav-link">
            <i class="nav-icon fas fa-mail-bulk"></i>
            <p>Rekap Persuratan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('Sekretaris/lpj') ?>" class="nav-link">
            <i class="nav-icon fas fa-book-open"></i>
            <p>LPJ</p>
          </a>
        </li>

        <li class="nav-item " title="Download Buku Panduan">
          <a href="<?= site_url('Home/panduan/Sekretaris.pdf') ?>" class="nav-link ">
            <i class="nav-icon fas fa-book"></i>
            <p>Buku Panduan</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>