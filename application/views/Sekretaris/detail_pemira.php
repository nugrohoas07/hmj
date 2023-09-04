<?php section('contents'); ?>
<?php
$status = NULL;
$tulis = NULL;
$lisan = NULL;
$l_lisan = NULL;
$debat = NULL;
$l_debat = NULL;
$suara = NULL;
$suara_end = NULL;
$l_suara = NULL;
$pengumuman = NULL;
$info = NULL;
if (!empty($pemira)) {
    $tulis_start = us_date($pemira->kamp_tulis_awal);
    $tulis_end = us_date($pemira->kamp_tulis_akhir);
    $tulis = $tulis_start . " - " . $tulis_end;
    $status = $pemira->status;
    $lisan = $pemira->kamp_lisan;
    $l_lisan = $pemira->lok_lisan;
    $debat = $pemira->debat;
    $l_debat = $pemira->lok_debat;
    $suara = $pemira->pemilihan;
    $suara_end = $pemira->pemilihan_akhir;
    $l_suara = $pemira->lok_pemilihan;
    $pengumuman = $pemira->pengumuman;
    $info = $pemira->keterangan;
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('sekretaris/index') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Detail PEMIRA</li>
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
                            <h3 class="card-title">Detail PEMIRA</h3>
                        </div>
                        <form role="form" id="formdp" name="formdp" action="<?php echo site_url('sekretaris/detail_pemira') ?>" class="form-submit" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>PEMIRA</label>
                                    <select id="stat_pemira" name="status" class="form-control select2-nosearch" style="width: 100%;" data-validation="required">
                                        <option value="0" <?php if ($status == "0") echo "selected" ?>>Non Aktif</option>
                                        <option value="1" <?php if ($status == "1") echo "selected" ?>>Aktif</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Kampanye Tulis</label>
                                    <input autocomplete="off" type="text" class="form-control" id="ktulis" name="ktulis" value="<?= $tulis ?>" placeholder="Tanggal Kampanye Tulis" data-validation="required">
                                    <input type="hidden" name="ktulis_start" id="ktulis0" value="">
                                    <input type="hidden" name="ktulis_end" id="ktulis1" value="">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kampanye Lisan</label>
                                            <div class="input-group date" id="klisan" data-target-input="nearest">
                                                <input type="text" name="klisan" value="<?= $lisan ?>" class="form-control datetimepicker-input" data-target="#klisan" />
                                                <div class="input-group-append" data-target="#klisan" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Lokasi Kampanye Lisan</label>
                                            <input autocomplete="off" type="text" name="lokasi_lisan" value="<?= $l_lisan ?>" class="form-control" placeholder="Lokasi/link streaming kampanye lisan" data-validation="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Debat Calon</label>
                                            <div class="input-group date" id="debat" data-target-input="nearest">
                                                <input type="text" name="debat" value="<?= $debat ?>" class="form-control datetimepicker-input" data-target="#debat" />
                                                <div class="input-group-append" data-target="#debat" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Lokasi Debat Calon</label>
                                            <input autocomplete="off" type="text" value="<?= $l_debat ?>" name="lokasi_debat" class="form-control" placeholder="Lokasi/link streaming debat calon" data-validation="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pemungutan Suara</label>
                                            <div class="input-group date" id="pemilihan" data-target-input="nearest">
                                                <input type="text" name="pemilihan" value="<?= $suara ?>" class="form-control datetimepicker-input" data-target="#pemilihan" />
                                                <div class="input-group-append" data-target="#pemilihan" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Waktu Akhir Pemungutan Suara</label>
                                            <div class="input-group date" id="pemilihan_end" data-target-input="nearest">
                                                <input type="text" name="pemilihan_end" value="<?= $suara_end ?>" class="form-control datetimepicker-input" data-target="#pemilihan_end" />
                                                <div class="input-group-append" data-target="#pemilihan_end" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-clock"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Lokasi Pemungutan Suara</label>
                                    <input autocomplete="off" type="text" value="<?= $l_suara ?>" name="lokasi_pemilihan" class="form-control" placeholder="Lokasi pemungutan suara/link e-voting" data-validation="required" />
                                </div>
                                <div class="form-group">
                                    <label>Pengumuman Hasil Suara</label>
                                    <div class="input-group date" id="pengumuman" data-target-input="nearest">
                                        <input type="text" name="pengumuman" value="<?= $pengumuman ?>" class="form-control datetimepicker-input" data-target="#pengumuman" />
                                        <div class="input-group-append" data-target="#pengumuman" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Informasi Tambahan <small>(Opsional)</small></label>
                                    <textarea class="textareacustom" name="info" placeholder="Informasi Tambahan (Jika Perlu)" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?= $info ?></textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="simpan">
                                <button type="submit" class="btn btn-primary" onclick="onSubmit()">Simpan</button>
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
    var ktulis_start, ktulis_end;
    $('.textareacustom').summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['view', ['undo', 'redo', 'fullscreen']],
        ]
    });
    $(function() {
        $('#ktulis').daterangepicker();
        $('#klisan,#debat,#pemilihan').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            sideBySide: true,
            debug: true
        });
        $('#pemilihan_end').datetimepicker({
            format: 'LT',
            format: 'HH:mm',
            useCurrent: false,
            debug: true
        });
        $('#pengumuman').datetimepicker({
            sideBySide: true,
            format: 'L',
            format: 'YYYY-MM-DD',
            debug: true
        });
    });

    function onSubmit() {
        ktulis_start = $("#ktulis").data('daterangepicker').startDate.format('YYYY-MM-DD');
        ktulis_end = $("#ktulis").data('daterangepicker').endDate.format('YYYY-MM-DD');
        document.formdp.ktulis0.value = ktulis_start;
        document.formdp.ktulis1.value = ktulis_end;
        document.forms["formdp"].submit();
    }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>