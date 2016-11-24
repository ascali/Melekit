var save_method; //for save method string
var table;
var base_url = 'http://localhost/project_sekolah/';

$(document).ready(function(){

	table = $('#profil').DataTable( {
        "processing": true,
        "order": [],
            "ajax": {
                        "url": "http://localhost/project_sekolah/administrator/profil_data",
                        "type": "POST"
                    },
            "aoColumns": [  
                            {
                              "data": null,
                              "mRender": function(data, type, row){
                              var logo = row.logo;
                              var img_logo = logo ? '<img src="http://localhost/project_sekolah/public/admin/img/profil/'+logo+'" class="img-responsive" style="width:50%;">' : '';
                              img_logo += img_logo == '' ? 'Tidak Ada Photo' : '';
                              return img_logo;  
                              }
                            },
                            {
                                "data": "nama"
                            }, 
                            {
                                "data": "kepala_sekolah"
                            },

                            {
                                "data": "telp"
                            }, 
                            {
                                "data": "email"
                            },
                            {
                                "data": "alamat"
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
    $('.modal-title').text('Form Input Profil'); // Set Title to Bootstrap modal title
    $('#btnSave').text('Save');

    $('#logo').hide(); // hide photo preview modal
    $('#struktur_organisasi').hide(); // hide photo preview modal
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
        url : "http://localhost/project_sekolah/administrator/profil_edit_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {

            $('[name="id"]').val(dataRow.data.id);
            $('[name="nama"]').val(dataRow.data.nama);
            $('[name="kepala_sekolah"]').val(dataRow.data.kepala_sekolah);
            $('[name="telp"]').val(dataRow.data.telp);
            $('[name="email"]').val(dataRow.data.email);
            $('[name="alamat"]').val(dataRow.data.alamat);
            $('[name="telp"]').val(dataRow.data.telp);
            $('[name="email"]').val(dataRow.data.email);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Form Edit Profil'); // Set title to Bootstrap modal title

            $('#logo').show(); // show photo preview modal
            $('#struktur_organisasi').show(); // show photo preview modal

            if(dataRow.data.logo)
            {

                $('#label-logo').text('Change Logo'); // label logo upload
                $('#logo div').html('<img src="'+base_url+'public/admin/img/profil/'+dataRow.data.logo+'" class="img-responsive">'); // show logo
                $('#logo div').append('<input type="checkbox" name="remove_profil" value="'+dataRow.data.logo+'"/> Remove logo when saving'); // remove logo

            }
            else
            {
                $('#label-logo').text('Upload Logo'); // label logo upload
                $('#logo div').text('(No Logo)');
            }

            if(dataRow.data.struktur_organisasi)
            {

                $('#label-photo-organisasi-struktur').text('Change gambar struktur organisasi'); // label photo upload
                $('#struktur_organisasi div').html('<img src="'+base_url+'public/admin/img/profil/'+dataRow.data.struktur_organisasi+'" class="img-responsive">'); // show photo
                $('#struktur_organisasi div').append('<input type="checkbox" name="remove_struktur_organisasi" value="'+dataRow.data.struktur_organisasi+'"/> Remove struktur_organisasi when saving'); // remove photo

            }
            else
            {
                $('#label-photo-organisasi-struktur').text('Upload struktur organisasi'); // label photo upload
                $('#struktur_organisasi div').text('(No Image)');
            }


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
            url : "http://localhost/project_sekolah/administrator/profil_delete/"+ id,
            type: "POST",
            dataType: "JSON",
            success: function(dataRow)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
                alert('Success Delete Data Profil');

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
        url = "http://localhost/project_sekolah/administrator/profil_add";
    } else {
        url = "http://localhost/project_sekolah/administrator/profil_update";
    }

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
