var table = $("#roles").DataTable({
    "fixedHeader": {
        header: true,
        footer: true
    },
    "pagingType": "full_numbers",
    "processing": true,
    "serverSide": true,
    "order": [0, 'desc'],
    "ajax": {
        "url": base_url + "/roles/list",
        "dataType": "json",
        "type": "POST",
        data: function (data) {
            data._token = token;
        }
    },
    columnDefs: [{
        "targets": [0, 2],
        "orderable": false
    }],
    scrollX: true,
    scrollCollapse: true
});


function createRole() {
    $.ajax({
        url: base_url + "/roles/create",
        type: 'get',
        success: function (response) {
            console.log(response);
            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html("Create Role");
            $("#commonModalContent").html(response.html);
        },
        error: function ($response) {
            appendError($response.responseJSON.message);

        }
    });
}


function editRole(id) {
    $.ajax({
        url: base_url + "/roles/" + id + "/edit",
        type: 'get',
        success: function (response) {
            console.log(response);
            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html("Edit Role");
            $("#commonModalContent").html(response.html);

        },
        error: function (response) {
            appendError(response.responseJSON.message);
        }
    });
}
function deleteModal(id) {
    alert('Are you want sure delete');
    $.ajax({
        url: base_url + "/roles/" + id,
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