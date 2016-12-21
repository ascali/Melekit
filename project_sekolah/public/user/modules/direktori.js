var base_url = 'http://localhost/project_sekolah/';
var data_profil_sekolah = "", data_tentang = "", data_logo_sekolah = "", data_struktur_organisasi = "", data_sejarah = "", data_visi = "", data_misi = "";
var data_siswa = "", data_guru = "", data_prestasi_sekolah = "", data_program_kerja = "", data_fasilitas = "", data_kemitraan = "";

var data_kurikulum = "";

$(document).ready(function(){
	
	var table = $('#direktori_guru').DataTable( {
		"processing": true,
		"order": [[ 2, 'asc' ]],
			"ajax": {
						"url": "http://localhost/project_sekolah/index/gurus_data",
				        "type": "POST"
		        	},
		    "aoColumns": [
		    				{
		    					"data": null,
	                            "width": "50px",
	                            "sClass": "text-center",
	                            "orderable": false,
		    				},
		    				{
			    				"data": "nip"
			    			},
			    			{
			    				"data": "nama"
			    			},
			    			{
			    				"data": "kelamin"
			    			},
                            {
			    				"data": null,
			    				"mRender": function(data, type, row){
			    					var id = row.id;
									var action = view ? '<a href="#" onclick="view('+id+',true);"><button title="Detail" class="btn btn-sm btn-warning">&nbsp;<i class="fa fa-file-text-o" aria-hidden="true"></i></button></a>' : '';
									action += view ? '&nbsp;&nbsp;' : '';
									//action += del ? '<a href="#" onclick="del('+id+',true);"><button class="btn btn-sm btn-danger">Delete</button></a>' : '';
									action += action == '' ? 'No Action' : '';
									return action;
			    				}
			    			}
					   ]
	});

	table.on('order.dt search.dt', function(){
        table.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i){
            cell.innerHTML = i+1;
        });
    }).draw();

    var table_siswa = $('#direktori_siswa').DataTable( {
		"processing": true,
		"order": [[ 2, 'asc' ]],
			"ajax": {
						"url": "http://localhost/project_sekolah/index/siswa_data",
				        "type": "POST"
		        	},
		    "aoColumns": [
		    				{
		    					"data": null,
	                            "width": "50px",
	                            "sClass": "text-center",
	                            "orderable": false,
		    				},
		    				{
			    				"data": "nis"
			    			},
			    			{
			    				"data": "nama"
			    			},
			    			{
			    				"data": "nama_jurusan"
			    			},
                            {
			    				"data": "kelas"
			    				/*"data": null,
			    				"mRender": function(data, type, row){
			    					var id = row.id;
									var action = view ? '<a href="#" onclick="view('+id+',true);"><button title="Detail" class="btn btn-sm btn-warning">&nbsp;<i class="fa fa-file-text-o" aria-hidden="true"></i></button></a>' : '';
									action += view ? '&nbsp;&nbsp;' : '';
									//action += del ? '<a href="#" onclick="del('+id+',true);"><button class="btn btn-sm btn-danger">Delete</button></a>' : '';
									action += action == '' ? 'No Action' : '';
									return action;
			    				}*/
			    			}
					   ]
	});

	table_siswa.on('order.dt search.dt', function(){
        table_siswa.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i){
            cell.innerHTML = i+1;
        });
    }).draw();

	$.getJSON(base_url+"index/kurikulum_data", function(dataJson){
		var data = dataJson.data;

		/*Start Kurikulum*/
			for (var k = 0; k < data.length; k++) {
				data_kurikulum += '<p>'+data[k].nama+'</p>';
			}
			$('#data_kurikulum').html(data_kurikulum);
		/*End Kurikulum*/

	});

	var table_staff = $('#direktori_staff').DataTable( {
		"processing": true,
		"order": [[ 2, 'asc' ]],
			"ajax": {
						"url": "http://localhost/project_sekolah/index/staff_data",
				        "type": "POST"
		        	},
		    "aoColumns": [
		    				{
		    					"data": null,
	                            "width": "50px",
	                            "sClass": "text-center",
	                            "orderable": false,
		    				},
		    				{
			    				"data": "nip"
			    			},
			    			{
			    				"data": "nama"
			    			},
			    			{
			    				"data": "kelamin"
			    			},
                            {
			    				"data": null,
			    				"mRender": function(data, type, row){
			    					var id = row.id;
									var action = view ? '<a href="#" onclick="view_staff('+id+',true);"><button title="Detail" class="btn btn-sm btn-warning">&nbsp;<i class="fa fa-file-text-o" aria-hidden="true"></i></button></a>' : '';
									action += view ? '&nbsp;&nbsp;' : '';
									//action += del ? '<a href="#" onclick="del('+id+',true);"><button class="btn btn-sm btn-danger">Delete</button></a>' : '';
									action += action == '' ? 'No Action' : '';
									return action;
			    				}
			    			}
					   ]
	});

	table_staff.on('order.dt search.dt', function(){
        table_staff.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i){
            cell.innerHTML = i+1;
        });
    }).draw();

	/*Start Kemitraan*/
	$.getJSON(base_url+"index/kemitraan_data", function(dataJson){
		var data = dataJson.data;
		/*Start kemitraan*/
			for (var o = 0; o < data.length; o++) {
				data_kemitraan += '<li>Nama Mitra: '+data[o].nama+'<ul><li>Alamat : '+data[o].alamat+'</li><li>Jurusan : '+data[o].id_jurusan+'</li></ul></li>';
			}
			$('#kemitraan ol').html(data_kemitraan);
		/*End kemitraan*/
	});
	/*End Kemitraan*/

	/*Start guru*/
	$.getJSON(base_url+"index/gurus_data", function(dataJson){
		var data = dataJson.data;
		/*Start guru*/
			for (var q = 0; q < data.length; q++) {
				data_guru += '<li>Nama Guru: '+data[q].nama+'<ul><li>Prestasi : '+data[q].prestasi+'</li><li>NIP : '+data[q].nip+'</li></ul></li>';
			}
			$('#guru ol').html(data_guru);
		/*End guru*/
	});
	/*End guru*/

	/*Start siswa*/
	$.getJSON(base_url+"index/siswa_data", function(dataJson){
		var data = dataJson.data;
		/*Start siswa*/
			for (var r = 0; r < data.length; r++) {
				data_siswa += '<li>Nama siswa: '+data[r].nama+'<ul><li>Prestasi : '+data[r].prestasi+'</li><li>NIS : '+data[r].nis+'</li></ul></li>';
			}
			$('#siswa ol').html(data_siswa);
		/*End siswa*/
	});
	/*End siswa*/
});

