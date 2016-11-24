var save_method; //for save method string
var table;
var base_url = 'http://localhost/project_sekolah/';

$(document).ready(function(){

	 table = $('#guru').DataTable( {
		"processing": true,
		"order": [],
			"ajax": {
						"url": "http://localhost/project_sekolah/administrator/gurus_data",
				        "type": "POST"
		        	},
		    "aoColumns": [
		    				{
			    				"data": "nama"
			    			},
			    			{
			    				"data": "nip"
			    			},
                            {
                                "data": "nuptk"
                            },
                            // {
                            //     "data": "kelamin"
                            // },
                            {
                                "data": "ttl"
                            },
                            {
                                "data": "pelajaran_jabatan"
                            },
                            {
                                "data": "status"
                            },
                            {
                                "data": "alamat"
                            },
                            // {
                            //     "data": "blog"
                            // },
                            // {
                            //     "data": "prestasi"
                            // },
                            {
                              "data": null,
                              "mRender": function(data, type, row){
                              var foto = row.foto;
                              var img_foto = foto ? '<img src="http://localhost/project_sekolah/public/admin/img/guru/'+foto+'" class="img-responsive" style="width:50%;">' : '';
                              img_foto += img_foto == '' ? 'Tidak Ada Photo' : '';
                              return img_foto;
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
    $('.modal-title').text('Form Input Guru'); // Set Title to Bootstrap modal title
    $('#foto').hide(); // hide photo preview modal
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
        url : "http://localhost/project_sekolah/administrator/guru_edit_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {

            $('[name="id"]').val(dataRow.data.id);
            $('[name="nama"]').val(dataRow.data.nama);
            $('[name="nip"]').val(dataRow.data.nip);
            $('[name="nuptk"]').val(dataRow.data.nuptk);
            $('[name="kelamin"]').val(dataRow.data.kelamin);
            $('[name="ttl"]').val(dataRow.data.ttl);
            $('[name="pelajaran_jabatan"]').val(dataRow.data.pelajaran_jabatan);
            $('[name="status"]').val(dataRow.data.status);
            $('[name="alamat"]').val(dataRow.data.alamat);
            $('[name="blog"]').val(dataRow.data.blog);
            $('[name="prestasi"]').val(dataRow.data.prestasi);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Form Edit guru'); // Set title to Bootstrap modal title

            $('#foto').show(); // show photo preview modal

            if(dataRow.data.foto)
            {
                $('#label-photo').text('Change Photo'); // label photo upload
                $('#foto div').html('<img src="'+base_url+'public/admin/img/guru/'+dataRow.data.foto+'" class="img-responsive" width="30%">'); // show photo
                $('#foto div').append('<input type="checkbox" name="remove_foto" value="'+dataRow.data.foto+'"/> Remove photo when saving'); // remove photo
								$('#modalFixed').addClass('modal-bodys');
            }
            else
            {
                $('#label-photo').text('Upload Photo'); // label photo upload
                $('#foto div').text('(No photo)');
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
        url = "http://localhost/project_sekolah/administrator/guru_add";
    } else {
        url = "http://localhost/project_sekolah/administrator/guru_update";
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
            url : "http://localhost/project_sekolah/administrator/guru_delete/"+ id,
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
