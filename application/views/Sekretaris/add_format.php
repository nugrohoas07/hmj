<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                       <li class="breadcrumb-item"><a href="<?= site_url('sekretaris/index') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Format Persuratan</li>
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
                            <h3 class="card-title">Tambah Format</h3>
                        </div>
                        <form role="form" action="<?= site_url('sekretaris/format_surat') ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="perihal">Perihal</label>
                                    <input type="text" class="form-control" name="perihal" placeholder="Perihal Surat Dibuat" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label for="tujuan">Tujuan</label>
                                    <input type="text" class="form-control" name="tujuan" placeholder="Ditujukan Kepada" data-validation="required">
                                </div>
                                <label for="exampleInputFile">Contoh</label>
                                <div class="form-group">
                                    <label for="contoh"><small class="text-danger"> (format file docx maks 2MB)</small></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="contoh" data-validation="extension size required" data-validation-min-size="1kb" data-validation-max-size="2M" data-validation-allowing="docx">
                                        <label class="custom-file-label" for="contoh">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="simpan" class="btn btn-primary" title="simpan"><i class=""></i>Tambah</button>
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