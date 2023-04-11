<?php section('contents'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('dpo/index') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Demisioner</li>
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
                            <h3 class="card-title">Demisioner</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tahun Kepengurusan</th>
                                        <th>Ketua Umum</th>
                                        <th>Pengurus</th>
                                        <th>Laporan Pertanggungjawaban</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = "1";
                                    foreach ($demis as $row) : ?>
                                        <?php if ($row->role == "Ketua Umum");
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $no ?></td>
                                            <td width="100"><?= $row->tahun+1 ?></td>
                                            <td><?= $row->nama; ?></td>
                                            <td class="text-center">
                                                <a href="<?= site_url('dpo/pengurus?tahun=' . $row->tahun); ?>" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i></a>
                                            </td>
                                             <td class="text-center">
                   <a href="<?= site_url('upload/lpj/' . $row->lpj); ?>" class="btn btn-primary btn-xs">Lihat File</a>
                  </td>
                                            <td class="text-center">
                                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit" onclick="fetchEdit(this)" data-username="<?= $row->username ?>" data-email="<?= $row->email ?>" data-no_hp="<?= $row->no_hp ?>"><i class="fa fa-edit"></i></button>
                                            </td>
                                        </tr>
                                    <?php
                                        $no++;

                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
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
                <h5 class="modal-title">Edit Biodata Pengurus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span style="color: whitesmoke;" aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="#" method="post" enctype="multipart/form-data" class="form-submit">
            <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Perbarui Email Anda" required>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No. Hp</label>
                            <input type="text" class="form-control" id="nohp_edit" name="no_hp" placeholder="Perbarui No. Hp Anda" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                    <input type="hidden" name="username" id="username_edit" required>
                    <input type="hidden" name="edit">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php endsection(); ?>
<?php section('scripts') ?>
<script>
    function fetchEdit(identifier) {
        var button = $(identifier);
        var username = button.data('username');
        var email = button.data('email');
        var no_hp = button.data('no_hp');

        $('#username_edit').val(username);
        $('#email').val(email);
        $('#nohp_edit').val(no_hp);
    }
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>