<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('staff/index') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Pengajuan Surat</li>
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
                            <h3 class="card-title">Form Pengajuan Surat</h3>
                        </div>
                        <div class="card-body">
                            <form role="form" action="<?= site_url('staff/surat') ?>" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input autocomplete="off" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#default-date-picker" id="default-date-picker" name="tanggal" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label for="perihal">Perihal</label>
                                    <input type="text" class="form-control" name="perihal" placeholder="Perihal Surat Dibuat" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Tujuan</label>
                                    <input type="text" class="form-control" name="keterangan" placeholder="Ditujukan Kepada" data-validation="required">
                                </div>
                                                        <div class="form-group">
                    <label for="lampiran">Lampiran<small class="text-danger"> (format file docx maks 2MB)</small></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="lampiran" data-validation="extension size required" data-validation-min-size="1kb" data-validation-max-size="2M" data-validation-allowing="docx">
                        <label class="custom-file-label" for="lampiran">Choose file</label>
                    </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" name="simpan" class="btn btn-primary" title="edit">Ajukan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>
<?php endsection(); ?>
<?php getview('template/core') ?>