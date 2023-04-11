<?php section('contents'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('Ketum') ?>">HMJ</a></li>
            <li class="breadcrumb-item active">Timeline</li>
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
              <h3 class="card-title">Daftar Program Kerja</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tgl.Pelaksanaan</th>
                    <th>Program Kerja</th>
                    <th>Ketua Pelaksana</th>
                    <th>Action</th>
                    <th>Status LPJ</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                foreach ($proker as $row): $status=$row->status;
                $status1 = $row->lpj_bendum; 
                $status2 = $row->lpj_sekum;
                $ketua = $this->model_user->getUser($row->ketua)->nama;
                 ?>
                <tr>
                <td><?= $no ?></td>
                <td><?= to_date($row->tgl_pelaksanaan)." s/d ".to_date($row->tgl_selesai) ?></td>
                <td><?= $row->nama_proker ?></td>
                <td><?= $ketua ?></td>
                <td class="text-center">
                  <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#detail" title="Lihat Detail" onclick="getDetail(this);" data-proker="<?= $row->nama_proker; ?>" data-ketua="<?= $ketua; ?>" data-tgl_pelaksanaan="<?= to_date($row->tgl_pelaksanaan); ?>" data-tgl_selesai="<?= to_date($row->tgl_selesai); ?>" data-panitia="<?= $row->panitia; ?>" data-status="<?= $row->status ?>" data-evaluasi="<?= $row->evaluasi; ?>" data-lpj="<?= $row->lpj; ?>" data-stat_sekum="<?= $row->lpj_sekum; ?>" data-stat_bendum="<?= $row->lpj_bendum; ?>"><i class="fa fa-eye"></i></button>
                  <?php if($status!="3"){ ?>
                  <button class="btn btn-primary btn-xs" title="Edit" data-toggle="modal" data-target="#edit" onclick="getEdit(this);" data-id_proker="<?= $row->id_proker ?>" data-proker="<?= $row->nama_proker; ?>" data-ketua="<?= $row->ketua; ?>" data-tgl_pelaksanaan="<?= $row->tgl_pelaksanaan; ?>" data-tgl_selesai="<?= $row->tgl_selesai; ?>" data-panitia="<?= $row->panitia; ?>" data-evaluasi="<?= $row->evaluasi; ?>" data-lpj="<?= $row->lpj; ?>"><i class="fas fa-edit"></i></button><?php }
                  if($status=="2"){ ?>
                  <button class="btn btn-success btn-xs" title="Selesai" data-toggle="modal" data-target="#selesai" onclick="getDone(this);" data-id_proker="<?= $row->id_proker ?>"><i class="fas fa-check-circle"></i></button><?php } ?>
                </td>
                <td><?php 
                if($status1!="1"||$status2!="1"){ echo "Belum Disetujui"; 
                }else{ echo "Sudah Disetujui"; }
                ?>
                </td>
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

<div class="modal fade" id="detail" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Detail Program Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <dl>
                  <dt>Program Kerja</dt>
                  <dd id="proker"></dd>
                  <dt>Tgl Pelaksanaan</dt>
                  <dd><span id="tgl_pelaksanaan"></span> s/d <span id="tgl_selesai"></span></dd>
                  <dt>Ketua Pelaksana</dt>
                  <dd id="ketua"></dd>
                  <dt>Panitia</dt>
                  <dd><a id="panitia"></a></dd>
                  <dt>Status</dt>
                  <dd><b id="status"></b></dd>
                  <dt>Evaluasi</dt>
                  <dd><a id="evaluasi"></a></dd>
                  <dt>LPJ</dt>
                  <dd><a id="lpj"></a></dd>
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
                <h5 class="modal-title">Edit Program Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('ketum/timeline'); ?>" method="post" class="form-submit" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="form-group">
                      <label for="namaproker">Program Kerja</label>
                      <input type="text" class="form-control" id="proker_edit" name="proker" placeholder="Nama Program Kerja" data-validation="required">
                  </div>
                  <div class="form-group">
                      <label>Ketua Pelaksana</label>
                      <select name="ketua" id="ketua_edit" class="form-control select2" style="width: 100%;" data-validation="required">
                      <option hidden disabled selected value> -- Pilih Ketua Pelaksana -- </option>
                      <?php foreach ($anggota as $row): ?>
                          <option value="<?= $row->username ?>" ><?= $row->nama ?></option>
                      <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="panitia">Panitia<small class="text-danger"> (format file png,jpg,jpeg,docx,pdf, maks 2MB)</small></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="panitia" data-validation="extension size" data-validation-min-size="1kb" data-validation-max-size="2M" data-validation-allowing="png,jpg,jpeg,docx,pdf">
                        <label class="custom-file-label" for="panitia">Choose file</label>
                    </div>
                  </div>
                  <div class="form-group">
                      <label>Tgl.Pelaksanaan</label>
                      <input autocomplete="off" type="text" id="tglmulai" name="tglproker" placeholder="Tanggal Mulai" class="form-control" id="tglmulai" data-toggle="datetimepicker" data-target="#tglmulai" data-validation="required"/>
                  </div>
                  <div class="form-group">
                      <label>Tgl.Selesai</label>
                      <input autocomplete="off" type="text" id="tglakhir" name="tglselesai" placeholder="Tanggal Selesai" class="form-control" id="tglakhir" data-toggle="datetimepicker" data-target="#tglakhir" data-validation="required"/>
                  </div>
                  <div class="form-group">
                    <label for="evaluasi">Evaluasi<small class="text-danger"> (format file png,jpg,jpeg,docx,pdf, maks 2MB)</small></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="evaluasi" data-validation="extension size" data-validation-min-size="1kb" data-validation-max-size="2M" data-validation-allowing="png,jpg,jpeg,docx,pdf">
                        <label class="custom-file-label" for="evaluasi">Choose file</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="lpj">LPJ<small class="text-danger"> (format file docx, maks 5MB)</small></label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="lpj" data-validation="extension size" data-validation-min-size="1kb" data-validation-max-size="5M" data-validation-allowing="docx">
                        <label class="custom-file-label" for="lpj">Choose file</label>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <input type="hidden" id="id_proker_edit" name="id_proker">
                  <input type="hidden" id="panitia_edit" name="old_panitia">
                  <input type="hidden" id="evaluasi_edit" name="old_evaluasi">
                  <input type="hidden" id="lpj_edit" name="old_lpj">
                  <input type="hidden" name="edit">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="selesai" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <h5 class="modal-title">Konfirmasi Proker Selesai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <strong>
          <h4>Apakah proker sudah selesai?</h4>
        </strong>
      </div>
      <form role="form" action="<?= site_url('Ketum/timeline') ?>" class="form-submit" method="post">
      <div class="modal-footer">
        <input type="hidden" name="status" value="3">
        <input type="hidden" id="id_proker_selesai" name="id_proker">
        <input type="hidden" name="selesai">
        <button type="submit" class="btn btn-success">Ya</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
    function getEdit(identifier){
      var button = $(identifier);
      var id_proker = button.data('id_proker');
      var proker = button.data('proker');
      var ketua = button.data('ketua');
      var tgl_pelaksanaan = button.data('tgl_pelaksanaan');
      var tgl_selesai = button.data('tgl_selesai');
      var panitia = button.data('panitia');
      var evaluasi = button.data('evaluasi');
      var lpj = button.data('lpj');

      $('#id_proker_edit').val(id_proker);
      $('#proker_edit').val(proker);
      $("#ketua_edit").val(ketua).trigger('change');
      $('#tglmulai').val(tgl_pelaksanaan);
      $('#tglakhir').val(tgl_selesai);
      $('#panitia_edit').val(panitia);
      $('#evaluasi_edit').val(evaluasi);
      $('#lpj_edit').val(lpj);
    }

    function getDetail(identifier){
        var button = $(identifier);
        var proker = button.data('proker');
        var ketua = button.data('ketua');
        var panitia = button.data('panitia');
        var status = button.data('status');
        var tgl_pelaksanaan = button.data('tgl_pelaksanaan');
        var tgl_selesai = button.data('tgl_selesai');
        var evaluasi = button.data('evaluasi');
        var lpj = button.data('lpj');
        var stat_sekum = button.data('stat_sekum');
        var stat_bendum = button.data('stat_bendum');
        var path_panitia = "<?= base_url('/upload/'); ?>"+"proker/"+panitia;
        var path_evaluasi = "<?= base_url('/upload/'); ?>"+"proker/"+evaluasi;
        var path_lpj = "<?= base_url('/upload/'); ?>"+"proker/"+lpj;

        $('#proker').html(proker);
        $('#ketua').html(ketua);
        $('#tgl_pelaksanaan').html(tgl_pelaksanaan);
        $('#tgl_selesai').html(tgl_selesai);

        if(panitia==""){ $('#panitia').html("Belum Upload").removeAttr("href").removeAttr("class"); }
        else{ $('#panitia').html("Lihat File").attr('href',path_panitia).attr('class',"btn btn-primary"); }

        if(evaluasi==""){ $('#evaluasi').html("Belum Upload").removeAttr("href").removeAttr("class"); }
        else{ $('#evaluasi').html("Lihat File").attr('href',path_evaluasi).attr('class',"btn btn-primary"); }

        if(lpj==""){ $('#lpj').html("Belum Upload").removeAttr("href").removeAttr("class"); }
        else{ if(stat_sekum!="1"||stat_bendum!="1"){ $('#lpj').html("Belum Disetujui").removeAttr("href").removeAttr("class"); }
              else{$('#lpj').html("Lihat File").attr('href',path_lpj).attr('class',"btn btn-primary"); } }

        if(status=="0"){ $('#status').html("Belum Disetujui").attr('class',"text-warning") }
        else if(status=="1"){ $('#status').html("Belum Dikerjakan").attr('class',"text-danger") }
        else if(status=="2"){ $('#status').html("Progress").attr('class',"text-primary") }
        else if(status=="3"){ $('#status').html("Selesai").attr('class',"text-success") }
        else if(status=="4"){ $('#status').html("Ditolak").attr('class',"text-danger") }
    }

    function getDone(identifier){
      var button = $(identifier);
      var id_proker = button.data('id_proker');
      $('#id_proker_selesai').val(id_proker);
    }   
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>