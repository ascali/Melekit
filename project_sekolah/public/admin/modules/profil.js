var save_method; //for save method string
var table;

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
			    				"data": "nama"
			    			},
                            {
                                "data": "kepala_sekolah"
                            },
                            {
                                "data": "visi"
                            },
                            {
                                "data": "misi"
                            },
                            {
                                "data": "sejarah"
                            },
                            {
                                "data": "alamat"
                            },
                            {
                                "data": "logo"
                            }, 
			    			{
			    				"data": null,
			    				"mRender": function(data, type, row){
			    					var id = row.id;
									var action = edit ? '<a href="#" onclick="edit('+id+',true);">Edit</a>' : '';
									action += edit && del ? '&nbsp;|&nbsp;' : '';
									action += del ? '<a href="#" onclick="del('+id+',true);">Delete</a>' : '';
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
    $('.modal-title').text('Form Input Profil'); // Set Title to Bootstrap modal title

}

function edit(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

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
            $('[name="visi"]').val(dataRow.data.visi);
            $('[name="misi"]').val(dataRow.data.misi);
            $('[name="sejarah"]').val(dataRow.data.sejarah);
            $('[name="alamat"]').val(dataRow.data.alamat);
            $('[name="logo"]').val(dataRow.data.logo);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Form Edit Profil'); // Set title to Bootstrap modal title

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
            url : "http://localhost/project_sekolah/administrator/profil_delete_data/"+ id,
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
        url = "http://localhost/project_sekolah/administrator/profil_insert_data";
    } else {
        url = "http://localhost/project_sekolah/administrator/profil_update_data";
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
