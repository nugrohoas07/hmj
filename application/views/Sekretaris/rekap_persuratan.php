<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('sekretaris/index') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Rekap Persuratan</li>
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
                            <h3 class="card-title">Rekap Persuratan</h3>
                        </div>
                        <div class="card-body">
                            <div class="block mb-4 text-left">
                                <a href="<?= site_url('Sekretaris/addRekap'); ?>" class="btn btn-success" data-toggle="tooltip" title="Tambah Rekapan"><i class="fa fa-plus"></i> Tambah Rekapan</a>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>No Surat</th>
                                        <th>Perihal</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Lampiran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                            <td><?php if ($row->status == 0) {
                                                    echo 'Keluar';
                                                } else {
                                                    echo 'Masuk';
                                                } ?></td>
                                            <td class="text-center">
                                                <a href="<?= site_url('ketum/download/surat_keluar_masuk/') . $row->lampiran ?>" target="_blank" class="btn btn-primary">Lihat File</a>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit" onclick="fetchEdit(this)" data-id_dokumen="<?= $row->id_dokumen ?>" data-tanggal="<?= $row->tanggal ?>" data-no_dok="<?= $row->no_dok ?>" data-nama_dok="<?= $row->nama_dok ?>" data-keterangan="<?= $row->keterangan ?>" data-status="<?= $row->status ?>" data-contoh="<?= $row->lampiran ?>"><i class="fa fa-edit"></i></button>
                                                 <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="fetchHapus(this)" data-id_dokumen="<?= $row->id_dokumen ?>"><i class="fa fa-trash"></i></button>
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
    </section>
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: dodgerblue; color: whitesmoke;">
                <h5 class="modal-title">Edit Rekap Persuratan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo site_url('Sekretaris/rekap_surat') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input autocomplete="off" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#default-date-picker" id="default-date-picker" name="tanggal" data-validation="required">
                        </div>
                        <div class="form-group">
                            <label for="no_dok">No Surat</label>
                            <input type="text" class="form-control" id="nodok_edit" name="no_dok" placeholder="Isi No. Surat" data-validation="required">
                        </div>
                        <div class="form-group">
                            <label for="nama_dok">Perihal</label>
                            <input type="text" class="form-control" id="namadok_edit" name="nama_dok" placeholder="Perihal Surat" data-validation="required">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan_edit" name="keterangan" placeholder="Keterangan Surat" data-validation="required">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <input type="text" class="form-control" id="status_edit" name="status">
                        </div>
                        <div class="form-group">
                        <label for="lampiran">Lampiran<small class="text-danger"> (format file png,jpg,jpeg,docx,pdf, maks 2MB)</small></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="lampiran" data-validation="extension size required" data-validation-min-size="1kb" data-validation-max-size="2M" data-validation-allowing="png,jpg,jpeg,docx,pdf">
                            <label class="custom-file-label" for="lampiran">Choose file</label>
                        </div>
                    <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <input type="hidden" name="id_dokumen" id="id_dokumen_edit" data-validation="required">
                        <input type="hidden" name="lampiran_ada" id="lampiran_edit">
                        <input type="hidden" name="edit">
                        <button type="submit" class="btn btn-primary" data-btn="edit">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
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
                <form role="form" action="<?php echo site_url('sekretaris/rekap_surat') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                    <input type="hidden" name="id_dokumen" id="id_dokumen_hapus" data-validation="required">
                    <input type="hidden" name="hapus">
                    <button type="submit" class="btn btn-danger" data-btn="hapus">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endsection(); ?>
<?php section('scripts') ?>
<script>
    function fetchEdit(identifier) {
        var button = $(identifier);
        var id_dokumen = button.data('id_dokumen');
        var tanggal = button.data('tanggal');
        var no_dok = button.data('no_dok');
        var perihal = button.data('nama_dok');
        var keterangan = button.data('keterangan');
        var status = button.data('status');
        var lampiran = button.data('lampiran');

        $('#id_dokumen_edit').val(id_dokumen);
        $('#tanggal_edit').val(tanggal);
        $('#nodok_edit').val(no_dok);
        $('#namadok_edit').val(perihal);
        $('#keterangan_edit').val(keterangan);
        $('#status_edit').val(status);
        $('#lampiran_edit').val(lampiran);
    }

    function fetchHapus(identifier) {
        var button = $(identifier);
        var id_dokumen = button.data('id_dokumen');

        $('#id_dokumen_hapus').val(id_dokumen);
    }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>