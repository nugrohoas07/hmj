<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= site_url('staff/index') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Pengajuan Surat</li>
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
                            <h3 class="card-title">Pengajuan Surat</h3>
                        </div>
                        <div class="card-body">
                            <div class="block mb-4 text-left">
                                <a href="<?= site_url('staff/addSurat') ?>" class="btn btn-success" data-toggle="tooltip" title="Ajukan Surat"><i class="fa fa-plus"></i> Ajukan Surat</a>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Perihal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = "1";
                                    foreach ($surat as $row) :
                                        $status = $row->status;

                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no ?></td>
                                            <td width="100"><?= to_date($row->tanggal) ?></td>
                                            <td><?= $row->perihal ?></td>
                                            <td class="text-center">
                                                <?php
                                                if ($status == "0") { ?>
                                                    <p class="text">Menunggu Persetujuan Sekretaris</p>
                                                <?php
                                                } elseif ($status == "1") { ?>
                                                    <p class="text">Menunggu Persetujuan Kahim</p>
                                                <?php
                                                } elseif ($status == "2") { ?>
                                                    <p class="text">Ditolak Sekretaris</p>
                                                <?php
                                                } elseif ($status == "3") { ?>
                                                    <p class="text">Menunggu Persetujuan Pendamping</p>
                                                <?php
                                                } elseif ($status == "4") { ?>
                                                    <p class="text">Ditolak Kahim</p>
                                                <?php
                                                } elseif ($status == "5") { ?>
                                                    <p class="text">Pengajuan Selesai</p>
                                                <?php
                                                } elseif ($status == "6") { ?>
                                                    <p class="text">Ditolak Pendamping</p>
                                                <?php
                                                } ?>

                                            </td>

                                            <td class="text-center">
                                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#detail" title="Lihat Detail" onclick="fetchDetail(this);" data-id_dokumen="<?= $row->id_dokumen ?>" data-tanggal="<?= $row->tanggal ?>" data-perihal="<?= $row->perihal ?>"  data-keterangan="<?= $row->keterangan ?>" data-lampiran="<?= $row->lampiran ?>" data-status="<?= $row->status ?>" data-tolak="<?= $row->tolak ?>"><i class="fa fa-eye"></i></button>

                                                <?php
                                                if ($status == "0" || $status == "2" || $status == "4" || $status == "6") { ?>
                                                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit" onclick="fetchEdit(this)" data-id_dokumen="<?= $row->id_dokumen ?>" data-tanggal="<?= $row->tanggal ?>" data-perihal="<?= $row->perihal ?>" data-keterangan="<?= $row->keterangan ?>" data-lampiran="<?= $row->lampiran ?>"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="fetchHapus(this)" data-id_dokumen="<?= $row->id_dokumen ?>"><i class="fa fa-trash"></i></button>
                                                <?php } ?>
                                                <?php
                                                if ($status == "2" || $status == "4" || $status == "6") { ?>
                                                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ajukan" onclick="fetchAjukan(this)" data-id_dokumen="<?= $row->id_dokumen ?>"></i>Ajukan Ulang</button>
                                                <?php } ?>
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
                <h5 class="modal-title">Konfirmasi Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('Staff/surat') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input autocomplete="off" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#default-date-picker" id="default-date-picker" name="tanggal" required />
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <input type="text" class="form-control" id="perihal_edit" name="perihal" placeholder="Perihal Surat Dibuat" data-validation="required">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Tujuan</label>
                        <input type="text" class="form-control" id="keterangan_edit" name="keterangan" placeholder="Ditujukan Kepada" data-validation="required">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Lampiran</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="lampiran" class="custom-file-input" id="exampleInputFile" data-validation="required">
                                <label class="custom-file-label" for="exampleInputFile">Upload File</label>
                            </div>
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
                <form role="form" action="<?php echo site_url('Staff/surat') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                    <input type="hidden" name="id_dokumen" id="id_dokumen_hapus" data-validation="required">
                    <input type="hidden" name="hapus">
                    <button type="submit" class="btn btn-danger" data-btn="hapus">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ajukan" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Konfirmasi Ajukan Ulang</h5>
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
                <form role="form" action="<?php echo site_url('Staff/surat') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                    <input type="hidden" name="id_dokumen" id="id_dokumen_ajukan" data-validation="required">
                    <input type="hidden" name="ajukan">
                    <button type="submit" class="btn btn-primary" data-btn="ajukan">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="detail" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Detail Surat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dl>
                    <dd id="id_dokumen_detail"></dd>
                    <dt>Tanggal</dt>
                    <dd id="tanggal"></dd>
                    <dt>Perihal</dt>
                    <dd id="perihal"></dd>
                    <dt>Keterangan</dt>
                    <dd id="keterangan"></dd>
                    <dt>Lampiran</dt>
                    <dd><a id="lampiran_detail"></a></dd>
                    <dt>Status</dt>
                    <dd><b id="status"></b></dd>
                    <dd id="tolak"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
    function fetchEdit(identifier) {
        var button = $(identifier);
        var id_dokumen = button.data('id_dokumen');
        var tanggal = button.data('tanggal');
        var perihal = button.data('perihal');
        var keterangan = button.data('keterangan');
        var lampiran = button.data('lampiran');

        $('#id_dokumen_edit').val(id_dokumen);
        $('#tanggal_edit').val(tanggal);
        $('#perihal_edit').val(perihal);
        $('#keterangan_edit').val(keterangan);
        $('#lampiran_edit').val(lampiran);
    }

    function fetchAjukan(identifier) {
        var button = $(identifier);
        var id_dokumen = button.data('id_dokumen');

        $('#id_dokumen_ajukan').val(id_dokumen);
    }

    function fetchHapus(identifier) {
        var button = $(identifier);
        var id_dokumen = button.data('id_dokumen');

        $('#id_dokumen_hapus').val(id_dokumen);
    }

    function fetchDetail(identifier) {
        var button = $(identifier);
        var id_dokumen = button.data('id_dokumen');
        var tanggal = button.data('tanggal');
        var perihal = button.data('perihal');
        var keterangan = button.data('keterangan');
        var lampiran = button.data('lampiran');
        var status = button.data('status');
        if (button.data('tolak') !== null) {
            var tolak = button.data('tolak');
            $('#tolak').html(tolak);
        }
        var path_lampiran = "<?= site_url('ketum/download/surat_proker/'); ?>" + lampiran;

        $('#id_dokumen_detail').val(id_dokumen);
        $('#tanggal_edit').val(tanggal);
        $('#perihal').html(perihal);
        $('#keterangan').html(keterangan);

        if (lampiran == "") {
            $('#lampiran_detail').html("Belum Upload").removeAttr("href").removeAttr("class");
        } else {
            $('#lampiran_detail').html("Lihat File").attr('href', path_lampiran).attr('class', "btn btn-primary");
        }

        if (status == "0") {
            $('#status').html("Belum Disetujui").attr('class', "text-warning")
        } else if (status == "1") {
            $('#status').html("Disetujui Sekretaris").attr('class', "text-primary")
        } else if (status == "2") {
            $('#status').html("Ditolak Sekretaris").attr('class', "text-danger")
        } else if (status == "3") {
            $('#status').html("Disetujui Kahim").attr('class', "text-primary")
        } else if (status == "4") {
            $('#status').html("Ditolak Kahim").attr('class', "text-danger")
        } else if (status == "5") {
            $('#status').html("Selesai").attr('class', "text-success")
        } else if (status == "6") {
            $('#status').html("Ditolak Pendamping").attr('class', "text-danger")
        }
    }
</script>
<?php endsection(); ?>
<?php getview('template/core'); ?>