var table = $("#permissions").DataTable({
    "fixedHeader": {
        header: true,
        footer: true 
    },
    "pagingType": "full_numbers",
    "processing": true,
    "serverSide": true,
    "order": [0, 'desc'],
    "ajax": {
        "url": base_url + "/permissions/list",
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

function createPermission() {
    $.ajax({
        url: base_url + "/permissions/create",
        type: 'get',
        success: function ($response) {
            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html("Add Permission");
            $("#commonModalContent").html($response);
        },
        error: function ($response) {
            appendError($response.responseJSON.message);

        }
    });
}


function editPermission(id) {
    alert('d');
    $.ajax({
        url: base_url + "/permissions/" + id + "/edit",
        type: 'get',
        success: function ($response) {
            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html("Edit Permission");
            $("#commonModalContent").html($response.html);
        },
        error: function ($response) {
            appendError($response.responseJSON.message);
        }
    });
}

function deleteModal(id) {
    alert('Are you want sure delete');
    $.ajax({
        url: base_url + "/permissions/" + id,
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
