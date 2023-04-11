<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Kabid') ?>">HMJ</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('Kabid/pengajuan') ?>">Pengajuan</a></li>
                        <li class="breadcrumb-item active">Form Pengajuan Proker</li>
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
                            <h3 class="card-title">Form Pengajuan Program Kerja</h3>
                        </div>
                        <form role="form" action="<?php echo site_url('ketum/proker') ?>" class="form-submit" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_proker">Program Kerja</label>
                                    <input type="text" class="form-control" id="nama_proker" name="namaproker" placeholder="Nama Program Kerja" data-validation="required">
                                </div>
                                <div class="form-group">
                                    <label>Ketua Pelaksana</label>
                                    <select name="ketua" class="form-control select2" style="width: 100%;" data-validation="required">
                                        <option hidden disabled selected value> -- Pilih Ketua Pelaksana -- </option>
                                    <?php foreach ($anggota as $row): ?>
                                        <option value="<?= $row->username ?>" ><?php echo $row->nama ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tgl.Pelaksanaan</label>
                                    <input autocomplete="off" type="text" name="tglproker" class="form-control" placeholder="Tanggal Mulai" id="tglmulai" data-toggle="datetimepicker" data-target="#tglmulai" data-validation="required"/>
                                </div>
                                <div class="form-group">
                                    <label>Tgl.Selesai</label>
                                    <input autocomplete="off" type="text" name="tglselesai" class="form-control" placeholder="Tanggal Selesai" id="tglakhir" data-toggle="datetimepicker" data-target="#tglakhir" data-validation="required"/>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="tambah">
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
<?php getview('template/core') ?>