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
            <?php foreach ($calon as $row) : ?>
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="../upload/foto/<?= $row->foto ?>"
                            onerror="this.src='<?= base_url('assets/') ?>dist/img/default.png'"
                            alt="Foto Calon">
                        </div>
                        <h3 class="profile-username text-center"><?= $row->nama ?></h3>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <a><?= $row->prodi ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Angkatan</b><a class="float-right"><?= $row->angkatan ?></a>
                            </li>
                        </ul>
                        <a href="detail_calon/<?= $row->nim ?>" class="btn btn-primary btn-block"><b>Lihat Profil</b></a>
                        <a href="review_calon/<?= $row->nim ?>" class="btn btn-warning btn-block"><b>Review Calon</b></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
  </section>
</div>

<?php endsection(); ?>

<?php section('scripts'); ?>
<script>
    
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>