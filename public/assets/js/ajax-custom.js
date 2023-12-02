$(document).ready(function () {
    // Attach a click event handler to the delete button
    $('.delete-tile').on('click', function () {
        var tileId = $(this).data('tile-id');

        // Confirm deletion (optional)
        if (confirm('Are you sure you want to delete this tile?')) {
            // Send an AJAX request to delete the tile
            $.ajax({
                type: 'DELETE',
                url: '/tiles.destroy/' + tileId,
               //Replace with your actual route
                data: {
                    "_token": "wSgP2tRZJrAV89AM3cm92WUyMY1hxlXHrb9b0IoP"
                },
                success: function (data) {
                    // Handle success, e.g., remove the row from the table
                    if (data.success) {
                        // Assuming you have a table with an ID 'tiles-table'
                        $('#tiles-table').DataTable().row($(this).closest('tr')).remove().draw();

                        // Show a success message
                        $('#success-message').removeClass('d-none').text(data.message);
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        }
    });
});
