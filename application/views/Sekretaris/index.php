<?php section('contents'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Sekretaris') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Dashboard</li
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php
                            echo count($persetujuan);
                            ?>
                            </h3>

                            <p>Persetujuan Baru</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <a href="<?= site_url('Sekretaris/persetujuan') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php
                            echo count($rekap);
                            ?>
                            </h3>
                            <p>Rekap Persuratan</p>
                        </div>
                         <div class="icon">
                            <i class="fas fa-mail-bulk"></i>
                        </div>
                        <a href="<?= site_url('Sekretaris/rekap_surat') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php
                            echo count($format);
                            ?>
                            </h3>

                            <p>Format Persuratan</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <a href="<?= site_url('Sekretaris/format_surat') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php
                            echo count($log_progress);
                            ?>
                            </h3>
                            <p>Progress Program Kerja</p>
                        </div>
                         <div class="icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <a href="<?= site_url('Sekretaris/progress') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        </div>
    </section>
</div>
<?php endsection(); ?>
<?php getview('template/core') ?>