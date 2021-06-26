$(function () {
    let $tableRadio = $("#tableRadio"), $tableScan = $("#tableScan"), $tableTraite = $("#tableTraitement");

    $tableRadio.dataTable({
        sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
        oTableTools: {
            sSwfPath: $tableRadio.data('swf-path'),
            aButtons: [
                {
                    sExtends: 'pdf',
                    sButtonText: 'PDF'
                },
                {
                    sExtends: 'csv',
                    sButtonText: 'CSV'
                },
                {
                    sExtends: 'xls',
                    sButtonText: 'Excel'
                },
                {
                    sExtends: 'print',
                    sButtonText: 'Print',
                    sInfo: 'Please press CTR+P to print or ESC to quit'
                }
            ]
        }
    });

    $tableScan.dataTable({
        sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
        oTableTools: {
            sSwfPath: $tableScan.data('swf-path'),
            aButtons: [
                {
                    sExtends: 'pdf',
                    sButtonText: 'PDF'
                },
                {
                    sExtends: 'csv',
                    sButtonText: 'CSV'
                },
                {
                    sExtends: 'xls',
                    sButtonText: 'Excel'
                },
                {
                    sExtends: 'print',
                    sButtonText: 'Print',
                    sInfo: 'Please press CTR+P to print or ESC to quit'
                }
            ]
        }
    });

    $tableTraite.dataTable({
        sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
        oTableTools: {
            sSwfPath: $tableTraite.data('swf-path'),
            aButtons: [
                {
                    sExtends: 'pdf',
                    sButtonText: 'PDF'
                },
                {
                    sExtends: 'csv',
                    sButtonText: 'CSV'
                },
                {
                    sExtends: 'xls',
                    sButtonText: 'Excel'
                },
                {
                    sExtends: 'print',
                    sButtonText: 'Print',
                    sInfo: 'Please press CTR+P to print or ESC to quit'
                }
            ]
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".addInput").on('click', function () {

        $.ajax({
            dataType: 'json',
            url: '../../allMaladie',
            type: 'GET',
        }).done(function (dataM) {
            $.ajax({
                dataType: 'json',
                url: '../../allMedoc',
                type: 'GET',
            }).done(function (dataMedoc) {
                let htmlMaladie = '', htmlMedoc = '';

                dataM.forEach(item => {
                    htmlMaladie += `<option value='${item.id}'>${item.nomMaladie}</option>`
                });

                dataMedoc.forEach(item => {
                    htmlMedoc += `<option value='${item.id}'>${item.nomMedicament}</option>`
                });

                $(".traitement").append(`
                    <div class='added'>
                        <div class='col-sm-6'>
                            <div class='form-group'>
                                <label class='control-label'>Maladie</label>
                                <select class='form-control' name='maladie[]'>
                                    <option value=''>Choisir la maladie</option>
                                    ${htmlMaladie}
                                </select>
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-group'>
                                <label class='control-label'>Médicament<span class='required'>*</span></label>
                                <div class='input-group mb-md'>
                                    <select class='form-control' name='medicament[]' required>
                                        <option value=''>Choisir le médicament</option>
                                        ${htmlMedoc}
                                    </select>
                                    <span class='input-group-addon btn-danger removeInput'>X</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                removeInput('.removeInput');
            })
        });


        function removeInput(input) {
            $(input).on('click', function () {
                $(this).parent('div').parent('div').parent('div').parent('div').remove()
            });
        }

    });

    $("input:radio[name='etatPatient']").on('change', function () {
        let etat = $(this).val();

        if (etat == 2) {
            if ($(".appendedEtatUrgence").is(":visible")) {
                $(".appendedEtatUrgence").remove();
            }

            if ($(".appendedDeces").is(':visible')) {
                $(".appendedDeces").remove();
            }

            $(".motifSortieHopitale").append(`
                <div class="appendedEtatHopitale">
                    <label class="control-label">Motif sortie d'hôpitale</label>
                    <input type="text" class="form-control" name="motifSortieHopitale" required>
                </div>&nbsp;
            `);
        } else if (etat == 3) {
            if ($(".appendedEtatHopitale").is(":visible")) {
                $(".appendedEtatHopitale").remove();
            }

            if ($(".appendedDeces").is(':visible')) {
                $(".appendedDeces").remove();
            }

            $(".motifSortieUrgence").append(`
                <div class='appendedEtatUrgence'>
                    <label class="control-label">Motif de sortie d'urgence</label>
                    <input type='text' class="form-control" name="motifSortieUrgence" required>
                </div>&nbsp;
            `);
        } else if (etat == 4) {
            if ($(".appendedEtatHopitale").is(":visible")) {
                $(".appendedEtatHopitale").remove();
            }

            if ($(".appendedEtatUrgence").is(":visible")) {
                $(".appendedEtatUrgence").remove();
            }

            $(".motifDeces").append(`
                <div class='appendedDeces'>
                    <label class='control-label'>Motif de décés</label>
                    <input type="text" class='form-control' name="motifDeces" required>
                </div>&nbsp;
            `);
        }
    })


    if ($(".print").is(":visible")) {
        $(".print").on("click", function () {
            $('#printable').printThis({
                importCSS: true,
                importStyle: false,         // import style tags
                printContainer: true,
            });
        });
    }
})