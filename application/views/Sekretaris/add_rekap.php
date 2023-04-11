<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('sekretaris/index') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Rekap Persuratan</li>
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
                            <h3 class="card-title">Tambah Rekap Persuratan</h3>
                        </div>
                        <form role="form" action="<?= site_url('sekretaris/rekap_surat') ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input autocomplete="off" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#default-date-picker" id="default-date-picker" name="tanggal" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label for="">No Surat</label>
                                    <input type="text" class="form-control" name="no_dok" placeholder="Isikan No Surat" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label for="">Perihal</label>
                                    <input type="text" class="form-control" name="nama_dok" placeholder="Perihal Surat Dibuat" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label for="Ketua">Keterangan</label>
                                    <input type="text" class="form-control" name="keterangan" placeholder="Berikan Keterangan Tentang Surat" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control select2" style="width: 100%;">
                                        <option value="0">Keluar</option>
                                        <option value="1">Masuk</option>
                                    </select>
                                </div>
                                <label for="exampleInputFile">Lampiran</label>
                       <div class="form-group">
                    <label for="lampiran"><small class="text-danger"> (format file docx,pdf maks 2MB)</small></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="lampiran" data-validation="extension size required" data-validation-min-size="1kb" data-validation-max-size="2M" data-validation-allowing="docx | pdf">
                        <label class="custom-file-label" for="lampiran">Choose file</label>
                        </div>
                    </div>
                    </div>
                            <div class="card-footer">
                                <button type="submit" name="simpan" class="btn btn-primary" title="simpan">Tambah</button>
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