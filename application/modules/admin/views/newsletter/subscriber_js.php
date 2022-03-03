<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<?php if ($title == "Administration - View Newsletter") {
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
                    buttons: [
                        'csv', 'excel'
                    ],
                    "dom": 'Blfrtip',
                    "processing": true,
                    "serverSide": true,
                    "pageLength": 10,
                    "paginationType": "full",
                    // "lengthMenu": [
                    //     [10, 25, 50, 100],
                    //     [10, 25, 50, 100]
                    // ],

                    lengthMenu: [
[ 10, 25, 50, -1 ],
[ '10 rows', '25 rows', '50 rows', 'Show all' ]
],


                    "ajax": {
                        'type': 'POST',
                        'url': "<?= base_url('admin/get-newsletter-list') ?>"
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
                        }
                    ]
                });
            }           
        });
    </script>
<?php } ?>
