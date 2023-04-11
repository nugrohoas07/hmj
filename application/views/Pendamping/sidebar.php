<?php
$nim = $this->session->userdata('username');
$mhsdata = $this->model_user->getKTM($nim);
$foto = $this->model_user->getUser($nim)->foto;
$img = base_url('/upload/foto/'.$foto);
$img_def = base_url('assets/dist/img/default.png');
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link">
    <img src="<?= base_url('assets/') ?>img/logo hmj.png" alt="Logo HMJ" class="brand-image img-circle ">
    <span class="brand-text font-weight-light"><b>HMJ Teknik Elektro</b></span>
  </a>
  <div class="sidebar">
    <div class="user-panel mt-2 pb-1 d-flex">
      <div class="image">
        <img src="<?= ($foto) ? $img : $img_def ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="<?= site_url('Profile') ?>" class="d-block"><?= $this->session->userdata('nama') ?></a>
      </div>
    </div>

<!--jabatan    -->
  <div class="pt-0 pb-1 brand-link text-center">
      <small class="brand-text">
          <?=$this->session->userdata('jabatan')?>
          </small>
  </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?php echo site_url('Pendamping') ?>" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('Pendamping/persetujuan') ?>" class="nav-link">
            <i class="nav-icon fas fa-balance-scale"></i>
            <p> Persetujuan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo site_url('Pendamping/rekap') ?>" class="nav-link">
            <i class="nav-icon fas fa-mail-bulk"></i>
            <p> Rekap Surat</p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Program Kerja<i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo site_url('Pendamping/timeline') ?>" class="nav-link">
                <i class="far fa-calendar-alt nav-icon"></i>
                <p>Timeline</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('Pendamping/progress') ?>" class="nav-link">
                <i class="far fa-calendar-check nav-icon"></i>
                <p>Progress</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('Pendamping/proker') ?>" class="nav-link">
                <i class="fas fa-stamp nav-icon"></i>
                <p>Verifikasi Proker</p>
              </a>
            </li>
          </ul>
         </li>
        
        <li class="nav-item " title="Download Buku Panduan">
          <a href="<?= base_url('Home/panduan/Pendamping.pdf') ?>" class="nav-link ">
            <i class="nav-icon fas fa-book"></i>
            <p>
              Buku Panduan
            </p>
          </a>
        </li>
        
    </ul>
    </nav>
  </div>
</aside>