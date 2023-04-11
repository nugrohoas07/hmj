<?php section('contents'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('Staff') ?>">HMJ</a></li>
            <li class="breadcrumb-item active">Laporan dan Evaluasi</li>
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
              <h3 class="card-title">Laporan Akhir Kegiatan dan Evaluasi</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Program Kerja</th>
                    <th>Evaluasi</th>
                    <th>Laporan Kegiatan</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                foreach ($proker as $row):
                $evaluasi = $row->evaluasi;
                $lpj = $row->lpj;
                $status_proker = $row->status;
                $status1 = $row->lpj_sekum;
                $status2 = $row->lpj_bendum;
                $status3 = $row->lpj_kabid;
                $status4 = $row->lpj_kadiv;
                ?>
                  <tr>
                    <td class="text-center"><?= $no ?></td>
                    <td><?= $row->nama_proker ?></td>
                    <!-- Evaluasi -->
                    <td width="200" class="text-center"><?php
                    if($evaluasi==null){?> <button class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#upload-evaluasi" title="Upload File Evaluasi" onclick="getEvaluasi(this);" data-id_proker="<?= $row->id_proker ?>" data-proker="<?= $row->nama_proker ?>" data-evaluasi="<?= $row->evaluasi ?>">Upload</button> <?php }
                    else{ ?> <a href="<?= base_url('/upload/proker/'.$evaluasi) ?>" title="Download File" class="btn btn-success btn-xs"><i class="fas fa-download"></i></a>
                    <?php if($status_proker!="3"){ ?>
                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#upload-evaluasi" title="Edit File Evaluasi" onclick="getEvaluasi(this);" data-id_proker="<?= $row->id_proker ?>" data-proker="<?= $row->nama_proker ?>" data-evaluasi="<?= $row->evaluasi ?>"><i class="fa fa-edit"></i></button> 
                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus-evaluasi" title="Hapus File Evaluasi" onclick="getHapusEva(this);" data-id_proker="<?= $row->id_proker ?>"><i class="fa fa-trash"></i></button> <?php }}?></td>
                    <!-- Laporan -->
                    <td width="200" class="text-center"><?php
                    if($lpj==null){?> <button class="btn btn-block btn-primary btn-xs" data-toggle="modal" data-target="#upload-lpj" title="Upload Laporan Kegiatan" onclick="getLaporan(this);" data-id_proker="<?= $row->id_proker ?>" data-proker="<?= $row->nama_proker ?>" data-lpj="<?= $row->lpj ?>">Upload</button> <?php }
                    else{ ?> <a href="<?= base_url('/upload/proker/'.$lpj) ?>" title="Download File" class="btn btn-success btn-xs"><i class="fas fa-download"></i></a>
                    <?php if($status_proker!="3"){ ?>
                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#upload-lpj" title="Edit File Laporan Kegiatan" onclick="getLaporan(this);" data-id_proker="<?= $row->id_proker ?>" data-proker="<?= $row->nama_proker ?>" data-lpj="<?= $row->lpj ?>"><i class="fa fa-edit"></i></button> 
                    <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus-lpj" title="Hapus File Laporan Kegiatan" onclick="getHapusLpj(this);" data-id_proker="<?= $row->id_proker ?>"><i class="fa fa-trash"></i></button>
                    <?php }} if($status1=="2"||$status2=="2"||$status3=="2"||$status4=="2"){ ?><button class="btn btn-primary btn-xs" title="Ajukan Ulang" data-toggle="modal" data-target="#ulang-lpj" onclick="getUlangLpj(this);" data-id_proker="<?= $row->id_proker ?>"><i class="fa fa-paper-plane"></i></button><?php } ?>
                    </td>
                    <td class="text-center"><?php
                    if($lpj==""){ echo "Belum Upload"; 
                    }else{
                        if($status1=="2"||$status2=="2"||$status3=="2"||$status4=="2"){
                            echo "Ditolak";
                        }elseif($status1=="1"&&$status2=="1"&&$status3=="1"&&$status4=="1"){
                            echo "Telah Disetujui";
                        }else{
                            echo "Belum Disetujui";
                        }
                    }
                    ?></td>
                  </tr>
                <?php $no++; endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="upload-evaluasi" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Upload File Evaluasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('Staff/laporan'); ?>" method="post" class="form-submit" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="proker">Program Kerja</label>
                            <input type="text" class="form-control" id="eva_proker_upload" name="proker" readonly>
                        </div>
                        <div class="form-group">
                            <label for="evaluasi">Evaluasi<small class="text-danger"> (format file png,jpg,jpeg,docx,pdf, maks 2MB)</small></label>
                            <div class="custom-file">
                                <input type="hidden" id="eva_id_proker_upload" name="id_proker">
                                <input type="hidden" id="evaluasi_upload" name="old_evaluasi">
                                <input type="file" class="custom-file-input" name="evaluasi" data-validation="extension size" data-validation-min-size="1kb" data-validation-max-size="2M" data-validation-allowing="png,jpg,jpeg,docx,pdf">
                                <label class="custom-file-label" for="evaluasi">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="upload_eva">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus-evaluasi" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Hapus File Evaluasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('Staff/laporan'); ?>" method="post" class="form-submit" enctype="multipart/form-data">
                <div class="modal-body text-center">
                    <strong>
                        <h4>Apakah anda yakin ?</h4>
                    </strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="eva_id_proker_hapus" name="id_proker">
                    <input type="hidden" name="hapus_eva">
                    <button type="submit" class="btn btn-danger">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="upload-lpj" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Upload File Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('Staff/laporan'); ?>" method="post" class="form-submit" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="proker">Program Kerja</label>
                            <input type="text" class="form-control" id="lap_proker_upload" name="proker" readonly>
                        </div>
                        <div class="form-group">
                            <label for="laporan">Laporan Kegiatan<small class="text-danger"> (format file docx, maks 5MB)</small></label>
                            <div class="custom-file">
                                <input type="hidden" id="lap_id_proker_upload" name="id_proker">
                                <input type="hidden" id="laporan_upload" name="old_laporan">
                                <input type="file" class="custom-file-input" name="laporan" data-validation="extension size" data-validation-min-size="1kb" data-validation-max-size="5M" data-validation-allowing="docx">
                                <label class="custom-file-label" for="laporan">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="upload_lap">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus-lpj" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Hapus File Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('Staff/laporan'); ?>" method="post" class="form-submit" enctype="multipart/form-data">
                <div class="modal-body text-center">
                    <strong>
                        <h4>Apakah anda yakin ?</h4>
                    </strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="lap_id_proker_hapus" name="id_proker">
                    <input type="hidden" name="hapus_lap">
                    <button type="submit" class="btn btn-danger">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ulang-lpj" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Konfirmasi Pengajuan Ulang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('Staff/laporan'); ?>" method="post" class="form-submit" enctype="multipart/form-data">
                <div class="modal-body text-center">
                    <strong>
                        <h4>Ajukan ulang laporan ?</h4>
                    </strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="lap_id_proker_ulang" name="id_proker">
                    <input type="hidden" name="ulang_lap">
                    <button type="submit" class="btn btn-primary">Ya</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endsection(); ?>

<?php section('scripts'); ?>
<script>
    function getEvaluasi(identifier){
      var button = $(identifier);
      var id_proker = button.data('id_proker');
      var proker = button.data('proker');
      var evaluasi = button.data('evaluasi');

      $('#eva_id_proker_upload').val(id_proker);
      $('#eva_proker_upload').val(proker);
      $('#evaluasi_upload').val(evaluasi);
    }

    function getLaporan(identifier){
      var button = $(identifier);
      var id_proker = button.data('id_proker');
      var proker = button.data('proker');
      var lpj = button.data('lpj');

      $('#lap_id_proker_upload').val(id_proker);
      $('#lap_proker_upload').val(proker);
      $('#laporan_upload').val(lpj);
    }

    function getHapusEva(identifier){
      var button = $(identifier);
      var id_proker = button.data('id_proker');

      $('#eva_id_proker_hapus').val(id_proker);
    }

    function getHapusLpj(identifier){
      var button = $(identifier);
      var id_proker = button.data('id_proker');

      $('#lap_id_proker_hapus').val(id_proker);
    }

    function getUlangLpj(identifier){
      var button = $(identifier);
      var id_proker = button.data('id_proker');

      $('#lap_id_proker_ulang').val(id_proker);
    }
</script>
<?php endsection(); ?>
<?php getview('template/core'); ?>