<?php section('contents'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">HMJ</a></li>
            <li class="breadcrumb-item active">Persetujuan</li>
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
              <h3 class="card-title">Persetujuan Pengajuan Dana</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Keperluan</th>
                    <th>Tanggal Diperlukan</th>
                    <th>Jumlah</>
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
                      <td><?= $row->nama ?></td>
                      <td><?= $row->keperluan ?></td>
                      <td class="text-center"><?= tanggal_indo($row->tanggal) ?></td>
                      <td style="text-align: right;"><?= 'Rp. ' . number_format($row->pengeluaran) ?></td>
                        <?php
                        if ($row->status == 0) {
                          $status = 'belum disetujui';
                        } elseif ($row->status == 1) {
                          $status = 'disetujui';
                        } elseif ($row->status == 2) {
                          $status = 'ditolak';
                        }
                        ?>
                      <td class="text-center">
                        <?php
                        if ($row->status == 1) {
                          echo 'direkap';
                        } else {
                        ?>
                          <button class="btn btn-primary btn-xs" title="Lihat Detail" data-toggle="modal" data-target="#detail" onclick="fetchDetail(this);" data-tanggal="<?= tanggal_indo($row->tanggal) ?>" data-nim="<?= $row->username ?>" data-nama="<?= $row->nama ?>" data-proker="<?= $row->proker ?>" data-keperluan="<?= $row->keperluan ?>" data-pengeluaran="<?= 'Rp. ' . number_format($row->pengeluaran) ?>" data-status="<?= $status ?>" data-tgl_ajukan="<?=to_date_time($row->tgl_ajukan);?>"><i class="fa fa-eye"></i></button>
                          <button class="btn btn-success btn-xs" title="Setuju" data-toggle="modal" data-target="#setuju" onclick="fetchSetuju(this)" data-id_saldo="<?= $row->id_saldo ?>" data-id_proker="<?= $row->id_proker ?>" data-status="<?= $row->status ?>" data-tgl_terima="<?= $row->tgl_terima ?>" data-pengeluaran="<?= $row->pengeluaran ?>"><i class="fa fa-check"></i></button>
                          <button class="btn btn-danger btn-xs" title="Tolak" data-toggle="modal" data-target="#tolak" onclick="fetchTolak(this)" data-id_saldo="<?= $row->id_saldo ?>" data-status="<?= $row->status ?>" data-tgl_terima="<?= $row->tgl_terima ?>" data-pengeluaran="<?= $row->pengeluaran ?>"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                <?php
                        }
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

<div class="modal fade" id="detail" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Detail Pengajuan Dana</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <dl>
                  <dt>Tanggal Diperlukan</dt>
                  <dd id="tanggal_detail"></dd>
                  <dt>NIM</dt>
                  <dd id="nim_detail"></dd>
                  <dt>Nama</dt>
                  <dd id="nama_detail"></dd>
                  <dt>Proker</dt>
                  <dd id="proker_detail"></dd>
                  <dt>Keperluan</dt>
                  <dd id="keperluan_detail"></dd>
                  <dt>Jumlah</dt>
                  <dd id="pengeluaran_detail"></dd>
                  <dt>Status</dt>
                  <dd id="status_detail"></dd>
                  <dt>Diajukan Pada</dt>
                  <dd id="tgl_ajukan_detail"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="setuju" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title">Persetujuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="<?= site_url('Bendahara/persetujuan') ?>" method="post" enctype="multipart/form-data" class="form-submit" >
          <h4 class="text-center">Yakin Anda Setuju?</h4>
          <div class="form-group">
                <label><small class="text-danger">(Hanya File .jpg, .jpeg, .png, .pdf, Ukuran Maks. 2MB)</small></label>
            <div class="custom-file">
              <input type="file" name="bukti" class="custom-file-input" id="bukti" data-validation="required size extension" data-validation-allowing="jpg, jpeg, png, png" data-validation-min-size="1kb" data-validation-max-size="2M">
              <label class="custom-file-label" for="bukti">Upload Bukti Serah/Terima</label>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <div class="form-group">
          <input type="hidden" name="id_saldo" id="id_saldo_setuju" required>
          <input type="hidden" name="id_proker" id="id_proker_setuju" required>
          <input type="hidden" name="tgl_terima" id="tgl_terima_setuju" required>
          <input type="hidden" name="pengeluaran" id="pengeluaran_setuju">
          <input type="hidden" name="setuju">
          <button type="submit" class="btn btn-success" >Setuju</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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
        <h5 class="modal-title">Persetujuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <form role="form" action="<?= site_url('Bendahara/persetujuan') ?>" method="post" enctype="multipart/form-data" class="form-submit" >
          <h4>Yakin Anda Tolak?</h4>
      </div>
      <div class="modal-footer">
        <div class="form-group">
          <input type="hidden" name="id_saldo" id="id_saldo_tolak" required>
          <input type="hidden" name="tgl_terima" id="tgl_terima_tolak" required>
          <input type="hidden" name="pengeluaran" id="pengeluaran_tolak">
          <input type="hidden" name="tolak">
          <button type="submit" class="btn btn-danger" >Tolak</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
    function fetchDetail(identifier){
        var button = $(identifier);
        var tanggal = button.data('tanggal');
        var nim = button.data('nim');
        var nama = button.data('nama');
        var proker = button.data('proker');
        var keperluan = button.data('keperluan');
        var pengeluaran = button.data('pengeluaran');
        var status = button.data('status');
        var tgl_ajukan = button.data('tgl_ajukan');

        $('#tanggal_detail').html(tanggal);
        $('#nim_detail').html(nim);
        $('#nama_detail').html(nama);
        $('#proker_detail').html(proker);
        $('#keperluan_detail').html(keperluan);
        $('#pengeluaran_detail').html(pengeluaran);
        $('#status_detail').html(status);
        $('#tgl_ajukan_detail').html(tgl_ajukan);
    }

  function fetchSetuju(identifier) {
    var button = $(identifier);
    var id_saldo = button.data('id_saldo');
    var id_proker = button.data('id_proker');
    var tgl_terima = button.data('tgl_terima');
    var pengeluaran = button.data('pengeluaran');

    $('#id_saldo_setuju').val(id_saldo);
    $('#id_proker_setuju').val(id_proker);
    $('#tgl_terima_setuju').val(tgl_terima);
    $('#pengeluaran_setuju').val(pengeluaran);
  }

  function fetchTolak(identifier) {
    var button = $(identifier);
    var id_saldo = button.data('id_saldo');
    var tgl_terima = button.data('tgl_terima');
    var pengeluaran = button.data('pengeluaran');

    $('#id_saldo_tolak').val(id_saldo);
    $('#tgl_terima_tolak').val(tgl_terima);
    $('#pengeluaran_setuju').val(pengeluaran);
  }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>