<?php if ($title == "List-Agent") {
?>
    <script type="text/javascript">
        $(document).ready(function() {
            load_payment_list();

            function load_payment_list() {
                $('#table').DataTable({
                    responsive: {
                        details: {
                            type: 'column',
                            target: 'tr'
                        }
                    },
                    columnDefs: [{
                        className: 'control',
                        orderable: false,
                        targets: 0
                    }],
                    "order": [
                        [1, "desc"]
                    ],
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 10,
                    "paginationType": "full",
                    "lengthMenu": [
                        [10, 25, 50, 100],
                        [10, 25, 50, 100]
                    ],
                    "ajax": {
                        'type': 'POST',
                        'url': "<?= base_url('admin/get-agent-list') ?>"
                    },
                    "columns": [{
                            "data": 0
                        },
                        {
                            "data": 1
                        },
                        {
                            "data": 2
                        },
                        {
                            "data": 3
                        },
                        {
                            "data": 4
                        },
                        {
                            "data": 5
                        },
                        {
                            "data": 6
                        }
                    ]
                });
            }

            $(document).on('click', '.active_inactive_button', function() {
                var self = $(this);
                var table = self.attr('data-table');
                var updatefield = self.attr('data-updatefield');
                var wherefield = self.attr('data-wherefield');
                var status = self.attr('data-status');
                if (!confirm('Are you sure want to update?'))
                    return;
                self.attr('disabled', 'disabled');
                var data = {
                    'table_id': self.data('id'),
                    'status': status,
                    'table': table,
                    'updatefield': updatefield,
                    'wherefield': wherefield
                };
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('admin/active-inactive-agent') ?>",
                    data: data,
                    success: function(res) {
                        var res = $.parseJSON(res);
                        if (res.suceess) {
                            var title = 'Click to Active';
                            var class_ = 'active_inactive_button btn btn-xs btn-success';
                            var text = "Active";
                            var isactive = 1;
                            var class_badge = '';
                            var text_badge = '';
                            if (status == 1) {
                                title = 'Click To inActive';
                                class_ = 'active_inactive_button btn btn-xs btn-danger';
                                text = "inActive";
                                isactive = 0;
                                class_badge = 'badge badge-success badge-status-' + self.data('id');
                                text_badge = "Active";
                            }
                            if (status == 0) {
                                class_badge = 'badge badge-danger badge-status-' + self.data('id');
                                text_badge = "inActive";
                            }
                            $(".badge-status-" + self.data('id')).html(text_badge);
                            $(".badge-status-" + self.data('id')).removeClass().addClass(class_badge);
                            self.removeClass().addClass(class_);
                            self.attr({
                                'data-status': isactive,
                                'title': title
                            });
                            self.removeAttr('disabled');
                            self.html(text);
                        }
                    }
                });
            });
        });
    </script>
<?php } ?>


