var save_method; //for save method string
var table;
var base_url = 'http://localhost/project_sekolah/';

$(document).ready(function(){

	 table = $('#users').DataTable( {
		"processing": true,
		"order": [],
			"ajax": {
						"url": "http://localhost/project_sekolah/administrator/users_data",
				        "type": "POST"
		        	},
		    "aoColumns": [
		    				{
			    				"data": "username"
			    			},
			    			{
			    				"data": "password"
			    			},
                            {
                                "data": "level"
                            },
                            {
                                "data": "status"
                            },
                            {
                              "data": null,
                              "mRender": function(data, type, row){
                              var photo_user = row.photo_user;
                              var img_photo_user = photo_user ? '<img src="http://localhost/project_sekolah/public/admin/img/user/'+photo_user+'" class="img-responsive" style="width:50%;">' : '';
                              img_photo_user += img_photo_user == '' ? 'Tidak Ada Photo' : '';
                              return img_photo_user;
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
			       			// 	"targets": -1,
			       			// 	"defaultContent": "<button class='btn btn-xs btn-info' onclick='test()'>edit</button><button class='btn btn-xs btn-danger' onclick='test()'>delete</button>"
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
    $('.modal-title').text('Form Input User'); // Set Title to Bootstrap modal title
    $('#photo_user').hide(); // hide photo preview modal
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
        url : "http://localhost/project_sekolah/administrator/user_edit_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {

            $('[name="id"]').val(dataRow.data.id);
            $('[name="username"]').val(dataRow.data.username);
            $('[name="password"]').val(dataRow.data.password);
            $('[name="level"]').val(dataRow.data.level);
            $('[name="status"]').val(dataRow.data.status);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Form Edit User'); // Set title to Bootstrap modal title

            $('#photo_user').show(); // show photo preview modal

            if(dataRow.data.photo_user)
            {
                $('#label-photo').text('Change Photo'); // label photo upload
                $('#photo_user div').html('<img src="'+base_url+'public/admin/img/user/'+dataRow.data.photo_user+'" class="img-responsive" width="30%">'); // show photo
                $('#photo_user div').append('<input type="checkbox" name="remove_photo_user" value="'+dataRow.data.photo_user+'"/> Remove photo when saving'); // remove photo
								$('#modalFixed').addClass('modal-bodys');
            }
            else
            {
                $('#label-photo').text('Upload Photo'); // label photo upload
                $('#photo_user div').text('(No photo)');
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
        url = "http://localhost/project_sekolah/administrator/user_add";
    } else {
        url = "http://localhost/project_sekolah/administrator/user_update";
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
            url : "http://localhost/project_sekolah/administrator/user_delete/"+ id,
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
