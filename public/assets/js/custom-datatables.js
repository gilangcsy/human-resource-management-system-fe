function datatableWithRange(datePosition, columnSelection) {
    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            let min = $('#min').val()
            let max = $('#max').val()
            let date = new Date(data[datePosition]);

            let minDate = new Date(min)
            let maxDate = new Date(max)

            if (min != '' && max == '') {
                if (minDate.getFullYear() <= date.getFullYear()) {
                    if (minDate.getMonth() <= date.getMonth()) {
                        if (minDate.getMonth() == date.getMonth()) {
                            console.log(minDate.getDate())
                            if (minDate.getDate() <= date.getDate()) {
                                return true
                            }
                            return false
                        }
                        return true
                    }
                    return false
                }
                return false
            } else if (min != '' && max != '') {
                if (minDate.getFullYear() <= date.getFullYear() && date.getFullYear() <= maxDate.getFullYear()) {
                    if (minDate.getMonth() <= date.getMonth() && date.getMonth() <= maxDate.getMonth()) {
                        if (minDate.getMonth() == date.getMonth() && date.getMonth() == maxDate.getMonth()) {
                            if (minDate.getDate() <= date.getDate() && date.getDate() <= maxDate.getDate()) {
                                return true
                            }
                            return false
                        } else if (minDate.getMonth() == date.getMonth() && date.getMonth() < maxDate.getMonth()) {
                            if (minDate.getDate() <= date.getDate()) {
                                return true
                            }
                            return false
                        } else if (minDate.getMonth() < date.getMonth() && date.getMonth() == maxDate.getMonth()) {
                            if (date.getDate() <= maxDate.getDate()) {
                                return true
                            }
                            return false
                        }
                        return true
                    }
                    return false
                }
                return false
            } else if (min == '' && max != '') {
                if (date.getFullYear() <= maxDate.getFullYear()) {
                    if (date.getMonth() <= maxDate.getMonth()) {
                        if (date.getMonth() == maxDate.getMonth()) {
                            if (date.getDate() <= maxDate.getDate()) {
                                return true
                            }
                            return false
                        }
                        return true
                    }
                    return false
                }
            }
            return true
        }
    );

    $(document).ready(function () {
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'MMMM Do YYYY'
        })
        maxDate = new DateTime($('#max'), {
            format: 'MMMM Do YYYY'
        })

        // DataTables initialisation
        var table = $('#tableTest').DataTable({
            initComplete: function () {
                this.api()
                    .columns()
                    .every(function () {
                        var column = this;
                        var select = $('<select class="form form-control"><option value="">-Select-</option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>');
                            });
                    });
            },
            lengthChange: false,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: columnSelection
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: columnSelection
                    }
                },
                'colvis'
            ]
        })

        // Refilter the table
        $('#min, #max').on('change', function () {
            console.log()
            table.draw()
        });
    });
}
