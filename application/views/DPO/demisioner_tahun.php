<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">HMJ</a></li>
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
                            <h3 class="card-title">Demisioner 2019</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Email</th>
                                        <th>No Handphone</th>
                                        <th>Jabatan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <th>1</th>
                                    <th>Teo Anggara Nur Ramadana</th>
                                    <th>1705336222xx</th>
                                    <th>teoanggara@um.ac.id</th>
                                    <th>085xxxxxxxxx</th>
                                    <th>Ketua Umum</th>
                                    <th>
                                        <a href="<?php echo site_url('') ?>" class="btn btn-primary" data-toggle="tooltip" title="Perbarui"><i class=""></i>Perbarui</a>
                                    </th>
                                </tr>
                                <tr>
                                    <th>2</th>
                                    <th>Wigih Sulistiyo Pratama</th>
                                    <th>170533628xxx</th>
                                    <th>tamawigih@gmail.com</th>
                                    <th>081xxxxxxxxx</th>
                                    <th>Kabid Bakmin</th>
                                    <th>
                                        <a href="<?php echo site_url('') ?>" class="btn btn-primary" data-toggle="tooltip" title="Perbarui"><i class=""></i>Perbarui</a>
                                    </th>
                                </tr>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<?php endsection(); ?>
<?php getview('template/core') ?>