<?php section('head'); ?>
<style type="text/css">
td {
    max-width: 300px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
</style>
<?php endsection(); ?>
<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Pendamping') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Progress</li>
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
                            <h3 class="card-title">Progress Program Kerja</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Program Kerja</th>
                                    <th>Kegiatan</th>
                                    <th>Masukan</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $no = 1;
                                foreach ($progress as $row): 
                                $masukan = $row->masukan;
                                $proker = $this->model_proker->getNamaProker($row->id_proker)->nama_proker;
                                ?>
                                <tr>
                                <td width="50"><?= $no ?></td>
                                <td width="100"><?= to_date($row->tanggal) ?></td>
                                <td><?= $proker ?></td>
                                <td width="40"><?= $row->kegiatan ?></td>
                                <td><?= ($row->masukan) ? $row->masukan : "Belum ada masukan" ?></td>
                                <td class="text-center" width="50"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#masukan" title="Tambahkan/Edit Masukan" onclick="getDetail(this);" data-proker="<?= $proker ?>" data-tanggal="<?= to_date($row->tanggal) ?>" data-kegiatan="<?= $row->kegiatan ?>" data-kendala="<?= $row->kendala ?>" data-masukan="<?= $row->masukan ?>" data-id_progress="<?= $row->id_progress ?>"><i class="fa fa-edit"></i></button></td>
                                </tr>
                                <?php $no++; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="masukan" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Masukan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('Pendamping/progress') ?>" class="form-submit" method="post">
                <div class="modal-body">
                <dl>
                    <dt>Program Kerja</dt>
                    <dd id="proker_detail"></dd>
                    <dt>Tanggal</dt>
                    <dd><span id="tanggal_detail"></span></dd>
                    <dt>Kegiatan</dt>
                    <dd id="kegiatan_detail"></dd>
                    <dt>Kendala</dt>
                    <dd id="kendala_detail"></dd>
                    <div class="form-group">
                    <label>Masukan</label>
                    <textarea class="form-control" rows="3" id="masukan" name="masukan" placeholder="Mohon tuliskan solusi terkait kegiatan"></textarea>
                    </div>
                </dl>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_progress" id="id_progress">
                    <input type="hidden" name="update">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
  function getDetail(identifier){
    var button = $(identifier);
    var proker = button.data('proker');
    var tanggal = button.data('tanggal');
    var kegiatan = button.data('kegiatan');
    var kendala = button.data('kendala');
    var masukan = button.data('masukan');
    var id_progress = button.data('id_progress');

    $('#id_progress').val(id_progress);
    $('#proker_detail').html(proker);
    $('#tanggal_detail').html(tanggal);
    $('#kegiatan_detail').html(kegiatan);
    if(kendala=="") $('#kendala_detail').html("Tidak ada kendala");
    else $('#kendala_detail').html(kendala);
    $('textarea#masukan').text(masukan);
  }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>