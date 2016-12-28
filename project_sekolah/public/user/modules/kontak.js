var save_method; //for save method string
var table,select_galeri;
var base_url = 'http://localhost/project_sekolah/';

$(document).ready(function(){
    
    $.getJSON("http://localhost/project_sekolah/index/kontak_data", function(json) {
        var content='';


        //for (var a=0; a<json.data.length; a++) {
            
            //var id = json.data[a].id;
            var judul = json.data[0].judul;
            var isi = json.data[0].isi;
            var map = json.data[0].map;
            
            $('#judul').html(judul);
            $('#isi').html(isi);
            $('#map').html(map);
        //};
    });
});