<?php if ($title == "List-Allocate-User") {
?>
    <script type="text/javascript">
        $(document).ready(function() {
            var rows_selected = [];
            var table = $('#example').DataTable({
                // responsive: {
                //     details: {
                //         type: 'column',
                //         target: 'tr'
                //     }
                // },
                // 'drawCallback': function(){
                //     $('input[type="checkbox"]').iCheck({
                //         checkboxClass: 'icheckbox_flat-blue'
                //     });
                // },
                'columnDefs': [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'width': '1%',
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        return '<input type="checkbox">';
                    }
                }],
                'order': [
                    [1, 'asc']
                ],
                'rowCallback': function(row, data, dataIndex) {
                    // Get row ID
                    var rowId = data[0];

                    // If row ID is in the list of selected row IDs
                    if ($.inArray(rowId, rows_selected) !== -1) {
                        $(row).find('input[type="checkbox"]').prop('checked', true);
                        $(row).addClass('selected');
                    }
                },
                "processing": true,
                "serverSide": true,
                "pageLength": 10,
                "paginationType": "full",
                "lengthMenu": [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                "ajax": {
                    'type': 'POST',
                    'url': "<?= base_url('admin/allocate-user-list/') . $id; ?>"
                },
                "columns": [
                    {
                        "data": 0
                    },
                    {
                        "data": 1
                    },
                    {
                        "data": 2
                    },
                    {
                        "data": 3
                    },
                    {
                        "data": 4
                    },
                    {
                        "data": 5
                    },
                    {
                        "data": 6
                    },
                    {
                        "data": 7
                    }
                ]
            });


            function updateDataTableSelectAllCtrl(table) {
                var $table = table.table().node();
                var $chkbox_all = $('tbody input[type="checkbox"]', $table);
                var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
                var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);

                // If none of the checkboxes are checked
                if ($chkbox_checked.length === 0) {
                    chkbox_select_all.checked = false;
                    if ('indeterminate' in chkbox_select_all) {
                        chkbox_select_all.indeterminate = false;
                    }

                    // If all of the checkboxes are checked
                } else if ($chkbox_checked.length === $chkbox_all.length) {
                    chkbox_select_all.checked = true;
                    if ('indeterminate' in chkbox_select_all) {
                        chkbox_select_all.indeterminate = false;
                    }

                    // If some of the checkboxes are checked
                } else {
                    chkbox_select_all.checked = true;
                    if ('indeterminate' in chkbox_select_all) {
                        chkbox_select_all.indeterminate = true;
                    }
                }
            }


            // Handle click on checkbox
            $('#example tbody').on('click', 'input[type="checkbox"]', function(e) {
                var $row = $(this).closest('tr');

                // Get row data
                var data = table.row($row).data();

                // Get row ID
                var rowId = data[0];

                // Determine whether row ID is in the list of selected row IDs
                var index = $.inArray(rowId, rows_selected);

                // If checkbox is checked and row ID is not in list of selected row IDs
                if (this.checked && index === -1) {
                    rows_selected.push(rowId);

                    // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
                } else if (!this.checked && index !== -1) {
                    rows_selected.splice(index, 1);
                }

                if (this.checked) {
                    $row.addClass('selected');
                } else {
                    $row.removeClass('selected');
                }

                // Update state of "Select all" control
                updateDataTableSelectAllCtrl(table);

                // Prevent click event from propagating to parent
                e.stopPropagation();
            });

            // Handle click on table cells with checkboxes
            $('#example').on('click', 'tbody td, thead th:first-child', function(e) {
                $(this).parent().find('input[type="checkbox"]').trigger('click');
            });

            // Handle click on "Select all" control
            $('thead input[name="select_all"]', table.table().container()).on('click', function(e) {
                if (this.checked) {
                    $('#example tbody input[type="checkbox"]:not(:checked)').trigger('click');
                } else {
                    $('#example tbody input[type="checkbox"]:checked').trigger('click');
                }

                // Prevent click event from propagating to parent
                e.stopPropagation();
            });

            // Handle table draw event
            table.on('draw', function() {
                // Update state of "Select all" control
                updateDataTableSelectAllCtrl(table);
            });

            // Handle form submission event
            $('#frm-example').on('submit', function(e) {
                var form = this;

                // Iterate over all selected checkboxes
                $.each(rows_selected, function(index, rowId) {
                    // Create a hidden element
                    $(form).append(
                        $('<input>')
                        .attr('type', 'hidden')
                        .attr('name', 'id[]')
                        .val(rowId)
                    );
                });
            });
            $(document).on('click', '.allocation_button', function() {
                var self = $(this);
                var table = self.attr('data-table');
                var updatefield = self.attr('data-updatefield');
                var wherefield = self.attr('data-wherefield');
                var status = self.attr('data-status');
                var ar = self.attr('data-ar');
                if (!confirm('Are you sure want to update?'))
                    return;
                self.attr('disabled', 'disabled');
                var data = {
                    'table_id': self.data('id'),
                    'status': status,
                    'table': table,
                    'updatefield': updatefield,
                    'wherefield': wherefield,
                    'ar': ar
                };
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('admin/change-allocation-status') ?>",
                    data: data,
                    success: function(res) {
                        var res = $.parseJSON(res);
                        if (res.suceess) {

                            var title = '';
                            var class_ = '';
                            var text = "";
                            var class_badge = '';
                            var text_badge = '';
                            if (res.ar == 1) {
                                title = 'Click to Allocate';
                                class_ = 'allocation_button btn btn-xs btn-success';
                                text = "Allocate";
                                class_badge = 'badge badge-danger badge-status-' + self.data('id');
                                text_badge = "Not Allocate";
                            }
                            if (res.ar == 0) {
                                title = 'Click To Remove';
                                class_ = 'allocation_button btn btn-xs btn-danger';
                                text = "Remove";
                                class_badge = 'badge badge-success badge-status-' + self.data('id');
                                text_badge = "Allocated";
                            }
                            $(".badge-status-" + self.data('id')).html(text_badge);
                            $(".badge-status-" + self.data('id')).removeClass().addClass(class_badge);
                            self.removeClass().addClass(class_);
                            self.attr({
                                'data-ar': res.ar,
                                'title': title
                            });
                            self.removeAttr('disabled');
                            self.html(text);
                        }
                    }
                });
            });
        });
    </script>
<?php } ?>



<?php if ($title == "Agent-History") {
?>
    <script type="text/javascript">
        $(document).ready(function() {
            load_payment_list();

            function load_payment_list() {
                $('#table').DataTable({
                    responsive: {
                        details: {
                            type: 'column',
                            target: 'tr'
                        }
                    },
                    columnDefs: [{
                        className: 'control',
                        orderable: false,
                        targets: 0
                    }],
                    "order": [
                        [1, "desc"]
                    ],
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 10,
                    "paginationType": "full",
                    "lengthMenu": [
                        [10, 25, 50, 100],
                        [10, 25, 50, 100]
                    ],
                    "ajax": {
                        'type': 'POST',
                        'url': "<?= base_url('admin/agent-history-list/').$id; ?>"
                    },
                    "columns": [{
                            "data": 0
                        },
                        {
                            "data": 1
                        },
                        {
                            "data": 2
                        }
                    ]
                });
            }           
        });
    </script>
<?php } ?>
