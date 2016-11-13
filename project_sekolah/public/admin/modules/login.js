var save_method; //for save method string
// var table;

// $(document).ready(function(){

// 	 table = $('#users').DataTable( {
// 		"processing": true,
// 		"order": [],
// 			"ajax": {
// 						"url": "http://localhost/project_sekolah/administrator/users_data",
// 				        "type": "POST"
// 		        	},
// 		    "aoColumns": [	
// 		    				{
// 			    				"data": "username"
// 			    			}, 
// 			    			{
// 			    				"data": "password"
// 			    			}, 
// 			    			{
// 			    				"data": "level"
// 			    			},
// 			    			{
// 			    				"data": null,
// 			    				"mRender": function(data, type, row){
// 			    					var id = row.id;
// 									var action = edit ? '<a href="#" onclick="edit('+id+',true);">Edit</a>' : '';
// 									action += edit && del ? '&nbsp;|&nbsp;' : '';
// 									action += del ? '<a href="#" onclick="del('+id+',true);">Delete</a>' : '';
// 									action += action == '' ? 'No Action' : '';
// 									return action;	
// 			    				}
// 			    			}
// 			       			// {
// 			       			// 	"targets": -1,
// 			       			// 	"defaultContent": "<button class='btn btn-xs btn-info' onclick='test()'>edit</button><button class='btn btn-xs btn-danger' onclick='test()'>delete</button>"
// 			       			// }
// 					   ]
// 	});

// });

// function reload_table()
// {
//   // window.location.reload()
//   table.ajax.reload(null,false); //reload datatable ajax 
// }

function login()
{
    save_method = 'login';
    $('#form_login')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modalLogin').modal('show'); // show bootstrap modal
    // $('.modal-title').text('Form Input User'); // Set Title to Bootstrap modal title

}

// function edit(id)
// {
//     save_method = 'update';
//     $('#form')[0].reset(); // reset form on modals
//     $('.form-group').removeClass('has-error'); // clear error class
//     $('.help-block').empty(); // clear error string

//     //Ajax Load data from ajax
//     $.ajax({
//         url : "http://localhost/project_sekolah/administrator/user_edit_data/" + id,
//         type: "GET",
//         dataType: "JSON",
//         success: function(dataRow)
//         {

//             $('[name="id"]').val(dataRow.data.id);
//             $('[name="username"]').val(dataRow.data.username);
//             $('[name="password"]').val(dataRow.data.password);
//             $('[name="level"]').val(dataRow.data.level);
//             $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
//             $('.modal-title').text('Form Edit User'); // Set title to Bootstrap modal title

//         },
//         error: function (jqXHR, textStatus, errorThrown)
//         {
//             alert('Error get data from ajax');
//         }
//     });
// }

// function del(id)
// {
//     if(confirm('Are you sure delete this data?'))
//     {
//         // ajax delete data to database
//         $.ajax({
//             url : "http://localhost/project_sekolah/administrator/user_delete_data/"+ id,
//             type: "POST",
//             dataType: "JSON",
//             success: function(dataRow)
//             {
//                 //if success reload ajax table
//                 $('#modal_form').modal('hide');
//                 reload_table();
//                 alert('Success Delete Data Nasabah');

//             },
//             error: function (jqXHR, textStatus, errorThrown)
//             {
//                 alert('Error deleting data');
//             }
//         });

//     }
// }

function do_login()
{
    $('#btnLogin').text('logging...'); //change button text
    $('#btnLogin').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'login') {
        url = "http://localhost/project_sekolah/login/do_login";
    } else {
        url = "http://localhost/project_sekolah/login/user_update_data";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: 'POST',
        data: $('#form_login').serialize(),
        // dataType: 'JSON',
        success: function(data)
        {
            if(data == 1) //status //if success close modal and reload ajax table
            {
                $('#modalLogin').modal('hide');
                // reload_table();
                window.location.href = "http://localhost/project_sekolah/administrator/dashboard";

            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnLogin').text('Login'); //change button text
            $('#btnLogin').attr('disabled',false); //set button enable 

            // alert('Success Saving Data Nasabah');
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            console.log('test '+JSON.stringify(jqXHR));
            console.log('test '+textStatus);
            console.log('test '+errorThrown);
            alert('Error Log in');
            $('#btnLogin').text('Login Error'); //change button text
            $('#btnLogin').attr('disabled',false); //set button enable 

        }
    });
}
