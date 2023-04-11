<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">HMJ</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('bendahara/rekap') ?>">Rekap Pendanaan</a></li>
                        <li class="breadcrumb-item active">Tambah Rekap Pendanaan</li>
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
                            <h3 class="card-title">Form Rekap Pendanaan</h3>
                        </div>
                        <form role="form" action="<?php echo site_url('Bendahara/rekap') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input autocomplete="off" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#default-date-picker" id="default-date-picker" name="tanggal" data-validation="required" />
                                </div>
                                <div class="form-group">
                                    <label for="keperluan">Keperluan</label>
                                    <input type="text" class="form-control" id="keperluan" name="keperluan" placeholder="Penggunaan Dana" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label for="sumber">Sumber</label>
                                    <input type="text" class="form-control" id="sumber" name="sumber" placeholder="Donatur/Pemberi Dana" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label for="pemasukan">Pemasukan</label>
                                    <input type="text" class="form-control" id="pemasukan" name="pemasukan" placeholder="Angka Tanpa Titik: 1000000">
                                </div>
                                <div class="form-group">
                                    <label for="pengeluaran">Pengeluaran</label>
                                    <input type="text" class="form-control" id="pengeluaran" name="pengeluaran" placeholder="Angka Tanpa Titik: 1000000">
                                </div>
                                <div class="form-group">
                                    <label for="bukti">Bukti <small class="text-danger">(Hanya File .jpg, .jpeg, .png, .pdf, Ukuran Maks. 2MB)</small></label>
                                    <div class="custom-file">
                                        <input type="file" name="bukti" class="custom-file-input" id="bukti" data-validation="required size extension" data-validation-allowing="jpg, jpeg, png, pdf" data-validation-min-size="1kb" data-validation-max-size="2M">
                                        <label class="custom-file-label" for="bukti">Upload File</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="tambah" >
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
<?php getview('template/core') ?>