<?php section('contents'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Pendaftar') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <?php
            $username = $this->session->userdata("username");
            $tahun = date('Y');
            $status = $this->db->get_where('dokumen_user', array('username' => $username, 'YEAR(tgl_input)' => $tahun))->row();
            if ($status) {
                if ($status->status == "0") {
                    echo "<div class=\"alert alert-info\">
                    <h5><i class=\"icon fas fa-info\"></i> Anda sudah mendaftar</h5>
                    Silahkan tunggu hasil pengumuman!
                    </div>";
                }
                if ($status->status == "1") {
                    echo "<div class=\"alert alert-danger\">
                    <h5><i class=\"icon fas fa-ban\"></i> Maaf anda tidak diterima</h5>
                    $status->keterangan
                    </div>";
                }
                if ($status->status == "2") {
                    echo "<div class=\"alert alert-success\">
                    <h5><i class=\"icon fas fa-check\"></i> Selamat anda diterima</h5>
                    Silahkan tunggu info lebih lanjut
                    </div>";
                }
            }
            ?>
            <?php
            $date = date('Y-m-d');
            if (empty($info) || $info->status == "1" || $date < $info->pengumpulan_awal || $date > $info->pengumpulan_akhir) { ?>
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> PENDAFTARAN DITUTUP</h5>
                    Penerimaan anggota baru belum dibuka
                </div>
            <?php } else { ?>
                <div class="card card-primary">
                    <div class="card-header" role="alert">
                        <h4 class="card-title">Pendaftaran Dibuka</h4>
                    </div>
                    <div class="card-body text-center">
                        <h4><?= tanggal_indo($info->pengumpulan_awal) . " s/d " . tanggal_indo($info->pengumpulan_akhir) ?></h4>
                        <!-- <a class="btn btn-primary" href="<!?= $info->formulir ?>" target="_blank">Download Formulir</a> -->
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title">Persyaratan</h4>
                    </div>
                    <div class="card-body">
                        <?= $info->persyaratan ?>
                    </div>
                    <?php
                    if($info->link_persyaratan){
                    ?>
                    <div class="card-footer text-center">
                        <a class="btn btn-primary" href="<?= $info->link_persyaratan ?>" target="_blank">Download Persyaratan</a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fas fa-info-circle"></i> Tanggal Penting</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3 col-6 border-right border-left">
                                <div class="description-block">
                                    <h5 class="description-header">Pengumpulan Berkas</h5>
                                    <p class="description-body">
                                        <?= tanggal_indo($info->pengumpulan_awal) ?><br>s/d<br><?= tanggal_indo($info->pengumpulan_akhir) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6 border-right border-left">
                                <div class="description-block">
                                    <h5 class="description-header">Seleksi Administrasi</h5>
                                    <p class="description-body">
                                        <?= tanggal_indo($info->administrasi_awal) ?><br>s/d<br><?= tanggal_indo($info->administrasi_akhir) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6 border-right border-left">
                                <div class="description-block">
                                    <h5 class="description-header">Seleksi Wawancara</h5>
                                    <p class="description-body">
                                        <?= tanggal_indo($info->wawancara_awal) ?><br>s/d<br><?= tanggal_indo($info->wawancara_akhir) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-3 col-6 border-right border-left">
                                <div class="description-block ">
                                    <h5 class="description-header">Pengumuman</h5>
                                    <p class="description-body">
                                        <br /><?= tanggal_indo($info->pengumuman) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
</div>
<?php endsection(); ?>
<?php getview('template/core') ?>