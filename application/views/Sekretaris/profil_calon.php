<?php section('contents'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('Sekretaris') ?>">HMJ</a></li>
            <li class="breadcrumb-item active">Profil Calon</li>
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
              <h3 class="card-title">Daftar Calon Ketua HMD</h3>
            </div>
            <div class="card-body">
              <div class="block mb-4 text-left">
                <a href="<?= site_url('Sekretaris/tambahCalon'); ?>" class="btn btn-success" data-toggle="tooltip" title="Tambah Calon"><i class="fa fa-plus"></i> Tambah Calon</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($calon as $row) : ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $row->nim ?></td>
                      <td><?= $row->nama ?></td>
                      <td class="text-center">
                        <a class="btn btn-primary btn-xs" title="Edit" href="editCalon/<?= $row->nim ?>"><i class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#hapus" onclick="getHapus(this);" data-nim="<?= $row->nim ?>"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                  <?php $no++;
                  endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title">Konfirmasi Hapus Calon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <strong>
          <h4>Apakah anda ingin menghapus calon?</h4>
        </strong>
      </div>
      <form role="form" action="<?= site_url('sekretaris/update_calon') ?>" class="form-submit" method="post">
        <div class="modal-footer">
          <input type="hidden" id="id_calon_hapus" name="nim">
          <input type="hidden" name="hapus">
          <button type="submit" class="btn btn-danger">Ya</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php endsection(); ?>

<?php section('scripts'); ?>
<script>
  function getHapus(identifier) {
    var button = $(identifier);
    var nim = button.data('nim');
    $('#id_calon_hapus').val(nim);
  }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>