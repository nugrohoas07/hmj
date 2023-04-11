<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Sekretaris') ?>">HMJ</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('Sekretaris/profil_calon') ?>">Profil Calon</a></li>
                        <li class="breadcrumb-item active">Form Edit Calon</li>
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
                            <h3 class="card-title">Form Edit Calon</h3>
                        </div>
                        <form role="form" action="<?php echo site_url('sekretaris/update_calon') ?>" class="form-submit" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Calon</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $calon->nama ?>" placeholder="Nama Calon" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label>NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim" value="<?= $calon->nim ?>" placeholder="NIM Calon" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label>Prodi</label>
                                    <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $calon->prodi ?>" placeholder="Prodi Calon" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label>Angkatan</label>
                                    <input type="text" class="form-control" id="angkatan" name="angkatan" value="<?= $calon->angkatan ?>" placeholder="Tahun Masuk Calon" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <input type="text" class="form-control" id="semester" name="semester" value="<?= $calon->semester ?>" placeholder="Semester Calon Saat Ini" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label>IPK</label>
                                    <input type="text" class="form-control" id="ipk" name="ipk" value="<?= $calon->ipk ?>" placeholder="IPK Calon Saat Ini" data-validation="required">
                                </div>
                                <div class="form-group ">
                                    <label>Foto<small class="text-danger"> (format file png,jpg,jpeg 128x128 maks 2MB)</small></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto" data-validation="size extension" data-validation-min-size="1kb" data-validation-min-size="2M" data-validation-allowing="png,jpg,jpeg">
                                        <input type="hidden" name="old_foto" value="<?= $calon->foto ?>">
                                        <label class="custom-file-label" for="foto">Pilih file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Visi dan Misi</label>
                                    <textarea class="textareacustom" name="vm" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $calon->visi_misi ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Pengalaman Organisasi</label>
                                    <textarea class="textareacustom" name="po" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $calon->pengalaman_org ?></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="edit">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php endsection(); ?>
<?php section('scripts') ?>
<script>
    $('.textareacustom').summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['view', ['undo', 'redo', 'fullscreen']],
        ]
    });
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>