<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Rekap Pendanaan</li>
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
                            <h3 class="card-title">Rekap Pendanaan</h3>
                        </div>
                        <div class="card-body">
                            <div class="block mb-4 text-left">
                                <a href="<?= site_url('Bendahara/addRekap'); ?>" class="btn btn-success" title="Tambah Rekap Dana"><i class="fa fa-plus"> </i> Tambah</a>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Proker</th>
                                        <th>Keperluan</th>
                                        <th>Pemasukan</th>
                                        <th>Pengeluaran</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $sisa = 0;

                                    foreach ($saldo as $row) :
                                        if($row->username == null && $row->nama == null && $row->proker == null){
                                            $nim = $this->session->userdata('username');
                                            $nama = $this->session->userdata('jabatan');
                                            $proker = 'HMJ';
                                        }else{
                                            $nim = $row->username;
                                            $nama = $row->nama;
                                            $proker = $row->proker;
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no ?></td>
                                            <td><?= tanggal_indo($row->tanggal) ?></td>
                                            <td><?= $nama ?></td>
                                            <td><?= $proker ?></td>
                                            <td><?= $row->keperluan ?></td>
                                            <td style="text-align: right;"><?= 'Rp. ' . number_format($row->pemasukan)
                                                                            ?></td>
                                            <td style="text-align: right;"><?= 'Rp. ' . number_format($row->pengeluaran)
                                                                            ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-primary btn-xs" title="Lihat Detail" data-toggle="modal" data-target="#detail" onclick="fetchDetail(this);" data-tanggal="<?= tanggal_indo($row->tanggal) ?>" data-nim="<?= $nim ?>" data-nama="<?= $nama ?>" data-proker="<?= $proker ?>" data-keperluan="<?= $row->keperluan ?>" data-sumber="<?= $row->sumber ?>" data-pemasukan="<?= 'Rp. ' . number_format($row->pemasukan) ?>" data-pengeluaran="<?= 'Rp. ' . number_format($row->pengeluaran) ?>" data-tgl_ajukan="<?= to_date_time($row->tgl_ajukan) ?>" data-tgl_terima="<?= to_date_time($row->tgl_terima) ?>"data-bukti="<?= $row->bukti ?>" ><i class="fa fa-eye"></i></button>
                                                <button class="btn btn-primary btn-xs" title="Edit" data-toggle="modal" data-target="#edit" onclick="fetchEdit(this)" data-id_saldo="<?= $row->id_saldo ?>" data-id_proker="<?= $row->id_proker ?>" data-tanggal="<?= $row->tanggal ?>" data-nama="<?= $nama ?>" data-proker="<?= $proker ?>" data-keperluan="<?= $row->keperluan ?>" data-sumber="<?= $row->sumber ?>" data-pemasukan="<?= $row->pemasukan ?>" data-pengeluaran="<?= $row->pengeluaran ?>" data-tgl_ajukan="<?= to_date_time($row->tgl_ajukan) ?>" data-tgl_terima="<?= to_date_time($row->tgl_terima) ?>" data-bukti="<?= $row->bukti ?>"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-xs" title="Hapus" data-toggle="modal" data-target="#hapus" onclick="fetchHapus(this)" data-id_saldo="<?= $row->id_saldo ?>" data-sisa="<?= $row->sisa ?>"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                        $sisa += $row->sisa;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            if ($saldo != null) {
                            ?>
                                <div class="row mt-2 card-footer">
                                    <div class="col-5 ">
                                        <h5 class="text-bold text-center">
                                            Sisa Saldo</h5>
                                    </div>
                                    <div class="col-5">
                                        <h5 class="text-bold text-center">
                                            <?= 'Rp. ' . number_format($sisa);
                                            ?>
                                        </h5>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="detail" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Detail Rekap Pendanaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <dl>
                  <dt>Tanggal</dt>
                  <dd id="tanggal_detail"></dd>
                  <dt>NIM</dt>
                  <dd id="nim_detail"></dd>
                  <dt>Nama</dt>
                  <dd id="nama_detail"></dd>
                  <dt>Proker</dt>
                  <dd id="proker_detail"></dd>
                  <dt>Keperluan</dt>
                  <dd id="keperluan_detail"></dd>
                  <dt>Sumber</dt>
                  <dd id="sumber_detail"></dd>
                  <dt>Pemasukan</dt>
                  <dd id="pemasukan_detail"></dd>
                  <dt>Pengeluaran</dt>
                  <dd id="pengeluaran_detail"></dd>
                  <dt>Bukti</dt>
                  <a id="bukti_detail" class="btn btn-primary" target="_blank">Lihat File</a>
                  <dt class="pt-3">Diajukan Pada</dt>
                  <dd id="tgl_ajukan_detail"></dd>
                  <dt>Disetujui Pada</dt>
                  <dd id="tgl_terima_detail"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Konfirmasi Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo site_url('Bendahara/rekap') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input autocomplete="off" type="text" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#default-date-picker" id="default-date-picker" name="tanggal" data-validation="required" />
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama_edit" name="nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="proker">Proker</label>
                        <input type="text" class="form-control" id="proker_edit" name="proker" readonly>
                    </div>
                    <div class="form-group">
                        <label for="keperluan">Keperluan</label>
                        <input type="text" class="form-control" id="keperluan_edit" name="keperluan" placeholder="Penggunaan Dana" data-validation="required">
                    </div>
                    <div class="form-group">
                        <label for="sumber">Sumber</label>
                        <input type="text" class="form-control" id="sumber_edit" name="sumber" placeholder="Donatur/Pemberi Dana" data-validation="required">
                    </div>
                    <div class="form-group">
                        <label for="pemasukan">Pemasukan</label>
                        <input type="text" class="form-control" id="pemasukan_edit" name="pemasukan" placeholder="Isi Angka Tanpa Titik: 1000000">
                    </div>
                    <div class="form-group">
                        <label for="pengeluaran">Pengeluaran</label>
                        <input type="text" class="form-control" id="pengeluaran_edit" name="pengeluaran" placeholder="Isi Angka Tanpa Titik: 1000000">
                    </div>
                    <div class="form-group">
                        <label for="bukti">Bukti <small class="text-danger">(Hanya File .jpg, .jpeg, .png, .pdf, Ukuran Maks. 2MB)</small></label>
                        <div class="custom-file">
                            <input type="file" name="bukti" class="custom-file-input" data-validation="size extension" data-validation-allowing="jpg, jpeg, png, pdf" data-validation-min-size="1kb" data-validation-max-size="2M">
                            <label class="custom-file-label" for="bukti">Upload File</label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="hidden" name="bukti_ada" id="bukti_edit">
                    <input type="hidden" name="id_saldo" id="id_saldo_edit" required>
                    <input type="hidden" name="id_proker" id="id_proker_edit" required>
                    <input type="hidden" name="tgl_ajukan" id="tgl_ajukan_edit" required>
                    <input type="hidden" name="edit">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="hapus" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <strong>
                    <h4>Apakah anda yakin ?</h4>
                </strong>
            </div>
            <div class="modal-footer">
                <form role="form" action="<?php echo site_url('Bendahara/rekap') ?>" method="post" enctype="multipart/form-data" class="form-submit">
                    <input type="hidden" name="id_saldo" id="id_saldo_hapus" required>
                    <input type="hidden" name="sisa" id="sisa_hapus" readonly>
                    <input type="hidden" name="hapus">
                    <button type="submit" class="btn btn-danger" >Ya</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
    function fetchDetail(identifier){
        var button = $(identifier);
        var tanggal = button.data('tanggal');
        var nim = button.data('nim');
        var nama = button.data('nama');
        var proker = button.data('proker');
        var keperluan = button.data('keperluan');
        var sumber = button.data('sumber');
        var pemasukan = button.data('pemasukan');
        var pengeluaran = button.data('pengeluaran');
        var bukti = button.data('bukti');
        var tgl_ajukan = button.data('tgl_ajukan');
        var tgl_terima = button.data('tgl_terima');
        var path = "<?= base_url('/upload/saldo/'); ?>"+bukti;

        $('#tanggal_detail').html(tanggal);
        $('#nim_detail').html(nim);
        $('#nama_detail').html(nama);
        $('#proker_detail').html(proker);
        $('#keperluan_detail').html(keperluan);
        $('#sumber_detail').html(sumber);
        $('#pemasukan_detail').html(pemasukan);
        $('#pengeluaran_detail').html(pengeluaran);
        $('#bukti_detail').attr('href', path);
        $('#tgl_ajukan_detail').html(tgl_ajukan);
        $('#tgl_terima_detail').html(tgl_terima);
    }

    function fetchEdit(identifier) {
        var button = $(identifier);
        var id_saldo = button.data('id_saldo');
        var id_proker = button.data('id_proker');
        var tanggal = button.data('tanggal');
        var nama = button.data('nama');
        var proker = button.data('proker');
        var keperluan = button.data('keperluan');
        var sumber = button.data('sumber');
        var pemasukan = button.data('pemasukan');
        var pengeluaran = button.data('pengeluaran');
        var tgl_terima = button.data('tgl_terima');
        var tgl_ajukan = button.data('tgl_ajukan');
        var bukti = button.data('bukti');

        $('#id_saldo_edit').val(id_saldo);
        $('#id_proker_edit').val(id_proker);
        $('#default-date-picker').val(tanggal);
        $('#nama_edit').val(nama);
        $('#proker_edit').val(proker);
        $('#keperluan_edit').val(keperluan);
        $('#sumber_edit').val(sumber);
        $('#pemasukan_edit').val(pemasukan);
        $('#pengeluaran_edit').val(pengeluaran);
        $('#tgl_terima_edit').val(tgl_terima);
        $('#tgl_ajukan_edit').val(tgl_ajukan);
        $('#bukti_edit').val(bukti);
    }

    function fetchHapus(identifier) {
        var button = $(identifier);
        var id_saldo = button.data('id_saldo');
        var sisa = button.data('sisa');

        $('#id_saldo_hapus').val(id_saldo);
        $('#sisa_hapus').val(sisa);
    }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>