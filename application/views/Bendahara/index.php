<?php section('contents'); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Bendahara') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h4><?php
                                echo count($persetujuan);
                                ?>
                            </h4>
                            <p>Persetujuan Baru</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-balance-scale"></i>
                        </div>
                        <a href="<?= site_url('Bendahara/persetujuan') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4><?php
                                foreach ($pemasukan as $row) {
                                    echo 'Rp ' . number_format($row->pemasukan);
                                }
                                ?>
                            </h4>
                            <p>Pemasukan Dana</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-piggy-bank"></i>
                        </div>
                        <a href="<?= site_url('Bendahara/rekap') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h4><?php
                                foreach ($pengeluaran as $row) {
                                    echo 'Rp ' . number_format($row->pengeluaran);
                                }
                                ?>
                            </h4>
                            <p>Pengeluaran Dana</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-donate"></i>
                        </div>
                        <a href="<?= site_url('Bendahara/rekap') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h4><?php
                                foreach ($pemasukan as $masuk) {
                                    foreach ($pengeluaran as $keluar) {
                                        $sisa = ($masuk->pemasukan) - ($keluar->pengeluaran);
                                        echo 'Rp ' . number_format($sisa);
                                    }
                                }
                                ?></h4>
                            <p>Sisa Dana</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-coins"></i>
                        </div>
                        <a href="<?= site_url('Bendahara/rekap') ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php endsection(); ?>
<?php getview('template/core') ?>