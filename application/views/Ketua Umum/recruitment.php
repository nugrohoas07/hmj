<?php section('contents'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('Ketum') ?>">HMJ</a></li>
            <li class="breadcrumb-item active">Recruitment</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
        <?php
        if($saw=='sudah'){
        ?>
                    <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Perhitungan SAW
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Alternatif</th>
                                        <th>Sertifikat PKKMB</th>
                                        <th>KRS</th>
                                        <th>Karya</th>
                                        <th>Nilai Wawancara</th>
                                        <th>Nilai Preferensi</th>
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
                                    ?>
                                        <tr>
                                            <td width="50"><?php echo $no ?></td>
                                            <td><?php echo $nama ?></td>
                                            <td class="text-center"><?php if (!empty($row->pkkmb)) {
                                                                        
                                                                        echo "1";
                                                                    } else {
                                                                        echo "0";
                                                                    } ?></td>
                                            <td class="text-center">
                                                <?php if (!empty($row->krs)) {
                                                    
                                                    echo "1";
                                                } else {
                                                    echo "0";
                                                } ?>
                                            </td>
                                            <td class="text-center"><?php
                                                                    $pdf = preg_match('/karya.pdf/i', $row->karya);
                                                                    $png = preg_match('/karya.png/i', $row->karya);
                                                                    $jpg = preg_match('/karya.jpg/i', $row->karya);
                                                                    $jpeg = preg_match('/karya.jpeg/i', $row->karya);
                                                                    if (!empty($row->karya)) {
                                                                        if ($pdf == 1 || $png == 1 || $jpg == 1 || $jpeg == 1) {
                                                                            echo "1";
                                                                        } else {
                                                                            echo "1";
                                                                        }
                                                                    } else {
                                                                        echo "0";
                                                                    }
                                                                    $nilai_semua = "";
                                                                    // $nilai_sudah = "";
                                                                    // if ($row->nilai_organisasi != null && $row->nilai_penalaran != null && $row->nilai_kesejahteraan != null && $row->nilai_bakat != null && $row->nilai_pengabdian != null && $row->nilai_ketum != null) { //nilai ketum akan direvisi
                                                                    if ($row->nilai_organisasi != null && $row->nilai_penalaran != null && $row->nilai_kesejahteraan != null && $row->nilai_bakat != null && $row->nilai_pengabdian != null) { //sudah direvisi
                                                                        $nilai_semua = "sudah";
                                                                    } 
                                                                    // elseif ($row->nilai_ketum != null) {//nilai ketum akan direvisi
                                                                    //     $nilai_sudah = "ketum";
                                                                    // } 
                                                                    else {
                                                                        $nilai_semua = "";
                                                                        // $nilai_sudah = "";
                                                                    }
                                                                    ?></td>
                                            <td>
                                                <?php
                                                // $nilai_wawancara = ($row->nilai_organisasi + $row->nilai_penalaran + $row->nilai_kesejahteraan + $row->nilai_bakat + $row->nilai_pengabdian + $row->nilai_ketum) / 6;//nilai ketum akan direvisi
                                                $nilai_wawancara = ($row->nilai_organisasi + $row->nilai_penalaran + $row->nilai_kesejahteraan + $row->nilai_bakat + $row->nilai_pengabdian) / 5;//sudah direvisi

                                        $max_wawancara = $this->db->select_max('nilai_wawancara')->get_where('dokumen_user',['status' => '0'])->row();

                                                $rata2_wawancara = $row->nilai_wawancara / $max_wawancara->nilai_wawancara;
                                                echo round($rata2_wawancara,3);
                                                ?>
                                            </td>
                                            <td>
                                                <?= $row->total_nilai == null ? 'Belum' : $row->total_nilai
                                                ?>
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
            <?php
        }
            ?>
            
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Recruitment
              </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
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
                    <th>Nilai Akhir</th>
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
                  ?>
                    <tr>
                      <td width="50"><?php echo $no ?></td>
                      <td><?php echo $row->username ?></td>
                      <td><?php echo $nama ?></td>
                      <td class="text-center"><?php if (!empty($row->pkkmb)) {
                                                echo "<a href=" . site_url('ketum/download/pkkmb/' . $row->pkkmb) . " class=\"btn btn-primary btn-sm\">Lihat File</a>";
                                              } else {
                                                echo "Tidak Upload";
                                              } ?></td>
                      <td class="text-center">
                        <?php if (!empty($row->krs)) {
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
                                              $nilai_semua = "";
                                            //   $nilai_sudah = "";
                                            //   if ($row->nilai_organisasi != null && $row->nilai_penalaran != null && $row->nilai_kesejahteraan != null && $row->nilai_bakat != null && $row->nilai_pengabdian != null && $row->nilai_ketum != null) {//nilai ketum akan direvisi
                                              if ($row->nilai_organisasi != null && $row->nilai_penalaran != null && $row->nilai_kesejahteraan != null && $row->nilai_bakat != null && $row->nilai_pengabdian != null) {//sudah direvisi
                                                $nilai_semua = "sudah";
                                              } 
                                            //   elseif ($row->nilai_ketum != null) {//nilai ketum akan direvisi
                                            //     $nilai_sudah = "ketum";
                                            //   }
                                              else {
                                                $nilai_semua = "";
                                                // $nilai_sudah = "";
                                              }
                                              ?></td>
                      <td>
                        <?= $row->total_nilai == null ? 'Belum' : $row->total_nilai * 100
                        ?>
                      </td>
                      <td class="text-center">
                        <!--<button class="btn btn-success btn-sm" title="Detail" data-toggle="modal" data-target="#detail" onclick="detail(this);" data-nama="<?= $nama ?>" data-username="<?= $row->username ?>" data-id="<?= $row->id_dokumen ?>" data-id_bidang="<?= $id_bidang ?>" data-bidang="<?= $bidang ?>" data-id_divisi="<?= $id_divisi ?>" data-divisi="<?= $divisi ?>" data-nilai_oka="<?= $row->nilai_organisasi ?>" data-nilai_pk="<?= $row->nilai_penalaran ?>" data-nilai_ksj="<?= $row->nilai_kesejahteraan ?>" data-nilai_bakmin="<?= $row->nilai_bakat ?>" data-nilai_pengmas="<?= $row->nilai_pengabdian ?>" data-nilai_ketum="<?= $row->nilai_ketum ?>" data-nilai_semua="<?= $nilai_semua ?>" data-nilai_sudah="<?= $nilai_sudah ?>" data-total_nilai="<?= $row->total_nilai ?>">-->
                          <!--Nilai-->
                            <!--//nilai ketum akan direvisi-->
                        <button class="btn btn-success btn-sm" title="Detail" data-toggle="modal" data-target="#detail" onclick="detail(this);" data-nama="<?= $nama ?>" data-username="<?= $row->username ?>" data-id="<?= $row->id_dokumen ?>" data-id_bidang="<?= $id_bidang ?>" data-bidang="<?= $bidang ?>" data-id_divisi="<?= $id_divisi ?>" data-divisi="<?= $divisi ?>" data-nilai_oka="<?= $row->nilai_organisasi ?>" data-catatan_oka="<?= $row->catatan_organisasi ?>" data-nilai_pk="<?= $row->nilai_penalaran ?>" data-catatan_pk="<?= $row->catatan_penalaran ?>" data-nilai_ksj="<?= $row->nilai_kesejahteraan ?>" data-catatan_ksj="<?= $row->catatan_kesejahteraan ?>" data-nilai_bakmin="<?= $row->nilai_bakat ?>" data-catatan_bakmin="<?= $row->catatan_bakat ?>" data-nilai_pengmas="<?= $row->nilai_pengabdian ?>" data-catatan_pengmas="<?= $row->catatan_pengabdian ?>" data-nilai_semua="<?= $nilai_semua ?>" data-total_nilai="<?= $row->total_nilai ?>">
                            Detail
                            <!--sudah direvisi-->
                        </button>
                      </td>
                    </tr>
                  <?php $no++;
                  endforeach; ?>
                </tbody>
              </table>
            </div>
            <!-- revisi  -->
            <?php
            if($saw=='wawancara'){
            ?>
            <div class="card-footer" id="proses">
                <form role="form" action="<?= site_url('Ketum/rekrut') ?>" class="form-submit" method="post" enctype="multipart/form-data" >
                    <input type="hidden" name="nilai">
                    <button type="submit" class="btn btn-success float-right">Proses</button>
                </form>
            </div>
            <!-- menambah tombol untuk proses hitung saw -->
            <?php
            }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Pendaftaran</h3>
            </div>
            <?php
            $pengumpulan = "";
            $pengumpulan2 = "";
            $admin = "";
            $admin2 = "";
            $wawancara = "";
            $wawancara2 = "";
            $pengumuman = "";
            $form = "";
            $syarat = "";
            $link_syarat = "";
            $stat_pendaftaran = "";
            if (!empty($pendaftaran)) {
              $stat_pendaftaran = $pendaftaran->status;
              $pengumpulan = $pendaftaran->pengumpulan_awal;
              $pengumpulan2 = $pendaftaran->pengumpulan_akhir;
              $admin = $pendaftaran->administrasi_awal;
              $admin2 = $pendaftaran->administrasi_akhir;
              $wawancara = $pendaftaran->wawancara_awal;
              $wawancara2 = $pendaftaran->wawancara_akhir;
              $pengumuman = $pendaftaran->pengumuman;
              $form = $pendaftaran->formulir;
              $syarat = $pendaftaran->persyaratan;
              $link_syarat = $pendaftaran->link_persyaratan;
            }

            ?>
            <form role="form" action="<?php echo site_url('ketum/rekrut') ?>" class="form-submit" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label>Pendaftaran</label>
                  <select id="stat_daftar" name="status" class="form-control select2-nosearch" style="width: 100%;" data-validation="required">
                    <option value="0" <?php if ($stat_pendaftaran == "0") echo "selected"; ?>>Aktif</option>
                    <option value="1" <?php if ($stat_pendaftaran == "1") echo "selected"; ?>>Non Aktif</option>
                  </select>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tgl.Pengumpulan</label>
                      <input autocomplete="off" type="text" value="<?= $pengumpulan ?>" name="kumpul" class="form-control" placeholder="Tanggal mulai pengumpulan berkas" id="kumpul_awal" data-toggle="datetimepicker" data-target="#kumpul_awal" data-validation="required" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tgl.Selesai Pengumpulan</label>
                      <input autocomplete="off" type="text" value="<?= $pengumpulan2 ?>" name="kumpuls" class="form-control" placeholder="Tanggal selesai pengumpulan berkas" id="kumpul_akhir" data-toggle="datetimepicker" data-target="#kumpul_akhir" data-validation="required" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tgl.Administrasi</label>
                      <input autocomplete="off" type="text" value="<?= $admin2 ?>" name="admin" class="form-control" placeholder="Tanggal mulai seleksi administrasi" id="adm_awal" data-toggle="datetimepicker" data-target="#adm_awal" data-validation="required" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tgl.Selesai Administrasi</label>
                      <input autocomplete="off" type="text" value="<?= $admin2 ?>" name="admins" class="form-control" placeholder="Tanggal selesai seleksi administrasi" id="adm_akhir" data-toggle="datetimepicker" data-target="#adm_akhir" data-validation="required" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tgl.Wawancara</label>
                      <input autocomplete="off" type="text" value="<?= $wawancara ?>" name="wawancara" class="form-control" placeholder="Tanggal mulai seleksi wawancara" id="ww_awal" data-toggle="datetimepicker" data-target="#ww_awal" data-validation="required" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tgl.Selesai Wawancara</label>
                      <input autocomplete="off" type="text" value="<?= $wawancara2 ?>" name="wawancaras" class="form-control" placeholder="Tanggal selesai seleksi wawancara" id="ww_akhir" data-toggle="datetimepicker" data-target="#ww_akhir" data-validation="required" />
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Tgl.Pengumuman</label>
                  <input autocomplete="off" type="text" value="<?= $pengumuman ?>" name="pengumuman" class="form-control" placeholder="Tanggal pengumuman hasil seleksi" id="default-date-picker" data-toggle="datetimepicker" data-target="#default-date-picker" data-validation="required" />
                </div>
                <div class="form-group">
                  <label>Persyaratan</label>
                  <textarea autocomplete="off" class="textarea" placeholder="Persyaratan" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" name="syarat" class="form-control">
                  <?= $syarat ?></textarea>
                  <label>Link Persyaratan</label>
                  <input autocomplete="off" type="text" value="<?= $link_syarat ?>" name="link_syarat" class="form-control" placeholder="Sertakan http://" data-validation="required" />
                </div>
              </div>
              <div class="card-footer">
                <input type="hidden" name="pendaftaran">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
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
      <!--<form role="form" action="<?= site_url('Ketum/rekrut') ?>" class="form-submit" method="post" enctype="multipart/form-data" >-->
      <form role="form" action="" class="form-submit" method="post" enctype="multipart/form-data" >
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
              <div class="col-10">
                <label for="nama">Nilai Bidang Organisasi dan Kepemimpinan</label>
              </div>
              <div class="col-2">
                <dd style="text-align: right;" id="nilai_oka"></dd>
              </div>
            </div>
          <!--revisi-->
            <div class="row catatan_oka">
                <div class="col-12">
                    <label for="nama">Catatan</label>
                    <textarea disabled autocomplete="off" class="form-control" rows="3" style="resize: none;" id="catatan_oka"></textarea>
                </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-10">
                <label for="nama">Nilai Bidang Penalaran dan Keilmuan</label>
              </div>
              <div class="col-2">
                <dd style="text-align: right;" id="nilai_pk"></dd>
              </div>
            </div>
          <!--revisi-->
          <div class="row catatan_pk">
              <div class="col-12">
            <label for="nama">Catatan</label>
            <textarea disabled autocomplete="off" class="form-control" rows="3" style="resize: none;" id="catatan_pk"></textarea>
              </div>
          </div>
          </div>
          
          
          <div class="form-group">
            <div class="row">
              <div class="col-10">
                <label for="nama">Nilai Bidang Kesejahteraan</label>
              </div>
              <div class="col-2">
                <dd style="text-align: right;" id="nilai_ksj"></dd>
              </div>
            </div>
          <!--revisi-->
          <div class="row catatan_ksj">
              <div class="col-12">
            <label for="nama">Catatan</label>
            <textarea disabled autocomplete="off" class="form-control" rows="3" style="resize: none;" id="catatan_ksj"></textarea>
              </div>
          </div>
          </div>
          
          
          <div class="form-group">
            <div class="row">
              <div class="col-10">
                <label for="nama">Nilai Bidang Bakat dan Minat</label>
              </div>
              <div class="col-2">
                <dd style="text-align: right;" id="nilai_bakmin"></dd>
              </div>
            </div>
          <!--revisi-->
          <div class="row catatan_bakmin">
              <div class="col-12">
            <label for="nama">Catatan</label>
            <textarea disabled autocomplete="off" class="form-control" rows="3" style="resize: none;" id="catatan_bakmin"></textarea>
              </div>
          </div>
          </div>
          
          
          <div class="form-group">
            <div class="row">
              <div class="col-10">
                <label for="nama">Nilai Bidang Pengabdian Masyarakat</label>
              </div>
              <div class="col-2 float-sm-right">
                <dd style="text-align: right;" id="nilai_pengmas"></dd>
              </div>
            </div>
          <!--revisi-->
          <div class="row catatan_pengmas">
              <div class="col-12">
            <label for="nama">Catatan</label>
            <textarea disabled autocomplete="off" class="form-control" rows="3" style="resize: none;" id="catatan_pengmas"></textarea>
              </div>
          </div>
          </div>
          
          
          <!--<div class="form-group">-->
          <!--  <div class="row">-->
          <!--    <div class="col-9">-->
          <!--      <label for="nama">Nilai Ketua Umum-->
          <!--        <small id="danger" class="text-danger"> (Setelah disimpan, nilai tidak dapat diubah)</small>-->
          <!--      </label>-->
          <!--    </div>-->
          <!--    <div class="col-3">-->
          <!--      <input autocomplete="off" type="number" class="form-control" style="text-align: right;" id="nilai_ketum" name="nilai_ketum" placeholder="0-100" data-validation="required" min="0" max="100">-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->
              <!--//nilai ketum akan direvisi-->
          <div class="form-group" id="tombol">
            <div class="row">
              <div class="col-6">
                <center>
                  <button class="btn btn-success " title="Terima" id="klik_terima" data-dismiss="modal" data-toggle="modal" data-target="#terima" onclick="setujuData(this)"><i class="fas fa-check-circle"></i> Terima</button>
                </center>
              </div>
              <div class="col-6">
                <center>
                  <button class="btn btn-danger " title="Tolak" data-dismiss="modal" data-toggle="modal" data-target="#tolak" onclick="tolakData(this)"><i class="fa fa-times-circle"></i> Tolak</button>
                </center>
              </div>
            </div>
          </div>
        </div>
        <!--<div class="modal-footer">-->
        <!--  <input type="hidden" name="id_dok" id="id_detail">-->
          <!--<input type="hidden" name="nilai">-->
          <!--//nilai ketum akan direvisi-->
        <!--  <button type="submit" class="btn btn-primary" id="submit">Simpan</button>-->
        <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>-->
        <!--</div>-->
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="terima" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h4 class="modal-title">Terima Pendaftar</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="<?= site_url('ketum/rekrut'); ?>" class="form-submit" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <b>Terima <span id="nama_setuju"></span> ?</b>
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
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="username" id="username_setuju">
          <input type="hidden" name="id_dok" id="id_setuju">
          <input type="hidden" name="terima">
          <button type="submit" class="btn btn-success">Terima</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="tolak" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h4 class="modal-title">Tolak Pendaftar</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <form role="form" action="<?= site_url('ketum/rekrut'); ?>" class="form-submit" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <b>Tolak <span id="nama_tolak"></span> ?</b>
          <div class="form-group">
            <label>Alasan :</label>
            <textarea autocomplete="off" class="form-control" rows="3" style="resize: none;" name="alasan" placeholder="Masukkan alasan penolakan" data-validation="required"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="username" id="username_tolak">
          <input type="hidden" name="id_dok" id="id_tolak">
          <input type="hidden" name="tolak">
          <button type="submit" class="btn btn-danger">Tolak</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
  var nama_setuju, username_setuju, id_setuju, id_bidang, id_divisi;

  function detail(identifier) {
    var button = $(identifier);
    var nama = button.data('nama');
    var username = button.data('username');
    var id = button.data('id');
    var bidang_setuju = button.data('id_bidang');
    var bidang = button.data('bidang');
    var divisi_setuju = button.data('id_divisi');
    var divisi = button.data('divisi');
    var nilai_oka = button.data('nilai_oka');
    var catatan_oka = button.data('catatan_oka');
    var nilai_pk = button.data('nilai_pk');
    var catatan_pk = button.data('catatan_pk');
    var nilai_ksj = button.data('nilai_ksj');
    var catatan_ksj = button.data('catatan_ksj');
    var nilai_bakmin = button.data('nilai_bakmin');
    var catatan_bakmin = button.data('catatan_bakmin');
    var nilai_pengmas = button.data('nilai_pengmas');
    var catatan_pengmas = button.data('catatan_pengmas');
    // var nilai_ketum = button.data('nilai_ketum');//nilai ketum akan direvisi
    var nilai_semua = button.data('nilai_semua');
    // var nilai_sudah = button.data('nilai_sudah');
    var total_nilai = button.data('total_nilai');

    $('#nama_detail').html(nama);
    $('#username_detail').html(username);
    $('#id_detail').val(id);
    $('#bidang_detail').html(bidang);
    $('#divisi_detail').html(divisi);
    nilai_oka == '' ? $('#nilai_oka').html('Belum') : $('#nilai_oka').html(nilai_oka);
    if(catatan_oka == ''){
        document.getElementsByClassName('catatan_oka')[0].style.display = 'none'
    }else{
        document.getElementsByClassName('catatan_oka')[0].style.display = 'block'
        $('#catatan_oka').html(catatan_oka);
    }
    
    nilai_pk == '' ? $('#nilai_pk').html('Belum') : $('#nilai_pk').html(nilai_pk);
    if(catatan_pk == ''){
        document.getElementsByClassName('catatan_pk')[0].style.display = 'none';
    }else{
        document.getElementsByClassName('catatan_pk')[0].style.display = 'block';
        $('#catatan_pk').html(catatan_pk);
    }

    nilai_ksj == '' ? $('#nilai_ksj').html('Belum') : $('#nilai_ksj').html(nilai_ksj);
    if(catatan_ksj == ''){
        document.getElementsByClassName('catatan_ksj')[0].style.display = 'none';
    }else{
        document.getElementsByClassName('catatan_ksj')[0].style.display = 'block';
        $('#catatan_ksj').html(catatan_ksj);
    }

    nilai_bakmin == '' ? $('#nilai_bakmin').html('Belum') : $('#nilai_bakmin').html(nilai_bakmin);
    if(catatan_bakmin == ''){
        document.getElementsByClassName('catatan_bakmin')[0].style.display = 'none';
    }else{
        document.getElementsByClassName('catatan_bakmin')[0].style.display = 'block';
        $('#catatan_bakmin').html(catatan_bakmin);
    }

    nilai_pengmas == '' ? $('#nilai_pengmas').html('Belum') : $('#nilai_pengmas').html(nilai_pengmas);
    if(catatan_pengmas == ''){
        document.getElementsByClassName('catatan_pengmas')[0].style.display = 'none';
    }else{
        document.getElementsByClassName('catatan_pengmas')[0].style.display = 'block';
        $('#catatan_pengmas').html(catatan_pengmas);
    }

    total_nilai == '' ? document.getElementById('tombol').style.display = "none" : document.getElementById('tombol').style.display = "block";
    
    // $('#nilai_ketum').val(nilai_ketum)//nilai ketum akan direvisi

    // if (nilai_sudah == "ketum") {
    //   document.getElementById('nilai_ketum').disabled = true;//nilai ketum akan direvisi
    //   document.getElementById('tombol').style.display = "none";
    //   document.getElementById('danger').style.display = "none";
    //   document.getElementById('submit').style.display = "none";
    // } else 
    // if (nilai_semua == "sudah") {
    // // if (nilai_semua == "") {
    // //   document.getElementById('nilai_ketum').disabled = false;//nilai ketum akan direvisi
    //   document.getElementById('tombol').style.display = "none";
    // //   document.getElementById('danger').style.display = "block";
    // //   document.getElementById('submit').style.display = "block";
    // } else 
    // if (total_nilai == "") {
    // //   document.getElementById('nilai_ketum').disabled = true;//nilai ketum akan direvisi
    //   document.getElementById('tombol').style.display = "none";
    // //   document.getElementById('danger').style.display = "none";
    // //   document.getElementById('submit').style.display = "none";
    // } else{
    // //   document.getElementById('nilai_ketum').disabled = true;//nilai ketum akan direvisi
    //   document.getElementById('tombol').style.display = "block";
    // //   document.getElementById('danger').style.display = "none";
    // //   document.getElementById('submit').style.display = "none";
    // }

    nama_setuju = nama;
    username_setuju = username;
    id_setuju = id;
    id_bidang = bidang_setuju;
    id_divisi = divisi_setuju;
  }

  function setujuData(identifier) {
      $(document).ready(function() {
          $(window).keydown(function(event){
              if(event.keyCode == 13) {
                  event.preventDefault();
                  return false;
              }
          });
      });
      
    var button = $(identifier);
    var nama = nama_setuju;
    var username = username_setuju;
    var id = id_setuju;

    $('#nama_setuju').html(nama);
    $('#username_setuju').val(username);
    $('#id_setuju').val(id);
  }

  function tolakData(identifier) {
    var button = $(identifier);
    var nama = nama_setuju;
    var username = username_setuju;
    var id = id_setuju;

    $('#nama_tolak').html(nama);
    $('#username_tolak').val(username);
    $('#id_tolak').val(id);
  }

  $(function() {
    $('#kumpul_awal,#adm_awal,#ww_awal').datetimepicker({
      format: 'L',
      format: 'YYYY-MM-DD'
    });
    $('#kumpul_akhir,#adm_akhir,#ww_akhir').datetimepicker({
      format: 'L',
      format: 'YYYY-MM-DD',
      useCurrent: false
    });
    $("#kumpul_awal").on("change.datetimepicker", function(e) {
      $('#kumpul_akhir').datetimepicker('minDate', e.date);
    });
    $("#kumpul_akhir").on("change.datetimepicker", function(e) {
      $('#kumpul_awal').datetimepicker('maxDate', e.date);
    });
    $("#adm_awal").on("change.datetimepicker", function(e) {
      $('#adm_akhir').datetimepicker('minDate', e.date);
    });
    $("#adm_akhir").on("change.datetimepicker", function(e) {
      $('#adm_awal').datetimepicker('maxDate', e.date);
    });
    $("#ww_awal").on("change.datetimepicker", function(e) {
      $('#ww_akhir').datetimepicker('minDate', e.date);
    });
    $("#ww_akhir").on("change.datetimepicker", function(e) {
      $('#ww_awal').datetimepicker('maxDate', e.date);
    });
  })

  $(document).ready(function() {
    $('#klik_terima').click(function() {
      $('#bidang').val(id_bidang).change();
      if (id_bidang) {
        $.ajax({
          url: "<?= site_url('Ketum/listDivisi/'); ?>" + id_bidang,
          dataType: 'json',
          success: function(data) {
            $('#divisi').empty();
            $.each(data, function(key, value) {
              if (id_divisi == value.id_divisi) {
                $('#divisi')
                  .append($("<option selected></option>")
                    .attr("value", value.id_divisi)
                    .text(value.divisi));
              } else {
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
    $('#bidang').change(function() {
      var id_bidang = $('#bidang').val();
      if (id_bidang) {
        $.ajax({
          url: "<?= site_url('Ketum/listDivisi/'); ?>" + id_bidang,
          dataType: 'json',
          success: function(data) {
            $('#divisi').empty();
            $.each(data, function(key, value) {
              if (id_divisi == value.id_divisi) {
                $('#divisi')
                  .append($("<option selected></option>")
                    .attr("value", value.id_divisi)
                    .text(value.divisi));
              } else {
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