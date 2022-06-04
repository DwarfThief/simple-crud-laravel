$(document).ready(function ($) {
    /**
     * Loads CSRF token
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**
     * Listener for the status button
     */
    $('button[name="status-button"]').click(function () {
        var id = $(this).attr("id");

        $.ajax({
            method: "PUT",
            url: `customer/${id}/change-status`,
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                location.reload();
            }
        })
    });
});
