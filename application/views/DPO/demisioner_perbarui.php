<!-- Navbar -->
<?php $this->load->view('template/header') ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php $this->load->view('dpo/sidebar');

$img = 'https://api.um.ac.id/akademik/operasional/GetFoto.ptikUM?nim=170533628542&angkatan=2017'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Demisione | 2019 | Feisal Nugraha</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Demisioner</li>
                    </ol>
                </div>
            </div>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Demisione</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" action="<?php echo site_url('') ?>" method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="text">NIM</label>
                                            <input type="hidden" name="Program Kerja" value="<?php echo $this->session->userdata("nama_proker") ?>"></input>
                                            <input type="text" class="form-control" id="nama_proker" name="jenis" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Nama</label>
                                            <input type="hidden" name="Ketua Pelaksana" value="<?php echo $this->session->userdata("ketua") ?>"></input>
                                            <input type="text" class="form-control" id="ketua" name="Ketua Pelaksana" placeholder="">
                                        </div>

                                        <img src="<?= $img ?>" onerror="this.src='<?= base_url('assets/') ?>dist/img/user2-160x160.jpg';" width="160" height="160">


                                        <div class="form-group">
                                            <label for="text">Email</label>
                                            <input type="hidden" name="Ketua Pelaksana" value="<?php echo $this->session->userdata("ketua") ?>"></input>
                                            <input type="text" class="form-control" id="ketua" name="Ketua Pelaksana" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">No. Handphone</label>
                                            <input type="hidden" name="Ketua Pelaksana" value="<?php echo $this->session->userdata("ketua") ?>"></input>
                                            <input type="text" class="form-control" id="ketua" name="Ketua Pelaksana" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="text">Jabatan</label>
                                            <input type="hidden" name="Ketua Pelaksana" value="<?php echo $this->session->userdata("ketua") ?>"></input>
                                            <input type="text" class="form-control" id="ketua" name="Ketua Pelaksana" placeholder="">
                                        </div>
                                    </div>
                            </div>
                            <div class="card-body">
                                <div class="block mb-4 text-left">
                                    <a href="<?php echo site_url('') ?>" class="btn btn-primary" data-toggle="tooltip" title="Perbarui Data"><i class=""></i>Perbarui Data</a>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
            </section>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('template/footer') ?>