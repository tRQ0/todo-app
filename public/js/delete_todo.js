$(function () {
    $(document).on('click', '#remove', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var element = $(this);
        var elementId = element.closest("tr").attr("id");
        var url = window.location.origin + '/todo/' + elementId;
        jQuery.ajax({
            url: url,
            type: 'DELETE',
            data: { id: elementId },
            success: function (response) {
                element.closest("tr").remove();
                console.log("todo task successfully removed");
            },
            error: function (err) {
                console.log("unable to remove todo task");
            }
        });
    });
});