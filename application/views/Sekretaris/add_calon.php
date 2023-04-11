<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Sekretaris') ?>">HMJ</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('Sekretaris/profil_calon') ?>">Profil Calon</a></li>
                        <li class="breadcrumb-item active">Form Tambah Calon</li>
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
                            <h3 class="card-title">Form Tambah Calon</h3>
                        </div>
                        <form role="form" action="<?php echo site_url('sekretaris/update_calon') ?>" class="form-submit" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Calon</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Calon" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label>NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM Calon" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label>Prodi</label>
                                    <input type="text" class="form-control" id="prodi" name="prodi" placeholder="Prodi Calon" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label>Angkatan</label>
                                    <input type="text" class="form-control" id="angkatan" name="angkatan" placeholder="Tahun Masuk Calon" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <input type="text" class="form-control" id="semester" name="semester" placeholder="Semester Calon Saat Ini" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label>IPK</label>
                                    <input type="text" class="form-control" id="ipk" name="ipk" placeholder="IPK Calon Saat Ini" data-validation="required">
                                </div>
                                <div class="form-group ">
                                    <label>Foto<small class="text-danger"> (format file png,jpg,jpeg 128x128 maks 2MB)</small></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto" data-validation="size extension" data-validation-min-size="1kb" data-validation-min-size="2M" data-validation-allowing="png,jpg,jpeg">
                                        <label class="custom-file-label" for="foto">Pilih file</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Visi dan Misi</label>
                                    <textarea class="textarea" name="vm" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Pengalaman Organisasi</label>
                                    <textarea class="textarea" name="po" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="simpan">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
    
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>