<!--
    Author: AdminLTE
    Author URL: https://adminlte.io
    License : AdminLTE is an open source project by [AdminLTE.io](https://adminlte.io) that is licensed under [MIT](https://opensource.org/licenses/MIT).
-->

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HMJ TE FT UM</title>
    <link rel="icon" href="assets/img/logo hmj.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/fontawesome.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.18/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/flat/blue.css">
    <script src="http://elektro.um.ac.id/sisinta/assets/dist/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/toastr/toastr.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style type="text/css">
    
    /*.tembus{*/
    /*    background-color: rgb(255, 255, 255, 0.4);*/
    /*}*/
    
    /*.placeholder::-webkit-input-placeholder {*/
    /*        color: white;*/
    /*    }*/
        
    /*.border {*/
    /*  border-style: hidden;*/
    /*  border-radius: 17px;*/
    /*}*/
  </style>
</head>

<!-- <body>  height: 100%;-->

<body style="background-image:url(assets/img/BG.png);  background-repeat: no-repeat; background-position: center; background-size: cover;" class="hold-transition login-page">
    <div class="login-box mb-5">

        <div class="login-logo mb-1">
            <div class="rd-navbar">
                <nav class="rd-navbar">
                    <!--/.login-logo -->
                    <div style="background-color: rgb(56, 107, 237, 0.5)" class="login-box-body ">
                        <!--
                        <img src="assets/img/logo hmj.png" style="width: 25%; border: 0;" alt=" " />
                        <b style="color:#fff">HMJ TE FT UM</b>
                        
                        <!-- Divider ->
                        <hr class="sidebar-divider">
                        -->
                        <p class="login-box-msg"><b style="color: #fff">Silahkan Masuk</b></p>
                        <form action="<?php echo site_url('login'); ?>" method="post">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control tembus placeholder" placeholder="NIM" name="username" >
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" class="form-control tembus placeholder" placeholder="Password" name="password" >
                            </div>
                            <!--<div class="form-group row">-->
                                <!-- mb-3 mb-sm-0 -->
                            <!--    <div class="col-sm-6 "><label><!?= $cap_img ?></label></div>-->
                            <!--    <div class="col-sm-6"><input type="text" class="form-control tembus placeholder" id="Captcha" name="userCaptcha" placeholder="Masukkan Hasil">-->
                            <!--        <small style="color:#FFF; font-size:small"><?= form_error('userCaptcha'); ?></small>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="form-group">
                                <div class="col-xs-7">
                                </div>
                                <!-- /.col -->
                                <div class="col-xs-5">
                                    <input type="hidden" name="masuk">
                                    <button type="submit" value="Login" class="btn btn-primary btn-block btn-flat"><b style="color:#FFF">Masuk</b></button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                    <!-- /.login-box-body -->
                </nav>
            </div>
        </div>
    </div>
    <!-- /.login-box -->
    <!-- jQuery 3 -->
    <script src="http://elektro.um.ac.id/sisinta/assets/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <!--form validation-->
    <script src="<?php echo base_url('assets') ?>/dist/js/jquery.form-validator.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
    <script>
        $.validate({
            lang: 'en',
            modules: 'sanitize, file, security, logic'
        });
        // toastr
        <?php if ($this->session->flashdata('success')) { ?>
            toastr.success("<?php echo $this->session->flashdata('success'); ?>");
        <?php } else if ($this->session->flashdata('error')) { ?>
            toastr.error("<?php echo $this->session->flashdata('error'); ?>");
        <?php } else if ($this->session->flashdata('warning')) { ?>
            toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
        <?php } else if ($this->session->flashdata('info')) { ?>
            toastr.info("<?php echo $this->session->flashdata('info'); ?>");
        <?php } ?>
    </script>
    <!-- <script src="assets/dist/js/sweetalert.min.js"></script> -->
</body>

</html>