<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('staff') ?>">HMJ</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('staff/dana') ?>">Pengajuan Dana</a></li>
                        <li class="breadcrumb-item active">Tambah</li>
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
                            <h3 class="card-title">Form Pengajuan Dana</h3>
                        </div>
                        <form role="form" action="<?php echo site_url('Staff/dana') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="keperluan">Keperluan</label>
                                    <input type="text" class="form-control" id="keperluan" name="keperluan" placeholder="Penggunaan Dana" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal">Tanggal Diperlukan</label>
                                    <input name="tanggal" autocomplete="off" type="text" class="form-control datetimepicker-input" id="default-date-picker" data-toggle="datetimepicker" data-target="#default-date-picker" data-validation="required" />
                                </div>
                                <div class="form-group">
                                    <label for="pengeluaran">Jumlah</label>
                                    <input type="text" class="form-control" id="pengeluaran" name="pengeluaran" placeholder="Nominal Pengajuan" data-validation="required">
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="ajukan">
                                <button type="submit" class="btn btn-primary">Ajukan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
endsection();
getview('template/core'); ?>