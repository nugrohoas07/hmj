<?php section('contents'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('Bendahara') ?>">HMJ</a></li>
            <li class="breadcrumb-item active">Laporan Kegiatan</li>
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
              <h3 class="card-title">Laporan Kegiatan</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Program Kerja</th>
                    <th>Laporan Kegiatan</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($proker as $row) :
                  $status = $row->lpj_bendum;
                  ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?= $row->nama_proker ?></td>
                    <td class="text-center"><a href="<?= base_url('/upload/proker/'.$row->lpj) ?>" class="btn btn-primary">Lihat File</a></td>
                    <td class="text-center"><?php if($status=="0"){echo "Belum Disetujui";}elseif($status=="1"){echo "Disetujui";}elseif($status=="2") {echo "Ditolak";}?> </td>
                    <td class="text-center">
                      <?php
                      if ($status == "1" || $status == "2") {
                        echo "No Action";
                      } else {
                      ?>
                        <button class="btn btn-success btn-sm" title="Setuju" data-toggle="modal" data-target="#setuju" onclick="fetchSetuju(this)" data-id_proker="<?= $row->id_proker ?>" data-status="<?= $row->lpj_bendum ?>"><i class="fas fa-check-circle"></i></button>
                        <button class="btn btn-danger btn-sm" title="Tolak" data-toggle="modal" data-target="#tolak" onclick="fetchTolak(this)" data-id_proker="<?= $row->id_proker ?>" data-status="<?= $row->lpj_bendum ?>"><i class="fa fa-times-circle"></i></button>
                    </td>
                  </tr>
                  <?php } $no++; endforeach; ?>
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
      <div class="modal-header bg-success">
        <h5 class="modal-title">Persetujuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="<?= site_url('Bendahara/laporan') ?>" class="form-submit" method="post">
      <div class="modal-body">
          <h4 class="text-center">Yakin Anda Setuju?</h4>
      </div>
      <div class="modal-footer">
        <div class="form-group">
          <input type="hidden" name="id_proker" id="id_proker_setuju" required>
          <input name="jabatan" type="hidden" value="<?= $this->session->userdata('jabatan') ?>">
          <input name="status" type="hidden" value="1">
          <input type="hidden" name="setuju">
          <button type="submit" class="btn btn-success">Setuju</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
      </form>
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
      <form role="form" action="<?= site_url('Bendahara/laporan') ?>" class="form-submit" method="post">
      <div class="modal-body text-center">
          <h4>Yakin Anda Tolak?</h4>
      </div>
      <div class="modal-footer">
        <div class="form-group">
          <input type="hidden" name="id_proker" id="id_proker_tolak" required>
          <input name="jabatan" type="hidden" value="<?= $this->session->userdata('jabatan') ?>">
          <input name="status" type="hidden" value="2">
          <input type="hidden" name="tolak">
          <button type="submit" class="btn btn-danger">Tolak</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endsection(); ?>
<?php section('scripts') ?>
<script>
  function fetchSetuju(identifier) {
    var button = $(identifier);
    var id_proker = button.data('id_proker');

    $('#id_proker_setuju').val(id_proker);
  }

  function fetchTolak(identifier) {
    var button = $(identifier);
    var id_proker = button.data('id_proker');

    $('#id_proker_tolak').val(id_proker);
  }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>