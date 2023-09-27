<?php section('contents'); ?>
<?php
    $selectedKrit = array();
    foreach ($myKriteria as $dipilih) {
        $selectedKrit[$dipilih->id_kriteria] = $dipilih->bobot;
    }
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= site_url('Pendaftar') ?>">HMJ</a></li>
                        <li class="breadcrumb-item active">Kriteria dan Bobot</li>
                        <li class="breadcrumb-item">Perhitungan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Menentukan Kriteria</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Menentukan Bobot</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>List Kriteria</label>
                                                <select class="duallistbox" multiple="multiple">
                                                    <?php foreach ($kriteria as $krit) : ?>
                                                        <option value="<?= $krit->id ?>" <?php if(isset($selectedKrit[$krit->id])) echo "selected" ?>><?= $krit->kriteria ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                    <form role="form" action="<?= site_url('pendaftar/input_bobot') ?>" class="form-submit" method="post">
                                        <div id="dynamic-form"></div>
                                        <input type="hidden" name="simpan">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php endsection(); ?>

<?php section('scripts'); ?>
<script>
    $(document).ready(function() {
        var kriteria = {};
        var isUpdatingFields = false; // Flag to prevent multiple updates
        <?php foreach ($kriteria as $data) { ?>
            kriteria[<?= $data->id; ?>] = '<?= $data->kriteria; ?>';
        <?php } ?>

        $('.duallistbox').bootstrapDualListbox()

        $('.range_5').ionRangeSlider({
            min: 0,
            max: 5,
            type: 'single',
            step: 1,
            prettify: false,
            grid: true,
            grid_num: 5,
            skin: 'round'
        })

        $('.duallistbox').change(function() {
            var selectedValues = $('.duallistbox').val()

            $('#dynamic-form').empty();

            selectedValues.forEach(function(value, index) {

                $.ajax({
                    url: 'get_bobot_usr/' + value,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var labelText = kriteria[value] + " (%)";
                        var placeholderText = 'Nilai ' + kriteria[value];

                        var formGroup = $('<div>').addClass('form-group');

                        var labelElement = $('<label>').text(labelText);

                        var inputHidden = $('<input>').attr('type', 'hidden').attr('name', 'id_kriteria[]').val(value)

                        var inputElement = $('<input>')
                            .attr('type', 'text')
                            .addClass('form-control')
                            .attr('name', 'bobot[]')
                            .attr('placeholder', placeholderText)
                            .attr('data-validation', 'required number totalSum100')
                            .attr('data-validation-allowing', 'range[1;100]');

                        inputElement.val(data.bobot_value);

                        formGroup.append(labelElement);
                        formGroup.append(inputHidden);
                        formGroup.append(inputElement);

                        $('#dynamic-form').append(formGroup);
                    },
                    error: function() {
                        console.log('Fetching data error')
                    }
                })
            })
        });

        $.formUtils.addValidator({
            name: 'totalSum100',
            validatorFunction: function(value, $el, config, language, $form) {
                var $fields = $form.find('[data-validation*="totalSum100"]');
                var sum = 0;

                $fields.each(function() {
                    var fieldValue = parseFloat($(this).val()) || 0;
                    sum += fieldValue;
                });

                return sum === 100;
            },
            errorMessage: 'Total bobot harus 100%',
            errorMessageKey: 'badTotalSum100'
        })
    });
</script>
<?php endsection(); ?>
<?php getview('template/core') ?>