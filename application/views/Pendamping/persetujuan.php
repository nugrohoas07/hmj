<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('pendamping/index') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Persetujuan</li>
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
                            <h3 class="card-title">Persetujuan Surat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Perihal</th>
                                        <th>Keterangan</th>
                                        <th>Lampiran</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $no = "1";
                                foreach ($persetujuan as $row) :
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $no ?></td>
                                        <td width="100"><?= to_date($row->tanggal) ?></td>
                                        <td><?= $row->perihal ?></td>
                                        <td><?= $row->keterangan ?></td>
                                        <td class="text-center">
                                            <a href="<?= site_url('ketum/download/surat_proker/') . $row->lampiran ?>" target="_blank" class="btn btn-primary btn-sm"download>Lihat File</a>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($row->status == 5) { ?>
                                                <p class="text">Selesai Disetujui</p> <?php
                                                                                    } elseif ($row->status == 6) { ?>
                                                <p class="text"><?= $row->tolak ?></p> <?php
                                                                                    } elseif ($row->status == 3) { ?>
                                                <p class="text">Belum Disetujui</p> <?php } ?>
                                                
                                        </td>
                                        <td class="text-center">
                                            <?php if ($row->status == 3) { ?>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#setuju" onclick="fetchSetuju(this)" data-id_dokumen="<?= $row->id_dokumen ?>" data-tanggal="<?= $row->tanggal ?>" data-perihal="<?= $row->perihal ?>" data-tujuan="<?= $row->keterangan ?>" data-lampiran="<?= $row->lampiran ?>"></i>Setuju</button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolak" onclick="fetchTolak(this)" data-id_dokumen="<?= $row->id_dokumen ?>">Tolak</button>
                                            <?php } elseif ($row->status == 5 || $row->status == 6) { ?>
                                                <p class="text">No Action</p>
                                            <?php } ?>
                                        </td>
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
<div class="modal fade" id="setuju" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: dodgerblue; color: whitesmoke;">
                <h5 class="modal-title">Setujui Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('pendamping/persetujuan') ?>" method="post" enctype="multipart/form-data" class="form-submit">

                    <div class="form-group">
                        <label for="exampleInputFile">Upload File Yang Di Setujui</label>
                       <div class="form-group">
                    <label for="lampiran"><small class="text-danger"> (format file docx maks 2MB)</small></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="lampiran" data-validation="extension size" data-validation-min-size="1kb" data-validation-max-size="2M" data-validation-allowing="docx">
                        <label class="custom-file-label" for="lampiran">Choose file</label>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="hidden" name="id_dokumen" id="id_dokumen_setuju" data-validation="required">
                    <input type="hidden" name="lampiran_ada" id="lampiran_edit">
                    <input type="hidden" name="setuju">
                    <button type="submit" class="btn btn-primary" data-btn="setuju">Beri</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tolak" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Tolak Persetujuan Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('Pendamping/persetujuan') ?>" method="post" enctype="multipart/form-data" class="form-submit">

                    <div class="form-group">
                        <label for="keterangan">Beri Keterangan Menolak</label>
                        <input type="text" class="form-control" id="tolak_edit" name="keterangan" placeholder="Berikan Kritik/Saran" data-validation="required">
                    </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id_dokumen" id="id_dokumen_tolak" data-validation="required">
                <input type="hidden" name="tolak">
                <button type="submit" class="btn btn-danger" data-btn="tolak">Ya</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endsection(); ?>
<?php section('scripts') ?>
<script>
    function fetchSetuju(identifier) {
        var button = $(identifier);
        var id_dokumen = button.data('id_dokumen');

        $('#id_dokumen_setuju').val(id_dokumen);
    }

    function fetchTolak(identifier) {
        var button = $(identifier);
        var id_dokumen = button.data('id_dokumen');
        var tolak = button.data('tolak');

        $('#id_dokumen_tolak').val(id_dokumen);
        $('#tolak_edit').val(tolak);
    }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>