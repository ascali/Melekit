var save_method; //for save method string
var table,select_konten;
var base_url = 'http://localhost/project_sekolah/';

$(document).ready(function(){

     table = $('#konten').DataTable( {
        "processing": true,
        "order": [],
            "ajax": {
                        "url": "http://localhost/project_sekolah/administrator/konten_data",
                        "type": "POST"
                    },
            "aoColumns": [
                            {
                                "data": "judul"
                            },
                            {
                                "data": "isi"
                            },
                            {
                                "data": "id_kategori_konten"
                            },
                            {
                                "data": "create_by"
                            },
                            {
                              "data": null,
                              "mRender": function(data, type, row){
                              var gambar = row.gambar;
                              var img_gambar = gambar ? '<img src="http://localhost/project_sekolah/public/admin/img/konten/'+gambar+'" class="img-responsive" style="width:50%;">' : '';
                              img_gambar += img_gambar == '' ? 'Tidak Ada Photo' : '';
                              return img_gambar;
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
                            // {
                            //  "targets": -1,
                            //  "defaultContent": "<button class='btn btn-xs btn-info' onclick='test()'>edit</button><button class='btn btn-xs btn-danger' onclick='test()'>delete</button>"
                            // }
                       ]
    });

// Select Kategori Konten
    $.getJSON(base_url+"administrator/kategori_konten_data", function(result){
            var isiKosong='<option value="">-Pilih Kategori Konten-</option>';
            $('#kategori_konten').html(isiKosong);
            for (var i = 0; i < result.data.length; i++) {
                select_konten += '<option value="'+result.data[i].id+'">'+result.data[i].nama+'</option>';
            
            }
            $('#kategori_konten').append(select_konten);
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
    $('.modal-title').text('Form Input konten'); // Set Title to Bootstrap modal title
    $('#gambar').hide(); // hide photo preview modal
    $('#label-photo').text('Upload Photo'); // label photo upload
    $('#btnSave').text('Save');
}

function edit(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('.update-button').text('update');


    //Ajax Load data from ajax
    $.ajax({
        url : "http://localhost/project_sekolah/administrator/konten_edit_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {

            $('[name="id"]').val(dataRow.data.id);
            $('[name="judul"]').val(dataRow.data.judul);
            $('[name="isi"]').val(dataRow.data.isi);
            $('[name="id_kategori_konten"]').val(dataRow.data.id_kategori_konten);
            $('[name="create_by"]').val(dataRow.data.create_by);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Form Edit konten'); // Set title to Bootstrap modal title

            $('#gambar').show(); // show photo preview modal

            if(dataRow.data.gambar)
            {
                $('#label-photo').text('Change Photo'); // label photo upload
                $('#gambar div').html('<img src="'+base_url+'public/admin/img/konten/'+dataRow.data.gambar+'" class="img-responsive" width="30%">'); // show photo
                $('#gambar div').append('<input type="checkbox" name="remove_gambar" value="'+dataRow.data.gambar+'"/> Remove photo when saving'); // remove photo
                $('#modalFixed').addClass('modal-bodys');
            }
            else
            {
                $('#label-photo').text('Upload Photo'); // label photo upload
                $('#gambar div').text('(No photo)');
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;

    if(save_method == 'add') {
        url = "http://localhost/project_sekolah/administrator/konten_add";
    } else {
        url = "http://localhost/project_sekolah/administrator/konten_update";
    }

    // ajax adding data to database

    var formData = new FormData($('#form')[0]);
    $.ajax({
        url : url,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                alert('Sukses menyimpan data');
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
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
}

function del(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "http://localhost/project_sekolah/administrator/konten_delete/"+ id,
            type: "POST",
            dataType: "JSON",
            success: function(dataRow)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
                alert('Success Delete Data');

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}
