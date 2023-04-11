<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">HMJ</a></li>
                        <li class="breadcrumb-item active">Form Daftar</li>
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
                            <h3 class="card-title">Daftar Anggota</h3>
                        </div>
                        <form role="form" action="<?php echo site_url('pendaftar/daftar') ?>" class="form-submit" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" class="form-control" name="username" id="nim" value="<?= $this->session->userdata("username"); ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $this->session->userdata("nama"); ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Bidang</label>
                                    <select name="bidang" id="bidang" class="form-control select2-nosearch" style="width: 100%;" data-validation="required">
                                        <option hidden disabled selected value> -- Pilih Bidang -- </option>
                                        <?php foreach ($list_bidang as $row) : ?>
                                            <option value="<?= $row->id_bidang ?>"><?= $row->bidang ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Divisi</label>
                                    <select name="divisi" id="divisi" class="form-control select2-nosearch" style="width: 100%;" data-validation="required">
                                        <option hidden disabled selected value>Pilih Bidang Terlebih Dahulu</option>
                                    </select>
                                </div>

                                <div class="form-group ">
                                    <label>Sertifikat PKKMB<small class="text-danger"> (format file png,jpg,jpeg,pdf, maks 2MB)</small></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="sertif" name="dokumen_lain" data-validation="size extension" data-validation-min-size="1kb" data-validation-min-size="2M" data-validation-allowing="png,jpg,jpeg,pdf">
                                        <label class="custom-file-label" for="sertif">Choose file</label>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label>KRS<small class="text-danger"> (format file png,jpg,jpeg,pdf, maks 2MB)</small></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="formulir" name="form" data-validation="size extension" data-validation-min-size="1kb" data-validation-min-size="2M" data-validation-allowing="png,jpg,jpeg,pdf">
                                        <label class="custom-file-label" for="formulir">Choose file</label>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Karya<small class="text-danger"> (format file png,jpg,jpeg,pdf, maks 2MB)</small>
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <label> Jika karya berupa video paste link di bawah ini</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-check col-6">
                                            <input class="form-check-input" type="radio" name="pilih_karya" id="pilih_karya1" onclick="pilihKarya()">
                                            <div class="custom-file">
                                                <input disabled type="file" class="custom-file-input" id="karya1" name="karya" data-validation="size extension" data-validation-min-size="1kb" data-validation-min-size="2M" data-validation-allowing="png,jpg,jpeg,pdf">
                                                <label class="custom-file-label" for="karya">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-check col-6 ">
                                            <input class="form-check-input" type="radio" name="pilih_karya" id="pilih_karya2" onclick="pilihKarya()">
                                            <input autocomplete="off" disabled type="text" class="form-control" name="karya" id="karya2" placeholder="Sertakan http://">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <div class="form-check">
                                        <input class="form-check-input" name="must" type="checkbox" id="gridCheck1" data-validation="required">
                                        <label for="gridCheck1">
                                            Setelah klik daftar maka data tidak dapat diubah atau diperbarui
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="daftar">
                                <button disabled type="submit" class="btn btn-primary" id="must">Daftar</button>
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
    function pilihKarya() {
        var checkBox1 = document.getElementById("pilih_karya1");
        var checkBox2 = document.getElementById("pilih_karya2");

        var text1 = document.getElementById("karya1");
        var text2 = document.getElementById("karya2");

        if (checkBox1.checked == true) {
            text1.disabled = false;
            text2.disabled = true;
        } else if (checkBox2.checked == true) {
            text2.disabled = false;
            text1.disabled = true;
        }
    }

    $('#gridCheck1').change(function() {
        if (document.getElementById('gridCheck1').checked == false) {
            document.getElementById('must').disabled = true
        } else if (document.getElementById('gridCheck1').checked == true) {
            document.getElementById('must').disabled = false
        }
    });

    $(document).ready(function() {
        $('#bidang').change(function() {
            var id_bidang = $('#bidang').val();
            if (id_bidang) {
                $.ajax({
                    url: "<?= site_url('Pendaftar/listDivisi/'); ?>" + id_bidang,
                    dataType: 'json',
                    success: function(data) {
                        $('#divisi').empty();
                        $('#divisi')
                            .append($("<option></option>")
                                .attr("value", "")
                                .text("-- Pilih Divisi --"));
                        $.each(data, function(key, value) {
                            if (value.divisi != "-") {
                                $('#divisi')
                                    .append($("<option></option>")
                                        .attr("value", value.id_divisi)
                                        .text(value.divisi));
                            }
                        });
                    }
                });
            }
        });
    });
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>