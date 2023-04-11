<?php section('head'); ?>
<style type="text/css">
td {
    max-width: 100px;
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
      <div class="row">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('Staff') ?>">HMJ</a></li>
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
              <div class="block mb-4 text-left">
                <a href="<?= site_url('staff/addProgress') ?>" class="btn btn-success" data-toggle="tooltip" title="Tambah Progress"><i class="fa fa-plus"></i> Tambah Progress</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr class="text-center">
                    <th width="10">No</th>
                    <th width="60">Tanggal</th>
                    <th width="130">Program Kerja</th>
                    <th>Kegiatan</th>
                    <th width="60">Masukan</th>
                    <th width="30">Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                foreach ($progress as $row): 
                $masukan = $row->masukan;
                $proker = $this->model_proker->getNamaProker($row->id_proker)->nama_proker;
                $status_proker = $this->model_proker->getNamaProker($row->id_proker)->status;
                ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= to_date($row->tanggal) ?></td>
                  <td><?= $proker ?></td>
                  <td width="40"><?= $row->kegiatan ?></td>
                  <td><?php if($masukan==null){ echo "Tidak ada Masukan"; }else{ echo $masukan; } ?></td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#detail" title="Lihat Detail" onclick="getDetail(this);" data-proker="<?= $proker ?>" data-tanggal="<?= to_date($row->tanggal) ?>" data-kegiatan="<?= $row->kegiatan ?>" data-kendala="<?= $row->kendala ?>" data-masukan="<?= $row->masukan ?>"><i class="fa fa-eye"></i></button>
                    <?php if($status_proker!="3"){ ?>
                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit" title="Edit" onclick="getEdit(this);" data-proker="<?= $row->id_proker ?>" data-tanggal="<?= $row->tanggal ?>" data-kegiatan="<?= $row->kegiatan ?>" data-kendala="<?= $row->kendala ?>" data-masukan="<?= $row->masukan ?>" data-id_progress="<?= $row->id_progress ?>"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" title="Hapus" onclick="getHapus(this);" data-id_progress="<?= $row->id_progress ?>" ><i class="fa fa-trash"></i></button><?php } ?>
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

<div class="modal fade" id="edit" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title">Edit Progress</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="<?= site_url('Staff/progress') ?>" class="form-submit" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label>Program Kerja</label>
            <select id="proker_edit" name="proker" class="form-control select2" style="width: 100%;" data-validation="required">
            <option hidden disabled selected value> -- Pilih Program Kerja -- </option>
            <?php foreach ($listprok as $row): ?>
                <option value="<?= $row->id_proker ?>" ><?= $row->nama_proker ?></option>
            <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input name="tgl" autocomplete="off" type="text" class="form-control" placeholder="Tanggal Kegiatan" id="default-date-picker" data-toggle="datetimepicker" data-target="#default-date-picker" data-validation="required"/>
          </div>
          <div class="form-group">
            <label>Kegiatan</label>
            <textarea class="form-control" rows="3" id="kegiatan_edit" name="kegiatan" placeholder="Masukkan kegiatan" data-validation="required"></textarea>
          </div>
          <div class="form-group">
            <label>Kendala</label>
            <textarea class="form-control" rows="3" id="kendala_edit" name="kendala" placeholder="Masukkan kendala pengerjaan"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id_progress" id="id_progress_edit">
          <input type="hidden" name="edit">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title">Hapus Progress</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <strong>
          <h4>Apakah anda yakin ?</h4>
        </strong>
      </div>
      <form role="form" action="<?= site_url('Staff/progress') ?>" class="form-submit" method="post">
      <div class="modal-footer">
        <input type="hidden" id="id_progress_hapus" name="id_progress">
        <input type="hidden" name="hapus">
        <button type="submit" class="btn btn-danger">Ya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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

    $('#proker_detail').html(proker);
    $('#tanggal_detail').html(tanggal);
    $('#kegiatan_detail').html(kegiatan);

    if(kendala=="") $('#kendala_detail').html("Tidak ada kendala");
    else $('#kendala_detail').html(kendala);
    if(masukan=="") $('#masukan_detail').html("Tidak ada masukan");
    else $('#masukan_detail').html(masukan);
  }
  
  function getEdit(identifier){
    var button = $(identifier);
    var proker = button.data('proker');
    var tanggal = button.data('tanggal');
    var kegiatan = button.data('kegiatan');
    var kendala = button.data('kendala');
    var id_progress = button.data('id_progress');

    $('#id_progress_edit').val(id_progress);
    $('#proker_edit').val(proker).select2();
    $('#default-date-picker').val(tanggal);
    $('textarea#kegiatan_edit').text(kegiatan);
    $('textarea#kendala_edit').text(kendala);
  }

  function getHapus(identifier){
    var button = $(identifier);
    var id_progress = button.data('id_progress');
    $('#id_progress_hapus').val(id_progress);
  }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>