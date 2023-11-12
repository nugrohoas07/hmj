<?php section('contents'); ?>
<?php
$nilai_kriteria = array();
foreach ($nilai as $row) {
    $nilai_kriteria[$row->id_kriteria] = $row->nilai;
}
$komen = !empty($komentar->komentar) ? $komentar->komentar : "";
$anonim = !empty($komentar->anonim) ? $komentar->anonim : "";
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Pendaftar') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Review Calon</li>
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
                            <h3 class="card-title">Review Calon</h3>
                        </div>
                        <form role="form" action="<?php echo site_url('pendaftar/input_ulasan') ?>" class="form-submit" method="post">
                            <div class="card-body">
                                <h5>Calon : <?= $calon->nama ?></h5>
                                <div class="alert alert-info">
                                    <h5><i class="icon fas fa-info"></i>Info</h5>
                                    Info alert preview. This alert is dismissable.
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <?php $count = 0; ?>
                                        <?php foreach ($kriteria as $row) : ?>
                                            <div class="col-md-6">
                                                <label for="nilai_kriteria[]"><?= $row->kriteria ?></label>
                                                <input type="hidden" name="id_kriteria[]" value="<?= $row->id ?>">
                                                <input class="range_5" type="text" name="nilai_kriteria[]" value="<?= !empty($nilai_kriteria[$row->id]) ? $nilai_kriteria[$row->id] : "" ?>">
                                            </div>
                                            <?php if ($count % 2 != 0) : ?>
                                                <div class="w-100"></div>
                                            <?php endif; ?>
                                            <?php $count++; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="komentar">Komentar</label>
                                    <textarea class="form-control" rows="3" name="komentar" placeholder="Berikan pendapat anda tentang calon ini"><?= $komen ?></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="anonim" <?php echo ($anonim != 0) ? 'checked' : ''; ?>>
                                        <label class="form-check-label">Kirim sebagai anonim</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="id_calon" value="<?= $calon->nim ?>">
                                <input type="hidden" name="simpan">
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

<?php section('scripts'); ?>
<script>
    $('.range_5').ionRangeSlider({
        min: 0,
        max: 5,
        type: 'single',
        step: 1,
        prettify: false,
        grid: true,
        grid_num: 5,
        skin: 'round'
    })
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>