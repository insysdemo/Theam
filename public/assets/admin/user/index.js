var table = $("#users").DataTable({
    "fixedHeader": {
        header: true,
        footer: true
    },
    "pagingType": "full_numbers",
    "processing": true,
    "serverSide": true,
    "order": [0, 'desc'],
    "ajax": {
        "url": base_url + "/users/list",
        "dataType": "json",
        "type": "POST",
        data: function (data) {
            data._token = token;
        }
    },
    columnDefs: [{
        "targets": [0, 3],
        "orderable": false
    }],
    scrollX: true,
    scrollCollapse: true
});

function deleteModal(id) {
    alert('Are you want sure delete');
    $.ajax({
        url: base_url + "/users/" + id,
        type: 'DELETE',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content'),
        },
        success: function (response) {
            alert('delete successguly');
            table.ajax.reload();

        },
        error: function (response) {
            appendError(response.responseJSON.message);
        }
    });
}

