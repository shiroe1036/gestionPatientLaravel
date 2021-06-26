$(function(){
    let $tableArchive = $("#tableArchive"), $tableDossier = $("#tableDossier");

    if($tableArchive){
        $tableArchive.dataTable({
            sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
            oTableTools: {
                sSwfPath: $tableArchive.data('swf-path'),
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
    }

    if($tableDossier){
        $tableDossier.dataTable({
            sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
            oTableTools: {
                sSwfPath: $tableDossier.data('swf-path'),
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
    }

})