function view(id)
{
    /*save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('.update-button').text('update');*/


    //Ajax Load data from ajax
    $.ajax({
        url : "http://localhost/project_sekolah/index/guru_view_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {

            $('#nip').html(dataRow.data.nip);
            $('#nuptk').html(dataRow.data.nuptk);
            $('#nama').html(dataRow.data.nama);
            $('#kelamin').html(dataRow.data.kelamin);
            $('#ttl').html(dataRow.data.ttl);
            $('#pelajaran_jabatan').html(dataRow.data.pelajaran_jabatan);
            $('#status').html(dataRow.data.status);
            $('#alamat').html(dataRow.data.alamat);
           	$('#blog').html(dataRow.data.blog);
            $('#prestasi').html(dataRow.data.prestasi);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Detail List Guru'); // Set title to Bootstrap modal title

            $('#foto').show(); // show photo preview modal

            if(dataRow.data.foto)
            {
                $('#label-photo').text('Change Photo'); // label photo upload
                $('#foto div').html('<img src="'+base_url+'public/admin/img/guru/'+dataRow.data.foto+'" class="img-responsive" width="30%">'); // show photo
                //$('#foto div').append('<input type="checkbox" name="remove_foto" value="'+dataRow.data.foto+'"/> Remove photo when saving'); // remove photo
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

function view_staff(id)
{
    /*save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('.update-button').text('update');*/


    //Ajax Load data from ajax
    $.ajax({
        url : "http://localhost/project_sekolah/index/guru_view_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {

            $('#nip').html(dataRow.data.nip);
            $('#nuptk').html(dataRow.data.nuptk);
            $('#nama').html(dataRow.data.nama);
            $('#kelamin').html(dataRow.data.kelamin);
            $('#ttl').html(dataRow.data.ttl);
            $('#pelajaran_jabatan').html(dataRow.data.pelajaran_jabatan);
            $('#status').html(dataRow.data.status);
            $('#alamat').html(dataRow.data.alamat);
           	$('#blog').html(dataRow.data.blog);
            $('#prestasi').html(dataRow.data.prestasi);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Detail List Staff'); // Set title to Bootstrap modal title

            $('#foto').show(); // show photo preview modal

            if(dataRow.data.foto)
            {
                $('#label-photo').text('Change Photo'); // label photo upload
                $('#foto div').html('<img src="'+base_url+'public/admin/img/guru/'+dataRow.data.foto+'" class="img-responsive" width="30%">'); // show photo
                //$('#foto div').append('<input type="checkbox" name="remove_foto" value="'+dataRow.data.foto+'"/> Remove photo when saving'); // remove photo
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
