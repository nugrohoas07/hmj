<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Kabid') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Pengajuan</li>
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
                            <h3 class="card-title">Daftar Program Kerja</h3>
                        </div>
                        <div class="card-body">
                            <div class="block mb-4 text-left">
                                <a href="<?php echo site_url('Kabid/addPengajuan'); ?>" class="btn btn-success" data-toggle="tooltip" title="Tambah Proker"><i class="fa fa-plus"></i> Ajukan Proker</a>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tgl.Pelaksanaan</th>
                                    <th>Program Kerja</th>
                                    <th>Ketua Pelaksana</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $no = 1;
                                foreach ($proker as $row): 
                                $status = $row->status;
                                $ketua = $this->model_user->getUser($row->ketua)->nama ?>
                                <tr>
                                <td><?= $no ?></td>
                                <td><?= to_date($row->tgl_pelaksanaan)." s/d ".to_date($row->tgl_selesai) ?></td>
                                <td><?= $row->nama_proker ?></td>
                                <td><?= $ketua ?></td>
                                <td><?php if($status=="0"){echo "Belum Disetujui";}elseif($status=="1"){echo "Belum Dikerjakan";}elseif($status=="2"){echo "Progress";}elseif($status=="3"){echo "Selesai";}elseif($status=="4"){echo "Ditolak";}  ?></td>
                                <td class="text-center">
                                <?php if($status=="3"){echo "No Action";}else{ ?>
                                <button class="btn btn-primary btn-xs" title="Edit" data-toggle="modal" data-target="#edit" onclick="getEdit(this);" data-id_proker="<?= $row->id_proker ?>" data-proker="<?= $row->nama_proker; ?>" data-ketua="<?= $row->ketua; ?>" data-tgl_pelaksanaan="<?= $row->tgl_pelaksanaan; ?>" data-tgl_selesai="<?= $row->tgl_selesai; ?>" data-panitia="<?= $row->panitia; ?>"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#hapus" onclick="getHapus(this);" data-id_proker="<?= $row->id_proker ?>"><i class="fas fa-trash"></i></button>
                                <?php }if($status=="4"){ ?>
                                <button class="btn btn-primary btn-xs" title="Ajukan Ulang" data-toggle="modal" data-target="#ulang" onclick="getUlang(this);" data-id_proker="<?= $row->id_proker ?>"><i class="fa fa-paper-plane"></i></button><?php } ?>
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

<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Edit Program Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('Kabid/pengajuan'); ?>" class="form-submit" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="form-group">
                      <label for="namaproker">Program Kerja</label>
                      <input type="hidden" id="id_proker" name="id_proker">
                      <input type="text" class="form-control" id="proker" placeholder="Nama Program Kerja" name="namaproker" data-validation="required">
                  </div>
                  <div class="form-group">
                      <label>Ketua Pelaksana</label>
                      <select name="ketua" id="ketua" class="form-control select2" style="width: 100%;" data-validation="required">
                        <option hidden disabled selected value> -- Pilih Ketua Pelaksana -- </option>
                      <?php foreach ($anggota as $row): ?>
                        <option value="<?= $row->username ?>" ><?= $row->nama ?></option>
                      <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Tgl.Pelaksanaan</label>
                      <input autocomplete="off" type="text" id="tglmulai" name="tglproker" placeholder="Tanggal Mulai" class="form-control" id="tglmulai" data-toggle="datetimepicker" data-target="#tglmulai" data-validation="required"/>
                  </div>
                  <div class="form-group">
                      <label>Tgl.Selesai</label>
                      <input autocomplete="off" type="text" id="tglakhir" name="tglselesai" placeholder="Tanggal Selesai" class="form-control" id="tglakhir" data-toggle="datetimepicker" data-target="#tglakhir" data-validation="required"/>
                  </div>
              </div>
              <div class="modal-footer">
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
        <h5 class="modal-title">Hapus Program Kerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <strong>
          <h4>Apakah anda yakin ?</h4>
        </strong>
      </div>
      <form role="form" action="<?= site_url('Kabid/pengajuan') ?>" class="form-submit" method="post">
      <div class="modal-footer">
        <input type="hidden" id="id_proker_hapus" name="id_proker">
        <input type="hidden" name="hapus">
        <button type="submit" class="btn btn-danger">Ya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ulang" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title">Ajukan Ulang Program Kerja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <strong>
          <h4>Anda ingin mengajukan ulang ?</h4>
        </strong>
      </div>
      <form role="form" action="<?= site_url('Kabid/pengajuan') ?>" class="form-submit" method="post">
      <div class="modal-footer">
        <input type="hidden" id="id_proker_ulang" name="id_proker">
        <input type="hidden" name="ulang">
        <button type="submit" class="btn btn-primary">Ya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
    function getEdit(identifier){
        var button = $(identifier);
        var id_proker = button.data('id_proker');
        var proker = button.data('proker');
        var ketua = button.data('ketua');
        var tgl_pelaksanaan = button.data('tgl_pelaksanaan');
        var tgl_selesai = button.data('tgl_selesai');

        $('#id_proker').val(id_proker);
        $('#proker').val(proker);
        $("#ketua").val(ketua).trigger('change');
        $('#tglmulai').val(tgl_pelaksanaan);
        $('#tglakhir').val(tgl_selesai);
    }

    function getHapus(identifier){
        var button = $(identifier);
        var id_proker = button.data('id_proker');
        $('#id_proker_hapus').val(id_proker);
    }

    function getUlang(identifier){
        var button = $(identifier);
        var id_proker = button.data('id_proker');
        $('#id_proker_ulang').val(id_proker);
    }       
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>