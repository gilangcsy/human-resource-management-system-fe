/* ============================================================
 * DataTables
 * Generate advanced tables with sorting, export options using
 * jQuery DataTables plugin
 * For DEMO purposes only. Extract what you need.
 * ============================================================ */
(function($) {

    'use strict';

    var responsiveHelper = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone: 480
    };

    // Initialize datatable showing a search box at the top right corner
    var initTableWithSearch = function() {
        var table = $('#tableWithSearch');

        table.dataTable({
		"lengthChange": false,
            "dom": "<'row'<'col-sm-12 col-md-6 justify-content-md-end'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5 justify-content-md-end'i><'col-sm-12 col-md-7'p>>"
        });

        // search box for table
        // $('#search-table').keyup(function() {
        //     table.fnFilter($(this).val());
        // });
    }

    var initTableDashboard = function() {
        let tables = $('.table-dashboard');

        tables.dataTable({
		"lengthChange": false,
            "dom": "<'row'<'col-sm-12 col-md-6 justify-content-md-end'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5 justify-content-md-end'i><'col-sm-12 col-md-7'p>>",
            "iDisplayLength": 5,
            "scrollCollapse": true,
            "autoWidth": true
        });
    }

    // Initialize datatable showing a search box at the top right corner
    var initTableWithSearch2 = function() {
        var table = $('#tableWithSearch2');

        // var settings = {
        //     "sDom": "<t><'row'<p i>>",
        //     "destroy": true,
        //     "scrollCollapse": true,
        //     "oLanguage": {
        //         "sLengthMenu": "_MENU_ ",
        //         "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
        //     },
        //     "iDisplayLength": 5
        // };

        var settings = {
            "dom": "<'row'<'col-sm-12 col-md-6 justify-content-md-end'l><'col-sm-12 col-md-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5 justify-content-md-end'i><'col-sm-12 col-md-7'p>>",
            "autoWidth": false
        };

        table.dataTable(settings);

        // search box for table
        $('#search-table2').keyup(function() {
            table.fnFilter($(this).val());
        });
    }

    // Initialize datatable with ability to add rows dynamically
    var initTableWithDynamicRows = function() {
        var table = $('#tableWithDynamicRows');


        var settings = {
            "sDom": "<t><'row'<p i>>",
            "destroy": true,
            "scrollCollapse": true,
            "oLanguage": {
                "sLengthMenu": "_MENU_ ",
                "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
            },
            "iDisplayLength": 5
        };


        table.dataTable(settings);

        $('#show-modal').click(function() {
            $('#addNewAppModal').modal('show');
        });

        $('#add-app').click(function() {
            table.dataTable().fnAddData([
                $("#appName").val(),
                $("#appDescription").val(),
                $("#appPrice").val(),
                $("#appNotes").val()
            ]);
            $('#addNewAppModal').modal('hide');

        });
    }

    // Initialize datatable showing export options
    var initTableWithExportOptions = function() {
        var table = $('#tableWithExportOptions');


        var settings = {
            "sDom": "<'exportOptions'T><'table-responsive sm-m-b-15't><'row'<p i>>",
            "destroy": true,
            "scrollCollapse": true,
            "oLanguage": {
                "sLengthMenu": "_MENU_ ",
                "sInfo": "Showing <b>_START_ to _END_</b> of _TOTAL_ entries"
            },
            "iDisplayLength": 5,
            "oTableTools": {
                "sSwfPath": "assets/plugins/jquery-datatable/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
                "aButtons": [{
                    "sExtends": "csv",
                    "sButtonText": "<i class='pg-grid'></i>",
                }, {
                    "sExtends": "xls",
                    "sButtonText": "<i class='fa fa-file-excel-o'></i>",
                }, {
                    "sExtends": "pdf",
                    "sButtonText": "<i class='fa fa-file-pdf-o'></i>",
                }, {
                    "sExtends": "copy",
                    "sButtonText": "<i class='fa fa-copy'></i>",
                }]
            },
            fnDrawCallback: function(oSettings) {
                $('.export-options-container').append($('.exportOptions'));

                $('#ToolTables_tableWithExportOptions_0').tooltip({
                    title: 'Export as CSV',
                    container: 'body'
                });

                $('#ToolTables_tableWithExportOptions_1').tooltip({
                    title: 'Export as Excel',
                    container: 'body'
                });

                $('#ToolTables_tableWithExportOptions_2').tooltip({
                    title: 'Export as PDF',
                    container: 'body'
                });

                $('#ToolTables_tableWithExportOptions_3').tooltip({
                    title: 'Copy data',
                    container: 'body'
                });
            }
        };


        table.dataTable(settings);

    }

    // Initialize datatable showing a search box at the top right corner and date range filter
    

    initTableWithSearch();
    initTableWithSearch2();
    initTableWithDynamicRows();
    initTableWithExportOptions();
    initTableDashboard();

})(window.jQuery);
