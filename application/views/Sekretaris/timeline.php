<?php section('contents'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('Sekretaris') ?>">HMJ</a></li>
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
                  </tr>
                </thead>
                <tbody>
                <?php 
                $no = 1;
                foreach ($proker as $row):
                $ketua = $this->model_user->getUser($row->ketua)->nama; ?>
                <tr>
                <td><?= $no ?></td>
                <td><?= to_date($row->tgl_pelaksanaan)." s/d ".to_date($row->tgl_selesai) ?></td>
                <td><?= $row->nama_proker ?></td>
                <td><?= $ketua ?></td>
                <td>
                  <button class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#detail" title="Lihat Detail" onclick="getDetail(this);" data-proker="<?= $row->nama_proker; ?>" data-ketua="<?= $ketua; ?>" data-tgl_pelaksanaan="<?= to_date($row->tgl_pelaksanaan); ?>" data-tgl_selesai="<?= to_date($row->tgl_selesai); ?>" data-panitia="<?= $row->panitia; ?>" data-status="<?= $row->status ?>" data-evaluasi="<?= $row->evaluasi; ?>" data-lpj="<?= $row->lpj; ?>" data-stat_sekum="<?= $row->lpj_sekum; ?>" data-stat_bendum="<?= $row->lpj_bendum; ?>"><i class="fa fa-eye"></i></button>
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
<?php endsection(); ?>

<?php section('scripts'); ?>
<script>
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
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>