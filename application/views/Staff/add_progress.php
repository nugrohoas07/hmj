<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Staff') ?>">HMJ</a></li>
                        <li class="breadcrumb-item "><a href="<?= site_url('staff/progress') ?>">Progress</a></li>
                        <li class="breadcrumb-item active">Tambah Progress</li>
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
                            <h3 class="card-title">Tambah Progress Program Kerja</h3>
                        </div>
                        <form role="form" action="<?= site_url('Staff/progress') ?>" class="form-submit" method="post"  enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Program Kerja</label>
                                    <select name="proker" class="form-control select2" style="width: 100%;" data-validation="required">
                                    <option hidden disabled selected value> -- Pilih Program Kerja -- </option>
                                    <?php foreach ($proker as $row): ?>
                                        <option value="<?php echo $row->id_proker ?>" ><?php echo $row->nama_proker ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input autocomplete="off" name="tgl" type="text" placeholder="Tanggal Kegiatan" class="form-control" id="default-date-picker" data-toggle="datetimepicker" data-target="#default-date-picker" data-validation="required"/>
                                </div>
                                <div class="form-group">
                                    <label>Kegiatan</label>
                                    <textarea class="form-control" rows="3" name="kegiatan" placeholder="Masukkan kegiatan" data-validation="required"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Kendala</label>
                                    <textarea class="form-control" rows="3" name="kendala" placeholder="Masukkan kendala pengerjaan"></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="tambah">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>
</div>
<?php endsection(); ?>
<?php getview('template/core') ?>