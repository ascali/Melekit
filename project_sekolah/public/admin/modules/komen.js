var save_method; //for save method string
var table;

$(document).ready(function(){

     table = $('#komen').DataTable( {
        "processing": true,
        "order": [],
            "ajax": {
                        "url": "http://localhost/project_sekolah/administrator/komen_data",
                        "type": "POST"
                    },
            "aoColumns": [  
                            {
                                "data": "oleh"
                            },
                            {
                                "data": "email"
                            }, 
                            {
                                "data": "date"
                            },
                            {
                                "data": "isi"
                            },
                            {
                                "data": null,
                                "mRender" :function(data, type, row){
                                    if (row.status_publish == 1) {
                                        return "Aktif";
                                    }else{
                                        return "Tidak Aktif";
                                    };
                                }
                            },
                            {
                                "data": null,
                                "mRender": function(data, type, row){
                                    var id = row.id;
                                    var action = edit ? '<a href="#" onclick="edit('+id+',true);"><button class="btn btn-sm btn-warning">&nbsp; Edit &nbsp;</button></a>' : '';
                                    action += edit && del ? '&nbsp;&nbsp;' : '';
                                    action += del ? '<a href="#" onclick="del('+id+',true);"><button class="btn btn-sm btn-danger">Delete</button></a>' : '';
                                    action += action == '' ? 'No Action' : '';
                                    return action;  
                                }
                            }
                       ]
    });

});

function reload_table()
{
  // window.location.reload()
  table.ajax.reload(null,false); //reload datatable ajax 
}

function add()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Form Input Komen'); // Set Title to Bootstrap modal title
    $('#btnSave').text('Save');

}

function edit(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#btnSave').text('Update');

    //Ajax Load data from ajax
    $.ajax({
        url : "http://localhost/project_sekolah/administrator/komen_edit_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {

            $('[name="id"]').val(dataRow.data.id);
            $('[name="oleh"]').val(dataRow.data.oleh);
            $('[name="email"]').val(dataRow.data.email);
            $('[name="date"]').val(dataRow.data.date);
            $('[name="isi"]').val(dataRow.data.isi);
            $('[name="status"]').val(dataRow.data.status_publish);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Form Edit Komen'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function del(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "http://localhost/project_sekolah/administrator/komen_delete_data/"+ id,
            type: "POST",
            dataType: "JSON",
            success: function(dataRow)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
                alert('Success Delete Data Komen');

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "http://localhost/project_sekolah/administrator/komen_insert_data";
    } else {
        url = "http://localhost/project_sekolah/administrator/komen_update_data";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: 'POST',
        data: $('#form').serialize(),
        dataType: 'JSON',
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

            // alert('Success Saving Data Nasabah');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}
