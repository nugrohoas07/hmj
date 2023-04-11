<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('kabid') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Recruitment</li>
                        <?php var_dump($saw) ?>
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
                            <h3 class="card-title">Recruitment
                            </h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Sertifikat PKKMB</th>
                                        <th>KRS</th>
                                        <th>Karya</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pendaftar as $row) :
                                        $nama = $this->model_user->getNama($row->username)->nama;
                                        $id_bidang = $this->model_user->getUser($row->username)->bidang;
                                        $id_divisi = $this->model_user->getUser($row->username)->divisi;
                                        $bidang = $this->model_user->getBidang($id_bidang)->bidang;
                                        $divisi = $this->model_user->getDivisi($id_divisi)->divisi;
                                        $kabid = $this->model_user->getUser($this->session->userdata('username'))->bidang;
                                        $nama_bidang = $this->model_user->getBidang($kabid)->bidang;
                                    ?>
                                        <tr>
                                            <td width="50"><?php echo $no ?></td>
                                            <td><?php echo $row->username ?></td>
                                            <td><?php echo $nama ?></td>
                                            <td class="text-center"><?php if (!empty($row->pkkmb)) {
                                                                        // echo "<a href=" . site_url('ketum/download/dokumen_lain/' . $row->dokumen_lain) . " class=\"btn btn-primary btn-sm\">Lihat File</a>";
                                                                        echo "<a href=" . site_url('ketum/download/pkkmb/' . $row->pkkmb) . " class=\"btn btn-primary btn-sm\">Lihat File</a>";
                                                                    } else {
                                                                        echo "Tidak Upload";
                                                                    } ?></td>
                                            <td class="text-center">
                                                <?php if (!empty($row->krs)) {
                                                    // echo "<a href=" . site_url('ketum/download/form/' . $row->form) . " class=\"view-pdf btn btn-primary btn-sm\">Lihat File</a>";
                                                    echo "<a href=" . site_url('ketum/download/krs/' . $row->krs) . " class=\"view-pdf btn btn-primary btn-sm\">Lihat File</a>";
                                                } else {
                                                    echo "Tidak Upload";
                                                } ?>
                                            </td>
                                            <td class="text-center"><?php
                                                                    $pdf = preg_match('/karya.pdf/i', $row->karya);
                                                                    $png = preg_match('/karya.png/i', $row->karya);
                                                                    $jpg = preg_match('/karya.jpg/i', $row->karya);
                                                                    $jpeg = preg_match('/karya.jpeg/i', $row->karya);
                                                                    if (!empty($row->karya)) {
                                                                        if ($pdf == 1 || $png == 1 || $jpg == 1 || $jpeg == 1) {
                                                                            echo "<a href=" . site_url('ketum/download/karya/' . $row->karya) . " class=\"btn btn-primary btn-sm\">Lihat File</a>";
                                                                        } else {
                                                                            echo "<a target=\"_blank\" href=" . $row->karya . " class=\"btn btn-primary btn-sm\">Lihat File</a>";
                                                                        }
                                                                    } else {
                                                                        echo "Tidak Upload";
                                                                    }
                                                                    $nilai_kabid = "";
                                                                    if ($kabid == 2) {
                                                                        $nilai_kabid = $row->nilai_organisasi;
                                                                        $catatan_kabid = $row->catatan_organisasi;
                                                                    } elseif ($kabid == 3) {
                                                                        $nilai_kabid = $row->nilai_penalaran;
                                                                        $catatan_kabid = $row->catatan_penalaran;
                                                                    } elseif ($kabid == 4) {
                                                                        $nilai_kabid = $row->nilai_kesejahteraan;
                                                                        $catatan_kabid = $row->catatan_kesejahteraan;
                                                                    } elseif ($kabid == 5) {
                                                                        $nilai_kabid = $row->nilai_bakat;
                                                                        $catatan_kabid = $row->catatan_bakat;
                                                                    } elseif ($kabid == 6) {
                                                                        $nilai_kabid = $row->nilai_pengabdian;
                                                                        $catatan_kabid = $row->catatan_pengabdian;
                                                                    } else {
                                                                        $nilai_kabid = "";
                                                                    }
                                                                    $nilai_sudah = "";
                                                                    if ($nilai_kabid != null) {
                                                                        $nilai_sudah = $kabid;
                                                                    } else {
                                                                        $nilai_sudah = "";
                                                                    }
                                                                    ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-success btn-sm" title="Detail" data-toggle="modal" data-target="#detail" onclick="detail(this);" data-nama="<?= $nama ?>" data-username="<?= $row->username ?>" data-id="<?= $row->id_dokumen ?>" data-id_bidang="<?= $id_bidang ?>" data-bidang="<?= $bidang ?>" data-id_divisi="<?= $id_divisi ?>" data-divisi="<?= $divisi ?>" data-nilai_kabid="<?= $nilai_kabid ?>" data-nilai_sudah="<?= $kabid ?>" data-catatan_kabid="<?= $catatan_kabid ?>" saw="<?= $saw ?>">
                                                    Nilai
                                                </button>
                                            </td>
                                        </tr>
                                    <?php $no++;
                                    endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="detail" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Detail Pendaftar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('kabid/rekrut') ?>" class="form-submit" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">NIM</label>
                        <dd id="username_detail"></dd>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <dd id="nama_detail"></dd>
                    </div>
                    <div class="form-group">
                        <label for="nama">Bidang yang dipilih</label>
                        <dd id="bidang_detail"></dd>
                    </div>
                    <div class="form-group">
                        <label for="nama">Divisi yang dipilih</label>
                        <dd id="divisi_detail"></dd>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-9">
                                <label for="nilai">Nilai Wawancara
                                    <!--<small id="danger" class="text-danger"> (Setelah disimpan, nilai tidak dapat diubah)</small>-->
                                </label>
                            </div>
                            <div class="col-3">
                                <input autocomplete="off" type="number" class="form-control" style="text-align: right;" id="nilai_kabid" name="nilai_kabid" placeholder="0-100" data-validation="required" min="0" max="100">
                            </div>
                        </div>
                    </div>
                                <div class="text-danger" id="danger">
                                <div class="row">
                                    Rubrik Penilaian :
                                </div>
                                    <div class="row">
                                        <div class="col-3">
                                            Sangat Sesuai
                                        </div>
                                        <div class="col-2">
                                            76-100
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            Sesuai
                                        </div>
                                        <div class="col-2">
                                            51-75
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            Kurang Sesuai
                                        </div>
                                        <div class="col-2">
                                            26-50
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            Tidak Sesuai
                                        </div>
                                        <div class="col-2">
                                            0-25
                                        </div>
                                    </div>
                                </div>
                    <div class="form-group">
                                <label for="catatan">Catatan Wawancara
                                </label>
                                <textarea autocomplete="off" class="form-control" rows="3" style="resize: none;" id="catatan_kabid" name="catatan_kabid"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id_dok" id="id_detail">
                    <input type="hidden" name="kabid" id="nilai_sudah">
                    <input type="hidden" name="nilai">
                    <input type="text" id="saw">
                    <button type="submit" class="btn btn-primary" id="submit">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
    function detail(identifier) {
        var button = $(identifier);
        var nama = button.data('nama');
        var username = button.data('username');
        var id = button.data('id');
        var bidang = button.data('bidang');
        var divisi = button.data('divisi');
        var nilai_kabid = button.data('nilai_kabid');
        var catatan_kabid = button.data('catatan_kabid');
        var nilai_sudah = button.data('nilai_sudah');
        var saw = button.data('saw');

        $('#saw').val(saw);
        
        $('#nama_detail').html(nama);
        $('#username_detail').html(username);
        $('#id_detail').val(id);
        $('#bidang_detail').html(bidang);
        $('#divisi_detail').html(divisi);
        $('#nilai_kabid').val(nilai_kabid)
        $('#catatan_kabid').val(catatan_kabid)
        $('#nilai_sudah').val(nilai_sudah)

        // if (nilai_kabid == "") {
        //     document.getElementById('nilai_kabid').disabled = false;
        //     document.getElementById('catatan_kabid').disabled = false;
        //     // $('#nilai_kabid').prop("disabled", false);
        //     document.getElementById('danger').style.display = "block";
        //     document.getElementById('submit').style.display = "block";
        // } else {
        //     document.getElementById('nilai_kabid').disabled = true;
        //     document.getElementById('catatan_kabid').disabled = true;
        //     // $('#nilai_kabid').prop("disabled", true);
        //     document.getElementById('danger').style.display = "none";
        //     document.getElementById('submit').style.display = "none";
        // }
        if (saw == "") {
            document.getElementById('nilai_kabid').disabled = false;
            document.getElementById('catatan_kabid').disabled = false;
            // $('#nilai_kabid').prop("disabled", false);
            document.getElementById('danger').style.display = "block";
            document.getElementById('submit').style.display = "block";
        } else
        // if(saw == 'sudah')
        {
            document.getElementById('nilai_kabid').disabled = true;
            document.getElementById('catatan_kabid').disabled = true;
            // $('#nilai_kabid').prop("disabled", true);
            document.getElementById('danger').style.display = "none";
            document.getElementById('submit').style.display = "none";
        } 
        // else {
        //     document.getElementById('nilai_kabid').disabled = false;
        //     document.getElementById('catatan_kabid').disabled = false;
        //     // $('#nilai_kabid').prop("disabled", false);
        //     document.getElementById('danger').style.display = "block";
        //     document.getElementById('submit').style.display = "block";
        // }
    }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>