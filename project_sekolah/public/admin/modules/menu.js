var save_method; //for save method string
var table;
var coba;

$(document).ready(function(){

	 table = $('#menu').DataTable( {
		"processing": true,
		"order": [],
			"ajax": {
						"url": "http://localhost/project_sekolah/administrator/menu_data",
				        "type": "POST"
		        	},
		    "aoColumns": [	
		    				{
			    				"data": "nama"
			    			},
                            {
                                "data": "href"
                            },
                            {
                                "data": "nama_submenu"
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
// var urlList="http://localhost/project_sekolah/administrator/select_menu";
// console.log('kkkk',urlList);
});
// function createSelect(options){
//     $.each(options,function(index,item){
//         $("#hhhh").append($("<option></option>").attr("value",item.OrderInList).text(item.OrderlnList));
//     });
// }


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
    $('.modal-title').text('Form Input Menu'); // Set Title to Bootstrap modal title

    var isi = '';
$.getJSON("http://localhost/project_sekolah/administrator/submenu_data", function(json){
            // $('#kategori_konten').empty();
            var isiKosong='<option value="">-Pilih Konten-</option>';
            $('#id_submenu').html(isiKosong);
            // $('.kategori_konten').append($('<option>').text("-Pilih-"));
            // $.each(json, function(i, data){
            //     console.log("coba", json.data.length);
            //     for (var a = 0 ; a < json.data.length ; a++) {                  
            //         // $('#kategori_konten').html($('<option>').text(data[a].nama).attr('value', data[a].id));
            //         a += "<option value='"+data[a].id+"'>"+data[a].nama+"</option>"; 
            //     };
            //     $('#kategori_konten').html(a);
            // });
                    for (var a = 0; a < json.data.length; a++) {
                    console.log("nama = ",json.data[0].nama);            
                    // $('#kategori_konten').html($('<option>').text(data[a].nama).attr('value', data[a].id));
                        isi = '<option value="'+json.data[a].id+'">'+json.data[a].nama+'</option>';
                        console.log(json.data[a].id); 
                    };
                    $('#id_submenu').append(isi);
    });

}

function edit(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "http://localhost/project_sekolah/administrator/menu_edit_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {

            $('[name="id"]').val(dataRow.data.id);
            $('[name="nama"]').val(dataRow.data.nama);
            $('[name="href"]').val(dataRow.data.href);
            $('[name="submenu"]').val(dataRow.data.id_submenu);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Form Edit Menu'); // Set title to Bootstrap modal title

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
            url : "http://localhost/project_sekolah/administrator/menu_delete_data/"+ id,
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

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "http://localhost/project_sekolah/administrator/menu_insert_data";
    } else {
        url = "http://localhost/project_sekolah/administrator/menu_update_data";
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
