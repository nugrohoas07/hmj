<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('sekretaris/index') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Format Persuratan</li>
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
                            <h3 class="card-title">Format Persuratan</h3>
                        </div>
                        <div class="card-body">
                            <div class="block mb-4 text-left">
                                <a href="<?= site_url('Sekretaris/addFormat'); ?>" class="btn btn-success" data-toggle="tooltip" title="Tambah Format"><i class="fa fa-plus"></i> Tambah Format</a>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Perihal</th>
                                        <th>Tujuan</th>
                                        <th>Contoh</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = "1";
                                    foreach ($format as $row) :
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no ?></td>
                                            <td><?= $row->nama_form ?></td>
                                            <td><?= $row->keterangan ?></td>
                                            <td class="text-center">
                                                <a href="<?= site_url('ketum/download/format_surat/') . $row->file ?>" target="_blank" class="btn btn-primary">Lihat File</a>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit" onclick="fetchEdit(this)" data-id_form="<?= $row->id_form ?>" data-tanggal="<?= $row->tanggal ?>" data-perihal="<?= $row->nama_form ?>" data-tujuan="<?= $row->keterangan ?>" data-contoh="<?= $row->file ?>"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="fetchHapus(this)" data-id_form="<?= $row->id_form ?>"><i class="fa fa-trash"></i></button>
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
            <div class="modal-header" style="background-color: dodgerblue; color: whitesmoke;">
                <h5 class="modal-title">Edit Format Persuratan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo site_url('Sekretaris/format_surat') ?>" method="post" enctype="multipart/form-data" class="form-submit">
            <div class="modal-body">
                        <div class="form-group">
                            <label for="perihal">Perihal</label>
                            <input type="text" class="form-control" id="perihal_edit" name="perihal" placeholder="" data-validation="required">
                        </div>
                        <div class="form-group">
                            <label for="tujuan">Tujuan</label>
                            <input type="text" class="form-control" id="tujuan_edit" name="tujuan" placeholder="Ditujukan Kepada" data-validation="required">
                        </div>
                        <div class="form-group">
                    <label for="contoh">Contoh<small class="text-danger"> (format file docx maks 2MB)</small></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="contoh" data-validation="extension size required" data-validation-min-size="1kb" data-validation-max-size="2M" data-validation-allowing="docx">
                        <label class="custom-file-label" for="contoh">Choose file</label>
                    </div>
                    </div>
                    <!-- /.card-body -->
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="hidden" name="id_form" id="id_form_edit" data-validation="required">
                    <input type="hidden" name="contoh_ada" id="contoh_edit">
                    <input type="hidden" name="edit">
                    <button type="submit" class="btn btn-primary" data-btn="edit">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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
                <form role="form" action="<?php echo site_url('sekretaris/format_surat') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                    <input type="hidden" name="id_form" id="id_form_hapus" data-validation="required">
                    <input type="hidden" name="hapus">
                    <button type="submit" class="btn btn-danger" data-btn="hapus">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                
            </div>
            </form>
        </div>
    </div>
</div>
<?php endsection(); ?>
<?php section('scripts') ?>
<script>
    function fetchEdit(identifier) {
        var button = $(identifier);
        var id_form = button.data('id_form');
        var perihal = button.data('perihal');
        var tujuan = button.data('tujuan');
        var contoh = button.data('contoh');

        $('#id_form_edit').val(id_form);
        $('#perihal_edit').val(perihal);
        $('#tujuan_edit').val(tujuan);
        $('#contoh_edit').val(contoh);
    }

    function fetchHapus(identifier) {
        var button = $(identifier);
        var id_form = button.data('id_form');

        $('#id_form_hapus').val(id_form);
    }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>