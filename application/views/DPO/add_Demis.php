<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('dpo/index') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Demisioner</li>
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
                            <h3 class="card-title">Edit </h3>
                        </div>
                        <form role="form" action="<?= site_url('Dpo/demisioner') ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">Pengurus</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="pengurus" class="custom-file-input" id="exampleInputFile" required>
                                            <label class="custom-file-label" for="exampleInputFile">Upload File</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Laporan Pertanggungjawaban</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="lpj" class="custom-file-input" id="exampleInputFile" required>
                                            <label class="custom-file-label" for="exampleInputFile">Upload File</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="simpan" class="btn btn-primary" title="simpan">Edit</button>
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