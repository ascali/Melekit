var save_method; //for save method string
var table;

$(document).ready(function(){

	 table = $('#agenda').DataTable( {
		"processing": true,
		"order": [],
			"ajax": {
						"url": "http://localhost/project_sekolah/administrator/agenda_data",
				        "type": "POST"
		        	},
		    "aoColumns": [	
                            {
                                "data": "tanggal"
                            },
                            {
                                "data": "acara"
                            },
                            {
                                "data": "kegiatan"
                            },
                            {
                                "data": null,
                                "mRender": function(data, type, row){
                                    if (row.tempat == "intern") {
                                        return "Lingkungan Sekolah";
                                    }else{
                                        return "Di Luar Lingkungan Sekolah";
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
    $('.modal-title').text('Form Input Agenda'); // Set Title to Bootstrap modal title
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
        url : "http://localhost/project_sekolah/administrator/agenda_edit_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {

            $('[name="id"]').val(dataRow.data.id);
            $('[name="tanggal"]').val(dataRow.data.tanggal);
            $('[name="acara"]').val(dataRow.data.acara);
            $('[name="kegiatan"]').val(dataRow.data.kegiatan);
            $('[name="tempat"]').val(dataRow.data.tempat);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Form Edit Agenda'); // Set title to Bootstrap modal title

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
            url : "http://localhost/project_sekolah/administrator/agenda_delete_data/"+ id,
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
        url = "http://localhost/project_sekolah/administrator/agenda_insert_data";
    } else {
        url = "http://localhost/project_sekolah/administrator/agenda_update_data";
    }
// var temp = tinymce.get('visi').save();
// console.log(temp);
// var temp1 = tinymce.get('misi').save();
// console.log(temp1);
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
