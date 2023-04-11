<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">HMJ</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('bendahara/format') ?>">Format Pendanaan</a></li>
                        <li class="breadcrumb-item active">Tambah Format Pendanaan</li>
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
                            <h3 class="card-title">Tambah Format Pendanaan</h3>
                        </div>
                        <form role="form" action="<?php echo site_url('Bendahara/format') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="keperluan">Keperluan</label>
                                    <input type="text" class="form-control" id="keperluan" name="keperluan" placeholder="Penggunaan Dana" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Contoh <small class="text-danger">(Hanya File .docx, Ukuran Maks. 2MB)</small></label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="contoh" class="custom-file-input" id="exampleInputFile" data-validation="required size extension" data-validation-allowing="docx" data-validation-min-size="1kb" data-validation-max-size="2M">
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