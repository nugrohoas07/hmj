<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Pendamping') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Verifikasi Proker</li>
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
                            <h3 class="card-title">Daftar Persetujuan Program Kerja</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pelaksanaan</th>
                                        <th>Program Kerja</th>
                                        <th>Ketua Pelaksana</th>
                                        <th>Panitia</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>                    
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($proker as $row): 
                                    $panitia = $row->panitia;
                                    $ketua = $this->model_user->getUser($row->ketua)->nama; ?>
                                    <tr>
                                    <td><?= $no ?></td>
                                    <td><?= to_date($row->tgl_pelaksanaan)." s/d ".to_date($row->tgl_selesai) ?></td>
                                    <td><?= $row->nama_proker ?></td>
                                    <td><?= $ketua ?></td>
                                    <td class="text-center"><?php if($panitia==""){echo "Belum Upload";}else{ ?> <a href="<?= base_url('/upload/proker/'.$panitia); ?>" title="Lihat File" class="btn btn-primary btn-sm">Lihat File</a> <?php } ?> </td>
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm" title="Setuju" data-toggle="modal" data-target="#terima" onclick="setujuData(this);" data-id_proker="<?= $row->id_proker ?>" data-proker="<?= $row->nama_proker ?>" ><i class="fas fa-check-circle"></i></button>
                                        <button class="btn btn-danger btn-sm" title="Tolak" data-toggle="modal" data-target="#tolak" onclick="tolakData(this);" data-id_proker="<?= $row->id_proker ?>" data-proker="<?= $row->nama_proker ?>" ><i class="fa fa-times-circle"></i></button>
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

<div class="modal fade" id="terima" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h4 class="modal-title">Verifikasi Proker</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="<?= site_url('pendamping/proker'); ?>" class="form-submit" method="post">
        <div class="modal-body">
        <b>Anda yakin ingin menyetujui <span id="proker_setuju"></span> ?</b>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_proker" id="id_proker_setuju">
          <input type="hidden" name="setuju">
          <button type="submit" class="btn btn-success">Terima</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="tolak" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title">Tolak Proker</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="<?= site_url('pendamping/proker'); ?>" class="form-submit" method="post">
        <div class="modal-body">
        <b>Anda yakin ingin menolak <span id="proker_tolak"></span> ?</b>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_proker" id="id_proker_tolak">
          <input type="hidden" name="tolak">
          <button type="submit" class="btn btn-danger">Tolak</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
    function setujuData(identifier){
        var button = $(identifier);
        var id_proker = button.data('id_proker');
        var proker = button.data('proker');

        $('#proker_setuju').html(proker);
        $('#id_proker_setuju').val(id_proker);
    }
    function tolakData(identifier){
        var button = $(identifier);
        var id_proker = button.data('id_proker');
        var proker = button.data('proker');

        $('#proker_tolak').html(proker);
        $('#id_proker_tolak').val(id_proker);
    }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>