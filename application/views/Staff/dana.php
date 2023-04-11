<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('staff/index') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Pengajuan Dana</li>
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
                            <h3 class="card-title">Pengajuan Dana</h3>
                        </div>
                        <div class="card-body">
                            <div class="block mb-4 text-left">
                                <a href="<?= site_url('staff/addDana') ?>" class="btn btn-success" title="Tambah Pengajuan Dana"><i class="fa fa-plus"></i> Ajukan Dana</a>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Keperluan</th>
                                        <th>Tanggal Diperlukan</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($saldo as $row) :
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no ?></td>
                                            <td><?= $row->keperluan ?></td>
                                            <td class="text-center"><?= tanggal_indo($row->tanggal) ?></td>
                                            <td style="text-align: right;"><?= 'Rp. ' . number_format($row->pengeluaran) ?></td>
                                            <td class="text-center">
                                                <?php
                                                if ($row->status == 0) {
                                                    $status = 'belum disetujui';
                                                } elseif ($row->status == 1) {
                                                    $status = 'disetujui';
                                                } elseif ($row->status == 2) {
                                                    $status = 'ditolak';
                                                }
                                                echo $status;
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if ($row->status == 0 || $row->status == 1) {
                                                    echo 'No Action';
                                                } elseif ($row->status == 2) {
                                                ?>
                                                        <button class="btn btn-success btn-xs" title="Ajukan Ulang" data-toggle="modal" data-target="#ulang" onclick="fetchUlang(this)" data-id_saldo="<?= $row->id_saldo ?>"><i class="fa fa-paper-plane"></i></button>
                                                    <button class="btn btn-primary btn-xs" title="Edit" data-toggle="modal" data-target="#edit" onclick="fetchEdit(this)" data-id_saldo="<?= $row->id_saldo ?>" data-keperluan="<?= $row->keperluan ?>" data-tanggal="<?= $row->tanggal ?>" data-pengeluaran="<?= $row->pengeluaran ?>" data-tgl_ajukan="<?= $row->tgl_ajukan ?>"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#hapus" onclick="fetchHapus(this)" data-id_saldo="<?= $row->id_saldo ?>"><i class="fa fa-trash"></i></button>
                                                <?php }
                                                ?>
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

<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Konfirmasi Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('Staff/dana') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                    <div class="form-group">
                        <label for="keperluan">Keperluan</label>
                        <input type="text" class="form-control" id="keperluan_edit" name="keperluan" placeholder="Penggunaan Dana" data-validation="required">
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Diperlukan</label>
                        <input type="text" id="default-date-picker" name="tanggal" class="form-control datetimepicker-input" id="default-date-picker" data-toggle="datetimepicker" data-target="#default-date-picker" data-validation="required">
                    </div>
                    <div class="form-group">
                        <label for="pengeluaran">Jumlah</label>
                        <input type="text" class="form-control" id="pengeluaran_edit" name="pengeluaran" placeholder="Nominal Pengajuan" data-validation="required">
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="hidden" name="id_saldo" id="id_saldo_edit" required>
                    <input type="hidden" name="tgl_ajukan" id="tgl_ajukan_edit" required>
                    <input type="hidden" name="edit">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="hapus" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <strong>
                    <h4>Apakah anda yakin ?</h4>
                </strong>
            </div>
            <div class="modal-footer">
                <form role="form" action="<?php echo site_url('Staff/dana') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                    <input type="hidden" name="id_saldo" id="id_saldo_hapus" required>
                    <input type="hidden" name="hapus">
                    <button type="submit" class="btn btn-danger">Ya</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ulang" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title">Ajukan Ulang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <strong>
                    <h4>Apakah anda yakin ?</h4>
                </strong>
            </div>
            <div class="modal-footer">
                <form role="form" action="<?php echo site_url('Staff/dana') ?>" method="post" enctype="multipart/form-data" class="formSubmit" data-btn="ulang">
                    <input type="hidden" name="id_saldo" id="id_saldo_ulang" required>
                    <input type="hidden" name="ulang">
                    <button type="submit" class="btn btn-success" data-btn="ulang">Ya</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
    function fetchEdit(identifier) {
        var button = $(identifier);
        var id_saldo = button.data('id_saldo');
        var tanggal = button.data('tanggal');
        var keperluan = button.data('keperluan');
        var tgl_ajukan = button.data('tgl_ajukan');
        var pengeluaran = button.data('pengeluaran');

        $('#id_saldo_edit').val(id_saldo);
        $('#default-date-picker').val(tanggal);
        $('#keperluan_edit').val(keperluan);
        $('#tgl_ajukan_edit').val(tgl_ajukan);
        $('#pengeluaran_edit').val(pengeluaran);
    }

    function fetchHapus(identifier) {
        var button = $(identifier);
        var id_saldo = button.data('id_saldo');

        $('#id_saldo_hapus').val(id_saldo);
    }
    
    function fetchUlang(identifier) {
        var button = $(identifier);
        var id_saldo = button.data('id_saldo');

        $('#id_saldo_ulang').val(id_saldo);
    }
</script>
<?php endsection(); ?>
<?php getview('template/core'); ?>