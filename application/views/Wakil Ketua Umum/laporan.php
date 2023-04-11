<?php section('contents'); ?>
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?= site_url('Wakahim') ?>">HMJ</a></li>
            <li class="breadcrumb-item active">Laporan Kegiatan</li>
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
              <h3 class="card-title">Laporan Akhir Kegiatan</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Program Kerja</th>
                    <th>Laporan Kegiatan</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $no = 1;
                    foreach ($proker as $row) :
                    $status = $row->lpj_kadiv;
                    $status1 = $row->lpj_sekum;
                    $status2 = $row->lpj_bendum;
                    ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $row->nama_proker ?></td>
                      <td class="text-center"><?php
                      if($row->lpj==""){ echo "Belum Upload";
                      }else{?> <a href="<?= base_url('/upload/proker/'.$row->lpj) ?>" class="btn btn-primary btn-sm">Lihat File</a>
                      <?php }?></td>
                      <td class="text-center"><?php
                      if($row->lpj==""){ echo "Belum Upload";
                      }else{
                        if($status1=="0"){echo "Belum Disetujui Sekretaris";
                        }elseif($status2=="0"){echo "Belum Disetujui Bendahara";
                        }elseif($status1=="2"){echo "Ditolak Sekretaris";
                        }elseif($status2=="2"){echo "Ditolak Bendahara";
                        }elseif($status1=="1" && $status2=="1" && $status=="0"){echo "Belum Disetujui Ketua Divisi";
                        }elseif($status=="1"){echo "Masuk ke LPJ";
                        }elseif($status=="2") {echo "Ditolak Ketua Divisi";}}
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
<?php endsection(); ?>
<?php getview('template/core') ?>