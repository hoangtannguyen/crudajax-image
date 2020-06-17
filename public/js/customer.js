let Cu = {} || Cu;

// Cu.table;
// Cu.tableTrash;

Cu.drawTable = function() {
    Cu.table = $('#fs-table').DataTable({
        // processing: true,
        ajax: {
            url: '/customer/all',
            dataSrc: function(jsons) {
                return jsons.map(json => {
                    let i = 0;
                    return {
                         Cu2: ++i,
                        Cu: json.first_name,
                        Cu1: json.last_name,
                        Cu3: `<img src="${json.image}" style= width:250px; >`,
                        action: `
                            <a class="btn btn-danger text-light" onclick="Cu.show(${json.id})">Show</a>
                            <a class="btn btn-danger text-light" onclick="Cu.edit(${json.id})">Edit</a>
                            <a class="btn btn-warning text-dark" onclick="Cu.destroy(${json.id})">Delete</a>
                        `
                    }
                });
            }
        },
        columns: [
             {
                 data: "Cu2"
           },
            {
                data: "Cu1"
            },
            {
                data: "Cu"
            },
            {
                data: "Cu3"
            },
            {
                data: "action"
            }
        ]

    });
};


Cu.create = function() {
    $("[name='_method']").val('post');
    $('#fs-modal').modal("show");
    $('#fs-modal form')[0].reset();
    $('#fs-modal #fs-modal-title').text("Create Factor Salary");
    $('#fs-modal #btn-save').removeData('id');
    $(`#fs-modal input`).removeClass(['is-valid', 'is-invalid']);
     $('small.badge').remove();
}


Cu.edit = function(id) {
    $.get(`/customer/${id}`).done(function(Obj) {
        $.each(Obj, (i, v) => {
            if (i != "image") {
             $(`#fs-modal input[name=${i}]`).val(v);
            }
        });
        $("[name='_method']").val('put');
        $('#fs-modal #fs-modal-title').text("Edit Factor Salary");
        $('#fs-modal #btn-save').data('id', Obj.id);
        $('#fs-modal').modal('show');
        $(`#fs-modal input`).removeClass(['is-valid', 'is-invalid']);
        $('small.badge').remove();
    });
}




Cu.save = function(btn) {
    let id = $(btn).data('id');
    // let data = $(btn.form).serializeJSON();
    let data = new FormData($('#form')[0]);
    console.log(data);
    if (id) {
        if (confirm('Save change')) {
            $.ajax({
                url: `/customer/${id}`,
                method: 'post',
                data: data,
                processData: false,
                contentType: false,
                success: function(Obj) {
                    Cu.table.ajax.reload( );
                    $('#fs-modal').modal("hide");
                    Cu.success("Update success!");
                },
                error: function(errors) {
                    Cu.errors(errors);
                }
            });
        }
    }
    else {
        if (confirm('Save this data')) {
            $.ajax({
                url: `/customer/cc`,
                method: 'post',
                data: data,
                processData: false,
                contentType: false,
                success: function() {
                    Cu.table.ajax.reload();
                    $('#fs-modal').modal("hide");
                    Cu.success("Create success");
                },
                error: function(errors) {
                    Cu.errors(errors);
                }
            });
        }
    }
}


Cu.show = function(id) {
    $('#dx-modal').modal("show");
    $.ajax({
        method: "GET",
        url: "/customer/show/" + id,
        success: function(response) {
            response_query = response['data']['data'];
            $("#dx-modal").find("#first_name").text(response_query.first_name);
            $("#dx-modal").find("#last_name").text(response_query.last_name);
            $("#dx-modal").find("#image").text(response_query.image);
        },
        error: function() {},
    });

}

Cu.destroy = function(id) {
    if (confirm('Delete this')) {
        $.ajax({
            url: `/customer/${id}/destroy`,
            method: 'delete',
            success: function(msg) {
                Cu.success(msg);
                Cu.table.ajax.reload(null, false);
            },
            error: function(errors) {
                alert('Delete errors');
            }
        });
    }
}


// Cu.errors = function(msg) {
//     $(`#fs-modal input`).each(function() {
//         $(this).addClass('is-valid');
//     });
//     $('small.badge').each(function() {
//         console.log(this);
//         $(this).remove();
//     });
//     $.each(msg, function(i, v) {
//         $(`#fs-modal input[name=${i}]`).addClass('is-invalid').before(`<small class="badge badge-danger mx-auto">${v}</small>`);
//     });
// }

Cu.errors = function(errors) {
    // console.log(errors);
    if (errors.status == 422) {
        let msg = errors.responseJSON.errors;
        $(`#fs-modal .is-invalid`).removeClass('is-invalid');
        $(`#fs-modal .is-valid`).removeClass('is-valid');
        $(`#fs-modal .field`).addClass('is-valid');
        $('small.text').remove();
        $.each(msg, function(i, v) {
            $(`#fs-modal [name=${i}]`).addClass('is-invalid').after(`<small class="text text-danger mx-auto">${v}</small>`);
        });
    } else {
        $('#fs-modal').modal('hide');
        Cv.success("You are not authorized for this action", "Error", 'error');
    }
}

Cu.success = function(msg) {
    $.toast({
        heading: 'Success',
        text: msg,
        hideAfter: 5000,
        position: 'bottom-right',
        showHideTransition: 'slide',
        icon: 'success'
    });
}

Cu.init = function() {
    Cu.drawTable();
}


$(document).ready(function() {
    Cu.init();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});

//Image onchange create
function readURL(event) {
    if (event.target.files && event.target.files[0]) {
        let reader = new FileReader();

        reader.onload = function() {
            let output = document.getElementById("zoom");
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
}

//Image onchange update
function readURLEdit(event) {
    if (event.target.files && event.target.files[0]) {
        let reader = new FileReader();

        reader.onload = function() {
            let output = document.getElementById("zoomEdit");
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
}


