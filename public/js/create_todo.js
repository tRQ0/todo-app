$(document).ready(function () {
    var table = '#todo-table';
    var form = '#add-todo-form';

    $(form).on('submit', function (event) {
        event.preventDefault();

        var url = $(this).attr('data-action');

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(this),
            dateType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                var row = '<tr id="' + response.id + '">';
                row += '<td>' + response.name + '</td>';
                row += '<td>' + response.category_name + '</td>';
                row += '<td>' + response.timestamp + '</td>';
                row += '</tr>';

                $(table).find('tbody').prepend(row);
                $(table).find('#' + response.id).append(
                    $("<td/>", {
                        class: 'text-center',
                    }).append(
                        $("<button/>", {
                            type: 'button',
                            id: 'remove',
                            class: 'btn btn-danger',
                        }).append(
                            "Delete"
                        )
                    )
                );
                var message = '<div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">';
                message += '<div class="d-flex">';
                message += '<div class="toast-body">';
                message += 'success';
                message += '</div> <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button> </div>';
                message += '</div>';
                console.log("todo task created");
            },
            error: function (response) {
                console.log("unable to create todo task :(");
            }
        });
    });
});
