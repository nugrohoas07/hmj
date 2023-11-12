<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Pendaftar') ?>">HMJ</a></li>
                        <li class="breadcrumb-item">Kriteria dan Bobot</li>
                        <li class="breadcrumb-item active">Perhitungan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active disabled" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Pemberian Nilai</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Hasil</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <?php foreach ($calon as $calon_this_year) : ?>
                                        <div class="mb-4">
                                            <h5><u>Calon : <?= $calon_this_year->nama ?></u></h5>
                                        </div>
                                        <div class="row">
                                            <?php foreach ($myKriteria as $kriteria_usr) : ?>
                                                <div class="col-md-6">
                                                    <label for="nilai[<?= $calon_this_year->nim ?>][<?= $kriteria_usr->id_kriteria ?>]"><?= $kriteria_usr->kriteria ?></label>
                                                    <input class="range_5" type="text" class="form-control" name="nilai[<?= $calon_this_year->nim ?>][<?= $kriteria_usr->id_kriteria ?>]">
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php if ($calon_this_year !== end($calon)) : ?>
                                            <hr class="mt-4 mb-4"> <!-- garis pemisah -->
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <div class="mt-4 col-12 d-flex justify-content-center">
                                        <button class="btn btn-primary" id="next-button" onclick="changeTab('custom-tabs-one-profile')">Next</button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    ISI
                                    <button class="btn btn-primary mr-2" onclick="changeTab('custom-tabs-one-home')">Previous</button>
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
        // Temukan tombol "Next" berdasarkan ID
        var nextButton = $('#next-button');

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

        // Tentukan fungsi untuk memeriksa apakah semua input terisi
        function checkInputs() {
            var allInputsFilled = true;
            $('.range_5').each(function() {
                if ($(this).val() <= 0 || $(this).val() === '') { // jika input belum diisi atau kurang dari sama dengan 0
                    allInputsFilled = false;
                    return false; // Keluar dari loop jika ada yang belum terisi
                }
            });

            // Aktifkan atau nonaktifkan tombol "Next" berdasarkan hasil pemeriksaan
            if (allInputsFilled) {
                nextButton.prop('disabled', false);
            } else {
                nextButton.prop('disabled', true);
            }
        }

        // Panggil fungsi checkInputs saat halaman dimuat
        checkInputs();

        // Tambahkan event listener pada setiap input dengan class 'range_5'
        $('.range_5').on('input', checkInputs);
    });

    function hitungSaw() {
        // Mendapatkan semua elemen input dengan class "range_5"
        var inputElements = document.querySelectorAll('input.range_5');

        // Objek untuk menyimpan data dalam bentuk array
        var dataArray = {};

        // Iterasi melalui elemen-elemen input
        inputElements.forEach(function(inputElement) {
            var name = inputElement.getAttribute('name'); // Mendapatkan atribut 'name'

            if (name) {
                // Parsing atribut 'name' menjadi array key
                var keys = name.match(/\[([^\]]+)\]/g);
                console.log(keys);
                if (keys) {
                    var value = inputElement.value;
                    console.log(value);
                    keys.forEach(function(key, index) {
                        key = key.replace(/\[|\]/g, ''); // Menghilangkan tanda '[', ']'
                        if (index === keys.length - 1) {
                            // Mengatur nilai pada posisi terakhir dengan value
                            dataArray[key] = value;
                        } else {
                            // Membuat objek jika belum ada
                            dataArray[key] = dataArray[key] || {};
                            // Memindahkan pointer ke objek berikutnya
                            dataArray = dataArray[key];
                        }
                    });
                }
            }
        });

        console.log(dataArray);
    }

    function changeTab(tabId) {
        hitungSaw();
        // Menonaktifkan semua elemen navigasi tab
        $('#custom-tabs-one-tab a').addClass('disabled');

        // Mengaktifkan hanya elemen navigasi tab yang sesuai
        $('#custom-tabs-one-tab a[href="#' + tabId + '"]').removeClass('disabled');

        // Mengaktifkan tab yang sesuai
        $('#custom-tabs-one-tab a[href="#' + tabId + '"]').tab('show');
    }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>