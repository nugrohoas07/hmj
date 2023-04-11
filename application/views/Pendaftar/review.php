<?php section('contents'); ?>
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
                        <form role="form">
                            <div class="card-body">
                                <h5>Calon : Nama Calon</h5>
                                <div class="alert alert-info">
                                    <h5><i class="icon fas fa-info"></i>Info</h5>
                                    Info alert preview. This alert is dismissable.
                                </div>
                                <div class="form-group">
                                    <label for="range">Kriteria 1</label>
                                    <div class="col-sm-4">
                                        <input class="range_5" type="text" name="range_5" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="range">Kriteria 2</label>
                                    <div class="col-sm-4">
                                        <input class="range_5" type="text" name="range_5" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="range">Kriteria 3</label>
                                    <div class="col-sm-4">
                                        <input class="range_5" type="text" name="range_5" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="range">Kriteria 4</label>
                                    <div class="col-sm-4">
                                        <input class="range_5" type="text" name="range_5" value="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ulasan">Ulasan</label>
                                    <textarea class="form-control" rows="3" placeholder="Berikan pendapat anda tentang calon ini"></textarea>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox">
                                        <label class="form-check-label">Kirim sebagai anonim</label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
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