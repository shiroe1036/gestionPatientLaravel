$(function () {
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
        }).done(function(dataM){
            $.ajax({
                dataType: 'json',
                url: '../../allMedoc',
                type: 'GET',
            }).done(function(dataMedoc){
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
                                <label class='control-label'>Médicament</label>
                                <div class='input-group mb-md'>
                                    <select class='form-control' name='medicament[]'>
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

})