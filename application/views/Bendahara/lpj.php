<?php section('contents');
$jabatan = $this->session->userdata('jabatan'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">HMJ</a></li>
            <li class="breadcrumb-item active">LPJ</li>
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
              <h3 class="card-title">Laporan Pertanggungjawaban</h3>
            </div>
            <div class="card-body">
              <?php
              if ($lpj == null) {
              ?>
                <div class="block mb-4 text-left">
                  <a href="<?= site_url('bendahara/addLpj') ?>" class="btn btn-success" title="Upload File LPJ"><i class="fa fa-plus"></i> Upload File</a>
                </div>
              <?php
              } ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr class="text-center">
                    <th>#</th>
                    <th>Jabatan</th>
                    <th>Laporan</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($lpj as $row) :
                  ?>
                    <tr>
                      <td class="text-center"><?= $no ?></td>
                      <td><?= $jabatan
                          ?></td>
                      <td class="text-center">
                        <a href="<?= base_url('/upload/lpj/') . $row->lpj ?>" target="_blank" class="btn btn-primary">Lihat File</a>
                      </td>
                      <td class="text-center">
                        <button class="btn btn-primary btn-xs" title="Edit" data-toggle="modal" data-target="#edit" onclick="fetchEdit(this)" data-id_lpj="<?= $row->id_lpj ?>" data-lpj="<?= $row->lpj ?>"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#hapus" onclick="fetchHapus(this)" data-id_lpj="<?= $row->id_lpj ?>"><i class="fa fa-trash"></i></button>
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
      <div class="modal-header bg-primary">
        <h5 class="modal-title">Konfirmasi Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="<?php echo site_url('bendahara/lpj') ?>" method="post" enctype="multipart/form-data" class="form-submit">
          <div class="form-group">
            <label for="laporan">Laporan</label>
            <input type="text" class="form-control" name="laporan" value="<?= $jabatan ?>" readonly>
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Lampiran <br><small class="text-danger">(Hanya File .docx, .rar, .zip, Ukuran Maks. 50MB, Jika .rar/.zip Pastikan Di Dalamnya Hanya File .docx)</small></label>
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="lampiran" class="custom-file-input" id="exampleInputFile" data-validation="size extension" data-validation-allowing="docx, rar, zip" data-validation-min-size="1kb" data-validation-max-size="50M">
                <label class="custom-file-label" for="exampleInputFile">Upload File</label>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <div class="form-group">
          <input type="hidden" name="id_lpj" id="id_lpj_edit" required>
          <input type="hidden" name="lpj_ada" id="lpj_edit">
          <input type="hidden" name="edit">
          <button class="btn btn-primary" type="submit">Simpan</button>
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
        <form role="form" action="<?php echo site_url('bendahara/lpj') ?>" method="post" enctype="multipart/form-data" class="form-submit">
          <input type="hidden" name="id_lpj" id="id_lpj_hapus" required>
          <input type="hidden" name="hapus">
          <button type="submit" class="btn btn-danger">Ya</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
  function fetchEdit(identifier) {
    var button = $(identifier);
    var id_lpj = button.data('id_lpj');
    var lpj = button.data('lpj');

    $('#id_lpj_edit').val(id_lpj);
    $('#lpj_edit').val(lpj);
  }

  function fetchHapus(identifier) {
    var button = $(identifier);
    var id_lpj = button.data('id_lpj');

    $('#id_lpj_hapus').val(id_lpj);
  }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>