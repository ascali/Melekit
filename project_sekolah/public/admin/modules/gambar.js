var save_method; //for save method string
var table, select_konten = "", select_galeri = "";
var base_url = 'http://localhost/project_sekolah/';

$(document).ready(function(){

	 table = $('#gambar').DataTable( {
		"processing": true,
		"order": [],
			"ajax": {
						"url": "http://localhost/project_sekolah/administrator/gambar_data",
				        "type": "POST"
		        	},
		    "aoColumns": [
    					{
    						"data": "nama"
    					},
        				{
    	    				"data": "nama_konten"
    	    			},
    	    			{
    	    				"data": "nama_galeri"
    	    		     },
                        {
                            "data": "keterangan"
                        },
                        {
                            "data": null,
                            "mRender": function(data, type, row){
                                if (row.status_slide == 1) {
                                    return "Slide";
                                }else{
                                    return "Bukan Slide";
                                };
                            }
                        },
                        {
                            "data": "created"
                        },
                        {
                            "data": "updated"
                        },
                        {
                            "data": null,
                            "mRender": function(data, type, row)
                                                    {
                                var file = row.file;
                                var img_file = file ? '<img src="http://localhost/project_sekolah/public/admin/img/gambar/'+file+'" class="img-responsive" style="width:100%;">' : '';
                                img_file += img_file == '' ? 'Tidak Ada Photo' : '';
                                return img_file;
                            }
                        },
    	    		     {
    	    				"data": null,
    	    				"mRender": function(data, type, row)
    							{
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

    // Select Konten
    $.getJSON(base_url+"administrator/konten_data", function(result){
            var isiKosong='<option value="">-Pilih Konten-</option>';
            $('#select_konten').html(isiKosong);
            for (var i = 0; i < result.data.length; i++) {
                select_konten += '<option value="'+result.data[i].id+'">'+result.data[i].judul+'</option>';
            }
            $('#select_konten').append(select_konten);
  });
// Select Galeri
    var isi="";
    $.getJSON(base_url+"administrator/galeri_data", function(json){
        var isiKosong='<option value="">-Pilih Galeri-</option>';
        $('#id_galeri').html(isiKosong);
        for (var a = 0; a < json.data.length; a++) {
            isi = '<option value="'+json.data[a].id+'">'+json.data[a].nama+'</option>'; 
        };
        $('#id_galeri').append(isi);
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
    $('#btnSave').text('Save');

    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Form Input Gambar'); // Set Title to Bootstrap modal title

    $('#gambars').hide(); // hide photo preview modal

    $('#label-photo').text('Unggah Gambar'); // label photo upload

}

function edit(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('.update-button').text('Update');


    //Ajax Load data from ajax
    $.ajax({
        url : "http://localhost/project_sekolah/administrator/gambar_edit_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {

            $('[name="id"]').val(dataRow.data.id);
            $('[name="nama"]').val(dataRow.data.nama);
            $('[name="id_konten"]').val(dataRow.data.id_konten);
            $('[name="id_galeri"]').val(dataRow.data.id_galeri);
            $('[name="keterangan"]').val(dataRow.data.keterangan);
            $('[name="status_slide"]').val(dataRow.data.status_slide);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Form Edit Gambar'); // Set title to Bootstrap modal title

            $('#gambars').show(); // show photo preview modal

            if(dataRow.data.file)
            {
                $('#label-photo').text('Ganti Gambar'); // label photo upload
                $('#gambars div').html('<img src="'+base_url+'public/admin/img/gambar/'+dataRow.data.file+'" class="img-responsive" width="30%">'); // show photo
                $('#gambars div').append('<input type="checkbox" name="remove_gambar" value="'+dataRow.data.file+'"/> Remove picture when saving'); // remove photo
								$('#modalFixed').addClass('modal-bodys');
            }
            else
            {
                $('#label-photo').text('Upload Photo'); // label photo upload
                $('#gambars div').text('(No photo)');
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
        url = "http://localhost/project_sekolah/administrator/gambar_add";
    } else {
        url = "http://localhost/project_sekolah/administrator/gambar_update";
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
            url : "http://localhost/project_sekolah/administrator/gambar_delete/"+ id,
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
