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
                        <a href="review_calon" class="btn btn-warning btn-block"><b>Review Calon</b></a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <!-- <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="../assets/dist/img/user4-128x128.jpg"
                            alt="Foto Calon">
                        </div>
                        <h3 class="profile-username text-center">Nina Mcintire</h3>
                        <p class="text-muted text-center">No Urut 1</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-primary btn-block"><b>Lihat Profil</b></a>
                        <a href="#" class="btn btn-warning btn-block"><b>Review Calon</b></a>
                    </div>
                </div>
            </div> -->
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