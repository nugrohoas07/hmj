<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('pendamping/index') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Rekap Surat</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Rekap Surat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>No Surat</th>
                                        <th>Perihal</th>
                                        <th>Keterangan</th>
                                        <th>Lampiran</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <?php
                                $no = "1";
                                foreach ($rekap as $row) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?></td>
                                        <td width="100"><?= to_date($row->tanggal) ?></td>
                                        <td><?= $row->no_dok ?></td>
                                        <td><?= $row->nama_dok ?></td>
                                        <td><?= $row->keterangan ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url('ketum/download/surat_keluar_masuk/') . $row->lampiran ?>" target="_blank" class="btn btn-primary btn-xs">Lihat File</a>
                                        </td>
                                        <td><?php if ($row->status == 0) {
                                                echo 'Keluar';
                                            } else {
                                                echo 'Masuk';
                                            } ?></td>

                                    </tr>
                                <?php
                                    $no++;
                                endforeach;
                                ?>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php endsection(); ?>
<?php getview('template/core') ?>