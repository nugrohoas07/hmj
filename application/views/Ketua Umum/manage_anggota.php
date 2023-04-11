<?php section('contents'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('Ketum') ?>">HMJ</a></li>
            <li class="breadcrumb-item active">Manajemen Anggota</li>
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
              <h3 class="card-title">Manajemen Anggota Aktif</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Bidang</th>
                    <th>Divisi</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                foreach ($anggota as $row):
                $status = $row->status;
                //Jabatan 
                if($row->jabatan==""){ $jabatan = "Belum ditetapkan";
                }else{ $jabatan = $this->model_user->getJabatan($row->jabatan)->jabatan; }
                //Bidang
                if($row->bidang==""){ $bidang = "Belum ditetapkan";
                }else{ $bidang = $this->model_user->getBidang($row->bidang)->bidang; }
                //Divisi
                if($row->divisi==""){ $divisi = "Belum ditetapkan";
                }else{ $divisi = $this->model_user->getDivisi($row->divisi)->divisi; }
                ?>
                <tr>
                <td width="50"><?= $no ?></td>
                <td width="200"><?= $row->nama ?></td>
                <td width="135"><?= $jabatan ?></td>
                <td width="135"><?= $bidang ?></td>
                <td><?= $divisi ?></td>
                <td class="text-center" width="70"><?php if($status=="1"){echo "Aktif";}elseif($status=="2"){echo "Berhenti";} ?></td>
                <td class="text-center" width="50">
                  <button class="btn btn-primary btn-sm" title="Edit" data-toggle="modal" data-target="#edit" onclick="getEdit(this);" data-username="<?= $row->username ?>" data-nama="<?= $row->nama ?>" data-jabatan="<?= $row->jabatan ?>" data-bidang="<?= $row->bidang ?>" data-divisi="<?= $row->divisi ?>" data-status="<?= $row->status ?>"><i class="fas fa-edit"></i></button>
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

<div class="modal fade" id="edit" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Manage Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('Ketum/anggota') ?>" class="form-submit" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                  <div class="form-group">
                      <label for="nama">Nama</label>
                      <input type="text" class="form-control" id="nama" name="nama" disabled>
                  </div>
                  <div class="form-group">
                      <label>Jabatan</label>
                      <select name="jabatan" id="jabatan" class="form-control select2-nosearch" style="width: 100%;">
                      <option hidden disabled selected value> -- Pilih Jabatan -- </option>
                      <?php foreach ($list_jabatan as $row): ?>
                          <option value="<?= $row->id_jabatan ?>" ><?= $row->jabatan ?></option>
                      <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Bidang</label>
                      <select name="bidang" id="bidang" class="form-control select2-nosearch" style="width: 100%;">
                      <option hidden disabled selected value> -- Pilih Bidang -- </option>
                      <?php foreach ($list_bidang as $row): ?>
                          <option value="<?= $row->id_bidang ?>" ><?= $row->bidang ?></option>
                      <?php endforeach; ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Divisi</label>
                      <select name="divisi" id="divisi" class="form-control select2-nosearch" style="width: 100%;">
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Status</label>
                      <select name="status" id="status" class="form-control select2-nosearch" style="width: 100%;">
                          <option value="1" >Aktif</option>
                          <option value="2" >Berhenti</option>
                      </select>
                  </div>
              </div>
              <div class="modal-footer">
                  <input type="hidden" name="username" id="username">
                  <input type="hidden" name="edit">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
              </div>
            </form>
        </div>
    </div>
</div>
<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
var divisi,jabatan;
  function getEdit(identifier){
    var button = $(identifier);
    var username = button.data('username');
    var nama = button.data('nama');
    jabatan = button.data('jabatan');
    var bidang = button.data('bidang');
    var status = button.data('status');
    divisi = button.data('divisi');
    //var $option = $("<option hidden selected></option>").val(divisi).text("Eksternal");
    $("#divisi").empty();
    if(divisi==""){ $("#divisi").append($("<option disabled selected value></option>").text("Pilih Bidang Terlebih Dahulu")); }
    //else{ $("#divisi").append($option).trigger('change'); }
    $('#username').val(username);
    $('#nama').val(nama);
    $("#jabatan").val(jabatan).trigger('change');
    $("#bidang").val(bidang).trigger('change');
    $("#status").val(status).trigger('change');
    
  }

  $(document).ready(function(){
    $('#bidang').change(function(){
      var id_bidang=$('#bidang').val();
        if(id_bidang){
          $.ajax({
              url : "<?= site_url('Ketum/listDivisi/');?>"+id_bidang,
              dataType : 'json',
              // beforeSend:function () {
              //   $('#divisi').empty();
              //   $('#divisi')
              //   .append($("<option></option>")
              //     .attr("value","")
              //     .text("Loading...."));
              // },
              // processResults: function (data) {
              //   return {
              //     results: data
              //   };
              // },
              success: function(data){
                $('#divisi').empty();
                $('#divisi')
                .append($("<option></option>")
                  .attr("value","")
                  .text("-- Pilih Divisi --"));
                $.each(data, function(key, value) {
                  if(divisi==value.id_divisi){
                  $('#divisi')
                  .append($("<option selected></option>")
                    .attr("value",value.id_divisi)
                    .text(value.divisi));
                  }else{
                  $('#divisi')
                  .append($("<option></option>")
                    .attr("value",value.id_divisi)
                    .text(value.divisi)); }
                });
              }
          });
        }
    });
  });
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>