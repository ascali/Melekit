var base_url = 'http://localhost/project_sekolah/';
var data_profil_sekolah = "", data_tentang = "", data_logo_sekolah = "", data_struktur_organisasi = "", data_sejarah = "", data_visi = "", data_misi = "";
var data_siswa = "", data_guru = "", data_prestasi_sekolah = "", data_program_kerja = "", data_fasilitas = "", data_kemitraan = "";

$(document).ready(function(){
	$.getJSON(base_url+"index/profil_lengkap_data", function(dataJson){
		var data = dataJson.data;
		/*Start Profil Sekolah*/
			for (var i = 0; i < data.length; i++) {
				data_logo_sekolah += '<center><img class="img-responsive" src="'+base_url+'public/admin/img/profil/'+data[i].logo+'" width="40%" alt=""/></center>';
				data_profil_sekolah += '<li><strong>Nama Sekolah:</strong> <em>'+data[i].nama+'</em></li>'+
								  '<li><strong>Kepala Sekolah:</strong> <em>'+data[i].kepala_sekolah+'</em></li>'+
								  '<li><strong>Nomor Telpon Sekolah:</strong> <em>'+data[i].telp+'</em></li>'+
								  '<li><strong>Email Sekolah:</strong> <em>'+data[i].email+'</em></li>'+
								  '<li><strong>Alamat Sekolah:</strong> <em>'+data[i].alamat+'</em></li>';
				data_tentang += '<p>'+data[i].tentang+'</p>';
			}
			$('#logo_sekolah').html(data_logo_sekolah);
			$('#profil_sekolah').html(data_profil_sekolah);
			$('#tentang').html(data_tentang);
		/*End Profil Sekolah*/

		/*Start Struktur Organisasi*/
			for (var j = 0; j < data.length; j++) {
				data_struktur_organisasi += '<center><img class="img-responsive" src="'+base_url+'public/admin/img/profil/'+data[j].struktur_organisasi+'" width="50%" alt=""/></center>';
			}
			$('#struktur_organisasi').html(data_struktur_organisasi);
		/*End Struktur Organisasi*/

		/*Start Sejarah*/
			for (var k = 0; k < data.length; k++) {
				data_sejarah += '<p>'+data[k].sejarah+'</p>';
			}
			$('#sejarah').html(data_sejarah);
		/*End Sejarah*/

		/*Start visi misi*/
			for (var l = 0; l < data.length; l++) {
				data_visi += '<p>'+data[l].visi+'</p>';
				data_misi += '<p>'+data[l].misi+'</p>';
			}
			$('#visi').html(data_visi);
			$('#misi').html(data_misi);
		/*End visi misi*/

		/*Start fasilitas*/
			for (var m = 0; m < data.length; m++) {
				data_fasilitas += '<p>'+data[m].fasilitas+'</p>';
			}
			$('#fasilitas').html(data_fasilitas);
		/*End fasilitas*/

		/*Start fasilitas*/
			for (var n = 0; n < data.length; n++) {
				data_program_kerja += '<p>'+data[n].program_kerja+'</p>';
			}
			$('#program_kerja').html(data_program_kerja);
		/*End fasilitas*/

		/*Start fasilitas*/
			for (var p = 0; p < data.length; p++) {
				data_prestasi_sekolah += '<p>'+data[p].prestasi_sekolah+'</p>';
			}
			$('#prestasi_sekolah').html(data_prestasi_sekolah);
		/*End fasilitas*/
	});

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