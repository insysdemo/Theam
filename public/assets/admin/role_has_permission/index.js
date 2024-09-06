var table = $("#roleHasPermission").DataTable({
    "fixedHeader": {
        header: true,
        footer: true 
    },
    "pagingType": "full_numbers",
    "processing": true,
    "serverSide": true,
    "order": [0, 'desc'],
    "ajax": {
        "url": base_url + "/role-has-permission/list",
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

function editRoleHasPermission(id) {
    alert('ddd');
    $.ajax({
        url: base_url + "/role-has-permission/" + id + "/edit",
        type: 'get',
        success: function ($response) {

            console.log($response);
            $('.modal').removeClass('fade');
            $(".modal").css("display", 'block');
            $("#commonModalHeader").html($response.role.name + "  -  " +"RoleHasPermission");
            $("#commonModalContent").html($response.html);
        },
        error: function ($response) {
            appendError($response.responseJSON.message);
        }
    });
}
