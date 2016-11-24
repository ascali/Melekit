var save_method; //for save method string
var table;
var base_url = 'http://localhost/project_sekolah/';


$(document).ready(function(){

	 table = $('#pengaturan').DataTable( {
		"processing": true,
		"order": [],
			"ajax": {
						"url": "http://localhost/project_sekolah/administrator/pengaturan_data",
				        "type": "POST"
		        	},
		    "aoColumns": [	
		    				{
			    				"data": "nama_judul"
			    			}, 
			    			{
			    				"data": "keterangan"
			    			}, 
                            {
                              "data": null,
                              "mRender": function(data, type, row){
                              var pavicon = row.favicon;
                              var img_pavicon = pavicon ? '<img src="http://localhost/project_sekolah/public/admin/img/pengaturan/'+pavicon+'" class="img-responsive" style="width:50%;">' : '';
                              img_pavicon += img_pavicon == '' ? 'Tidak Ada Photo' : '';
                              return img_pavicon;  
                              }
                            },
                            {
                                "data": "copy_right"
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
    $('.modal-title').text('Form Input Pengaturan'); // Set Title to Bootstrap modal title

    $('#favicon').hide(); // hide photo preview modal

    $('#label-photo').text('Upload Photo'); // label photo upload
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
        url : "http://localhost/project_sekolah/administrator/pengaturan_edit_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {

            $('[name="id"]').val(dataRow.data.id);
            $('[name="judul"]').val(dataRow.data.nama_judul);
            $('[name="keterangan"]').val(dataRow.data.keterangan);
            $('[name="copy_right"]').val(dataRow.data.copy_right);
            
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Form Edit Pengaturan'); // Set title to Bootstrap modal title

            $('#favicon').show(); // show photo preview modal

            if(dataRow.data.favicon)
            {

                $('#label-photo').text('Change Favicon'); // label photo upload
                $('#favicon div').html('<img src="'+base_url+'public/admin/img/pengaturan/'+dataRow.data.favicon+'" class="img-responsive">'); // show photo
                $('#favicon div').append('<input type="checkbox" name="remove_favicon" value="'+dataRow.data.favicon+'"/> Remove favicon when saving'); // remove photo

            }
            else
            {
                $('#label-photo').text('Upload Favicon'); // label photo upload
                $('#favicon div').text('(No Favicon)');
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
        url = "http://localhost/project_sekolah/administrator/pengaturan_add";
    } else {
        url = "http://localhost/project_sekolah/administrator/pengaturan_update";
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
            url : "http://localhost/project_sekolah/administrator/pengaturan_delete/"+ id,
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
