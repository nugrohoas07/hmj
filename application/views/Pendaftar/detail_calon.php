<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Pendaftar') ?>">HMJ</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('Pendaftar/profil_calon') ?>">Profil Calon</a></li>
                        <li class="breadcrumb-item active">Detail Calon</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="../upload/foto/<?= $calon->foto ?>"
                                alt="Foto Calon">
                            </div>
                            <h3 class="profile-username text-center"><?= $calon->nama ?></h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <a><?= $calon->prodi ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Angkatan</b><a class="float-right"><?= $calon->angkatan ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#akademis" data-toggle="tab">Akademis</a></li>
                                <li class="nav-item"><a class="nav-link" href="#vm" data-toggle="tab">Visi dan Misi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pengalaman" data-toggle="tab">Pengalaman Organisasi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#ulasan" data-toggle="tab">Ulasan</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="akademis">
                                    <dl class="row">
                                        <dt class="col-sm-2">Nama</dt>
                                        <dd class="col-sm-10"><?= $calon->nama ?></dd>
                                        <dt class="col-sm-2">Prodi</dt>
                                        <dd class="col-sm-10"><?= $calon->prodi ?></dd>
                                        <dt class="col-sm-2">Angkatan</dt>
                                        <dd class="col-sm-10"><?= $calon->angkatan ?></dd>
                                        <dt class="col-sm-2">Semester</dt>
                                        <dd class="col-sm-10"><?= $calon->semester ?></dd>
                                        <dt class="col-sm-2">IPK</dt>
                                        <dd class="col-sm-10"><?= $calon->ipk ?></dd>
                                    </dl>
                                </div>
                                <div class="tab-pane" id="vm">
                                    <?= $calon->visi_misi ?>
                                </div>
                                <div class="tab-pane" id="pengalaman">
                                    <?= $calon->pengalaman_org ?>
                                </div>
                                <div class="tab-pane" id="ulasan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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