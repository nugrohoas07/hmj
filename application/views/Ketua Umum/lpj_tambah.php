<?php section('contents');
$jabatan = $this->session->userdata('jabatan'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">HMJ</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('ketum/lpj') ?>">LPJ</a></li>
                        <li class="breadcrumb-item active">Tambah LPJ</li>
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
                            <h3 class="card-title">Tambah Laporan Pertanggungjawaban</h3>
                        </div>
                        <form role="form" action="<?php echo site_url('ketum/lpj') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                            <div class="card-body">
                                <div class="alert alert-primary">
                                    <h5>Ketika upload LPJ berhasil maka akan logout otomatis <i class="icon fas fa-info float-right"></i></h5>
                                </div>
                                <div class="form-group">
                                    <label for="laporan">Laporan</label>
                                    <input type="text" class="form-control" id="laporan" name="laporan" value="<?= $jabatan ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Lampiran<br><small class="text-danger">(Hanya file .pdf/.rar/.zip, Maks. 50MB. Jika .rar/.zip, maka didalamnya hanya file .pdf)</small></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="lampiran" class="custom-file-input" id="exampleInputFile" data-validation="required size extension" data-validation-allowing="pdf, rar, zip" data-validation-min-size="1kb" data-validation-max-size="50M">
                                            <label class="custom-file-label" for="exampleInputFile">Upload File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="simpan">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php endsection(); ?>
<?php getview('template/core') ?>