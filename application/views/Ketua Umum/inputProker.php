<head>
<link rel="stylesheet" href="<?php echo base_url('assets') ?>/jquery-ui/jquery-ui.css">
</head>
<form action="<?php echo site_url('ketum/proker') ?>" method="POST" enctype="multipart/form-data">
Nama Proker : <input type="text" name="namaproker" placeholder="Nama Proker"></input><br/>
Ketua Proker : <input type="text" name="ketua" id="ketua" placeholder="Ketua Proker"></input><br/>
Panitia : <input type="file" name="panitia" placeholder="Panitia Proker" id="uploadImage" onchange="PreviewImage();"></input><br/>
<img id="uploadPreview" style="width: 100px; height: 100px;" /><br/>
Tgl Pelaksanaan : <input type="date" name="tglproker" placeholder="Tgl Pelaksanaan"></input><br/>
Tgl Selesai : <input type="date" name="tglselesai" placeholder="Tgl Pelaksanaan"></input><br/>
<input type="submit" name="tambah" ></input>
</form>
<script src="<?php echo base_url('assets') ?>/jquery/jquery.min.js"></script>
<script src="<?php echo base_url('assets') ?>/jquery-ui/jquery-ui.min.js"></script>
<script type="text/javascript">

    function PreviewImage() {
        var oFReader = new FileReader();
        

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
    };

    $(document).ready(function(){
            $( "#ketua" ).autocomplete({
              source: "<?php echo site_url('ketum/ketua_autocomplete/?');?>"
            });
        });

</script>