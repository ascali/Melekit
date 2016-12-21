var save_method; 
var table,select_konten;
var isi;
var judul;
var base_url = 'http://localhost/project_sekolah/';
// var id = $('#qqq').val();
var id = (location.pathname.split('/').pop());
$(document).ready(function(){

        index(id);

});

function index(id)
{
    $.getJSON("http://localhost/project_sekolah/index/detail_berita_data/"+id, function(dataCarousel) {
            var newsContent = "";
            var imgCaption  = "";
            var id=0;

                newsContent += '<h1 class="heading-title pull-left">'+dataCarousel.data.judul+'</h1>'+
                                    '<br>'+
                                        '<article class="news-item" style="margin-top: 40px;">'+
                                            '<p class="meta text-muted">By: <a href="#">Admin</a> | Posted on: 26 Jan 2014</p>'+
                                            '<p><img style="width: 50%; margin-bottom: 14px;" src="http://localhost/project_sekolah/public/admin/img/konten/'+dataCarousel.data.gambar+'"  alt="" /></p>'+
                                            '<p>'+dataCarousel.data.isi+'</p>'+
                                        '</article>';
                    
                $('#newsContent').html(newsContent);

                var judul = dataCarousel.data.judul;
                $('.judul').html(judul);
    });
}