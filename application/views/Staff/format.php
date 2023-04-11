<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Format Pengajuan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Contoh Format Pengajuan</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Format Pengajuan</th>
                                        <th>Keperluan</th>
                                        <th>Contoh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($format as $row) :
                                        if ($row->role == '0') {
                                            $role = 'surat';
                                        } elseif ($row->role == '1') {
                                            $role = 'dana';
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no ?></td>
                                            <td><?= ucfirst($role) ?></td>
                                            <td><?= $row->keterangan ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('/upload/format_' . $role . '/') . $row->file ?>" target="_blank" class="btn btn-primary">Lihat File</a>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    endforeach;
                                    ?>
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