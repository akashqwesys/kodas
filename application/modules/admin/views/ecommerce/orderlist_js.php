<?php if ($title == "Orders-List") {
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
                        'url': "<?= base_url('admin/get-orders-list') ?>"
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
                    url: "<?= base_url('admin/active-inactive-attributes') ?>",
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
