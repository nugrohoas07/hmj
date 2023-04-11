<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Staff') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Panitia</li>
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
                        <h3 class="card-title">Upload Kepanitiaan</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Program Kerja</th>
                                        <th>Ketua Pelaksana</th>
                                        <th>Panitia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $no = 1;
                                foreach ($proker as $row): 
                                $panitia = $row->panitia;
                                $ketua = $this->model_user->getUser($row->ketua)->nama; ?>
                                <tr>
                                <td><?= $no ?></td>
                                <td><?= $row->nama_proker ?></td>
                                <td><?= $ketua ?></td>
                                <td class="text-center"><?php if($panitia==null){ ?> <button title="Upload Panitia" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#upload" onclick="getUpload(this);" data-id_proker="<?= $row->id_proker ?>" data-proker="<?= $row->nama_proker ?>" data-panitia="<?= $row->panitia ?>" >Upload File</button>
                                <?php }else{?>
                                    <a href="<?= base_url('/upload/proker/'.$panitia) ?>" class="btn btn-success btn-xs" title="Download File"><i class="fas fa-download"></i></a>
                                    <?php if($row->status!="3"){ ?>
                                    <button title="Edit Panitia" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#upload" onclick="getUpload(this);" data-id_proker="<?= $row->id_proker ?>" data-proker="<?= $row->nama_proker ?>" data-panitia="<?= $row->panitia ?>" ><i class="fa fa-edit"></i></button>
                                    <button title="Hapus Panitia" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#hapus" onclick="getHapus(this);" data-id_proker="<?= $row->id_proker ?>"><i class="fa fa-trash"></i></button>
                                <?php }} ?></td>
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

<div class="modal fade" id="upload" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title">Upload File Panitia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('Staff/panitia'); ?>" method="post" class="form-submit" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="proker">Program Kerja</label>
                            <input type="text" class="form-control" id="proker_upload" name="proker" readonly>
                        </div>
                        <div class="form-group">
                            <label for="laporan">Panitia<small class="text-danger"> (format file png,jpg,jpeg,docx,pdf, maks 2MB)</small></label>
                            <div class="custom-file">
                                <input type="hidden" id="id_proker_upload" name="id_proker">
                                <input type="hidden" id="panitia_upload" name="old_panitia">
                                <input type="file" class="custom-file-input" name="panitia" data-validation="extension size" data-validation-min-size="1kb" data-validation-max-size="2M" data-validation-allowing="png,jpg,jpeg,docx,pdf">
                                <label class="custom-file-label" for="laporan">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="upload">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">Hapus Panitia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?= site_url('Staff/panitia'); ?>" method="post" class="form-submit" enctype="multipart/form-data">
                <div class="modal-body text-center">
                    <strong>
                        <h4>Apakah anda yakin ?</h4>
                    </strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_proker_hapus" name="id_proker">
                    <input type="hidden" name="hapus">
                    <button type="submit" class="btn btn-danger">Ya</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php endsection(); ?>
<?php section('scripts'); ?>
<script>
    function getUpload(identifier){
        var button = $(identifier);
        var id_proker = button.data('id_proker');
        var proker = button.data('proker');
        var panitia = button.data('panitia');

        $('#id_proker_upload').val(id_proker);
        $('#proker_upload').val(proker);
        $('#panitia_upload').val(panitia);
    }

    function getHapus(identifier){
        var button = $(identifier);
        var id_proker = button.data('id_proker');

        $('#id_proker_hapus').val(id_proker);
    }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>