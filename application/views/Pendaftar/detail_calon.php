<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Pendaftar') ?>">HMJ</a></li>
                        <li class="breadcrumb-item"><a href="<?= site_url('Pendaftar/profil_calon') ?>">Profil Calon</a></li>
                        <li class="breadcrumb-item active">Detail Calon</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?= base_url('upload/') ?>foto/<?= $calon->foto ?>" onerror="this.src='<?= base_url('assets/') ?>dist/img/default.png'" alt="Foto Calon">
                            </div>
                            <h3 class="profile-username text-center"><?= $calon->nama ?></h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <a><?= $calon->prodi ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Angkatan</b><a class="float-right"><?= $calon->angkatan ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#akademis" data-toggle="tab">Akademis</a></li>
                                <li class="nav-item"><a class="nav-link" href="#vm" data-toggle="tab">Visi dan Misi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pengalaman" data-toggle="tab">Pengalaman Organisasi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#ulasan" data-toggle="tab">Ulasan</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="akademis">
                                    <dl class="row">
                                        <dt class="col-sm-2">Nama</dt>
                                        <dd class="col-sm-10"><?= $calon->nama ?></dd>
                                        <dt class="col-sm-2">Prodi</dt>
                                        <dd class="col-sm-10"><?= $calon->prodi ?></dd>
                                        <dt class="col-sm-2">Angkatan</dt>
                                        <dd class="col-sm-10"><?= $calon->angkatan ?></dd>
                                        <dt class="col-sm-2">Semester</dt>
                                        <dd class="col-sm-10"><?= $calon->semester ?></dd>
                                        <dt class="col-sm-2">IPK</dt>
                                        <dd class="col-sm-10"><?= $calon->ipk ?></dd>
                                    </dl>
                                </div>
                                <div class="tab-pane" id="vm">
                                    <?= $calon->visi_misi ?>
                                </div>
                                <div class="tab-pane" id="pengalaman">
                                    <?= $calon->pengalaman_org ?>
                                </div>
                                <div class="tab-pane" id="ulasan">
                                    <div class="row d-flex justify-content-center">
                                        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="pilih-kriteria">Pilih Kriteria</label>
                                                <select id="pilih-kriteria" class="form-control">
                                                    <?php foreach ($kriteria as $krit) : ?>
                                                        <option value="<?= $krit->id ?>"><?= $krit->kriteria ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <h5>Komentar</h5>
                                        <?php foreach ($komentar as $komen) : ?>
                                            <div>
                                                <?php
                                                if ($komen->anonim) {
                                                    echo substr($komen->nama, 0, 1) . str_repeat('*', 5);
                                                } else {
                                                    echo $komen->nama;
                                                }
                                                ?>
                                            </div>
                                            <div><?= $komen->komentar ?></div>
                                            <hr>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php endsection(); ?>

<?php section('scripts'); ?>
<script>
    $(document).ready(function() {
        var pieChart;
        var nilaiToLabelMapping = {
            1: 'Sangat Buruk',
            2: 'Buruk',
            3: 'Sedang',
            4: 'Baik',
            5: 'Sangat Baik'
        };
        var initialKriteria = $('#pilih-kriteria').val();
        fetchDataAndInitializeChart(initialKriteria); // inisialisasi chart pertama

        // Event listener untuk perubahan opsi pada select
        $('#pilih-kriteria').change(function() {
            var selectedKriteria = $(this).val();
            fetchDataAndInitializeChart(selectedKriteria);
        });

        function fetchDataAndInitializeChart(id_kriteria) {
            $.ajax({
                url: '<?= base_url("pendaftar/getCalonNilaiByIdKriteria/") ?>' + <?= $calon->nim ?> + '/' + id_kriteria,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    updatePieChart(data);
                }
            });
        }

        // Fungsi untuk memperbarui data Pie Chart
        function updatePieChart(data) {
            if (pieChart) { //destroy pie chart sebelumnya
                pieChart.destroy();
            }
            var ctx = document.getElementById('pieChart').getContext('2d');
            
            // Cek apakah data kosong
            if (data.length === 0) {
                // Menampilkan teks 'Maaf, data masih kosong'
                ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height); // Membersihkan canvas
                ctx.font = '16px Arial';
                ctx.fillStyle = '#000';
                ctx.textAlign = 'center';
                ctx.fillText('Maaf, data masih kosong', ctx.canvas.width / 2, ctx.canvas.height / 2);
                return;
            }
            
            pieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: data.map(item => nilaiToLabelMapping[item.nilai]),
                    datasets: [{
                        data: data.map(item => item.voter),
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                        hoverOffset: 0
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true
                }
            });
        }
    });
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>