$(function(){
    let $tableUser = $("#tableUser")

    $tableUser.dataTable({
        sDom: "<'text-right mb-md'T>" + $.fn.dataTable.defaults.sDom,
        oTableTools: {
            sSwfPath: $tableUser.data('swf-path'),
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

})