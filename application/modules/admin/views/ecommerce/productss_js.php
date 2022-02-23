<?php if ($title == "List-Products") {
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
                        'url': "<?= base_url('admin/get-product-list') ?>"
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
                        },
                        {
                            "data": 7
                        }
                    ]
                });
            }           
        });
    </script>
<?php } ?>
