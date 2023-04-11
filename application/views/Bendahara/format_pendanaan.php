<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Format Pendanaan</li>
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
                            <h3 class="card-title">Contoh Format Pendanaan</h3>
                        </div>
                        <div class="card-body">
                            <div class="block mb-4 text-left">
                                <a href="<?= site_url('Bendahara/addFormat'); ?>" class="btn btn-success" title="Tambah Format Pendanaan"><i class="fa fa-plus"> </i> Tambah</a>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Keperluan</th>
                                        <th>Contoh</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($format as $row) :
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no ?></td>
                                            <td><?= $row->keterangan ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url('/upload/format_dana/') . $row->file ?>" target="_blank" class="btn btn-primary">Lihat File</a>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-primary btn-xs" title="Edit" data-toggle="modal" data-target="#edit" onclick="fetchEdit(this)" data-id_form="<?= $row->id_form ?>" data-keperluan="<?= $row->keterangan ?>" data-contoh="<?= $row->file ?>"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#hapus" onclick="fetchHapus(this)" data-id_form="<?= $row->id_form ?>"><i class="fa fa-trash"></i></button>
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

<!--modal-->
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
                <form role="form" action="<?php echo site_url('Bendahara/format') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                    <div class="form-group">
                        <label for="keperluan">Keperluan</label>
                        <input type="text" class="form-control" id="keperluan_edit" name="keperluan" placeholder="Penggunaan Dana" data-validation="required">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Contoh <small class="text-danger">(Hanya File .docx, Ukuran Maks. 2MB)</small></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="contoh" class="custom-file-input" id="exampleInputFile" data-validation="size extension" data-validation-allowing="docx" data-validation-min-size="1kb" data-validation-max-size="2M">
                                <label class="custom-file-label" for="exampleInputFile">Upload File</label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="hidden" name="id_form" id="id_form_edit" required>
                    <input type="hidden" name="contoh_ada" id="contoh_edit">
                    <input type="hidden" name="edit">
                    <button type="submit" class="btn btn-primary" >Simpan</button>
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
                <form role="form" action="<?php echo site_url('Bendahara/format') ?>" method="post" enctype="multipart/form-data" class="form-submit" >
                    <input type="hidden" name="id_form" id="id_form_hapus" required>
                    <input type="hidden" name="hapus">
                    <button type="submit" class="btn btn-danger" >Ya</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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
        var id_form = button.data('id_form');
        var keperluan = button.data('keperluan');
        var contoh = button.data('contoh');

        $('#id_form_edit').val(id_form);
        $('#keperluan_edit').val(keperluan);
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