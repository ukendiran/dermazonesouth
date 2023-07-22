
    <!-- Footer -->
    <footer class="footer bg-dark">
        <div class="container">
            <span class="text-white">Copyright &copy; <?php echo date('Y'); ?> Dermazone Dashboard</span>
        </div>
    </footer>

    <!-- Add jQuery via CDN link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Add Popper.js via CDN link -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    <!-- Add Bootstrap JS via CDN link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Add DataTables JS via CDN link -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- Add DataTables Buttons JS via CDN link -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTables with server-side processing and AJAX data source
            $('#user-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "get_users.php", // This PHP file will handle the server-side processing
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "membership_no"
                    },
                    {
                        "data": "first_name"
                    },
                    {
                        "data": "last_name"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": "mobile"
                    },
                    {
                        "data": null,
                        "orderable": false,
                        "searchable": false,
                        "render": function(data, type, row, meta) {
                            // Generate the "Edit" link with the user ID as a parameter
                            return '<a href="edit_user.php?id=' + row.id + '">Edit</a>';
                        }
                    }
                ],
                "lengthMenu": [5, 10, 20, 50], // Choose the number of records to display per page
                "pageLength": 10, // Default number of records to display per page
                "order": [
                    [0, "asc"]
                ], // Sort by the first column (ID) in ascending order
                "buttons": [
                    'copy', 'excel', 'csv', 'pdf'
                ], // Add export buttons
                "searching": true
            });
        });
    </script>
</body>

</html>