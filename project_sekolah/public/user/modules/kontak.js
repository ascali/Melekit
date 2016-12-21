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
            //var subisi = isi.substring(0, 150);
            
            /*content +=  '<article class="news-item page-row has-divider clearfix row">'+
                        '<figure class="thumb col-md-2 col-sm-3 col-xs-4">'+
                            '<img class="img-responsive" src="http://localhost/project_sekolah/public/admin/img/konten/'+json.data[a].gambar+'" alt="" />'+
                        '</figure>'+
                        '<div class="details col-md-10 col-sm-9 col-xs-8">'+
                            '<h3 class="title"><a href="news-single.html">'+json.data[a].judul+'</a></h3>'+
                            '<p class="meta text-muted">By: <a href="#">'+json.data[a].create_by+'</a> | Posted on: '+json.data[a].created+'</p>'+
                            '<p>'+subisi+'</p>'+
                            '<a class="btn btn-theme read-more" href="#" onclick="detail_artikel('+id+',true);">Read more<i class="fa fa-chevron-right"></i></a>'+
                        '</div>'+
                    '</article>';

            $('.isi_artikel').html(content);*/
            $('#judul').html(judul);
            $('#isi').html(isi);
            $('#map').html(map);
        //};
    });
});