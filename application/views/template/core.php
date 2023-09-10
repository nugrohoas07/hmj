<!--
    Author: AdminLTE
    Author URL: https://adminlte.io
    License : AdminLTE is an open source project by [AdminLTE.io](https://adminlte.io) that is licensed under [MIT](https://opensource.org/licenses/MIT).
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>HMJ Teknik Elektro</title>
    <link rel="icon" href="<?php echo base_url('assets') ?>/img/logo hmj.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins') ?>/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins') ?>/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Ion Slider -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
    <!-- bootstrap slider -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/bootstrap-slider/css/bootstrap-slider.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/jquery-ui/jquery-ui.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/toastr/toastr.min.css">
    <style type="text/css">
     .form-error{
        font-size: small;
     	color: red;
     }
    </style>

    <?php render('head'); ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- HEADER -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="<?php echo site_url('Home/logout'); ?>">
                        Keluar
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /HEADER -->

        <!-- SIDEBAR -->
        <?php
        $idjabatan = $this->session->userdata('idjabatan');
        $jabatan = $this->session->userdata('jabatan');
        $status = $this->session->userdata('status');
        if($status=="0"||$jabatan==""){
            $this->load->view("Pendaftar/sidebar");
        }elseif($idjabatan==6&&$status=="3"){ 
            $this->load->view("DPO/sidebar");
            
        }else{
            $this->load->view($jabatan . "/sidebar");
        }
        ?>
        <!-- /SIDEBAR -->

        <!-- CONTENT -->
        <?php render('contents'); ?>
        <!-- /CONTENT -->

        <!-- FOOTER -->
        <footer class="main-footer text-center">
            <strong>Copyright &copy; <a href="<?=base_url()?>">HMJ TEKNIK ELEKTRO FT UM 2020-<?= date('Y'); ?></a>
            <!--<strong class="float-right">-->
                Versi 1.0</strong>
        </footer>
        <!-- /FOOTER -->

    </div>
    <!-- /wrapper -->
    <!-- jQuery -->
    <script src="<?php echo base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('assets') ?>/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Ion Slider -->
    <script src="<?php echo base_url('assets') ?>/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
    <!-- Bootstrap slider -->
    <script src="<?php echo base_url('assets') ?>/plugins/bootstrap-slider/bootstrap-slider.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url('assets') ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="<?php echo base_url('assets') ?>/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url('assets') ?>/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url('assets') ?>/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url('assets') ?>/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url('assets') ?>/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url('assets') ?>/plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?php echo base_url('assets') ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?php echo base_url('assets') ?>/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo base_url('assets') ?>/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets') ?>/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url('assets') ?>/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url('assets') ?>/dist/js/demo.js"></script>
    <!--form validation-->
    <script src="<?php echo base_url('assets') ?>/dist/js/jquery.form-validator.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="<?php echo base_url('assets') ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    <!-- Menampilkan Nama Upload File -->
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
    <!-- DataTables -->
    <script src="<?php echo base_url('assets/plugins') ?>/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets/plugins') ?>/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url('assets/plugins') ?>/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url('assets/plugins') ?>/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url('assets') ?>/plugins/toastr/toastr.min.js"></script>
    <script>
        $(function() {
            $('.select2').select2();
            $('.select2-nosearch').select2({
                minimumResultsForSearch: Infinity
            });
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
            $("#example3").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

            $('#default-date-picker').datetimepicker({
                format: 'L',
                format: 'YYYY-MM-DD',
                useCurrent: true
            });

            $('#tglmulai').datetimepicker({
                format: 'L',
                format: 'YYYY-MM-DD'
            });
            $('#tglakhir').datetimepicker({
                format: 'L',
                format: 'YYYY-MM-DD',
                useCurrent: false
            });
            $("#tglmulai").on("change.datetimepicker", function (e) {
                $('#tglakhir').datetimepicker('minDate', e.date);
            });
            $("#tglakhir").on("change.datetimepicker", function (e) {
                $('#tglmulai').datetimepicker('maxDate', e.date);
            });
            $('.form-submit').one('submit', function() {
                $(this).find('button[type="submit"]').attr('disabled','disabled');
            });
        
        });
        
        function deleteConfirm(url) {
            $('#btn-delete').attr('href', url);
            $('#deleteModal').modal();
        }

        $(document).ready(function(){
                $( "#ketua" ).autocomplete({
                source: "<?php echo site_url('ketum/ketua_autocomplete/?');?>"
                });
        });
        
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

    <?php render('scripts'); ?>

</body>

</html>