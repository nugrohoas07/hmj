<?php section('contents'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('Sekbid') ?>">HMJ</a></li>
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
                    <td><?= $no ?></td>
                    <td><?= to_date($row->tanggal) ?></td>
                    <td><?= $proker ?></td>
                    <td><?= $row->kegiatan ?></td>
                    <td class="text-center" width="50">
                      <button class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#detail" title="Lihat Detail" onclick="getDetail(this);" data-proker="<?= $proker ?>" data-tanggal="<?= to_date($row->tanggal) ?>" data-kegiatan="<?= $row->kegiatan ?>" data-kendala="<?= $row->kendala ?>" data-masukan="<?= $row->masukan ?>"><i class="fa fa-eye"></i></button>
                    </td>
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

<div class="modal fade" id="detail" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Detail Progress</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
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
                  <dt>Masukan</dt>
                  <dd id="masukan_detail"></dd>
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
  function getDetail(identifier){
    var button = $(identifier);
    var proker = button.data('proker');
    var tanggal = button.data('tanggal');
    var kegiatan = button.data('kegiatan');
    var kendala = button.data('kendala');
    var masukan = button.data('masukan');

    $('#proker_detail').html(proker);
    $('#tanggal_detail').html(tanggal);
    $('#kegiatan_detail').html(kegiatan);
    
    if(kendala=="") $('#kendala_detail').html("Tidak ada kendala");
    else $('#kendala_detail').html(kendala);
    if(masukan=="") $('#masukan_detail').html("Tidak ada masukan");
    else $('#masukan_detail').html(masukan);
  }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>