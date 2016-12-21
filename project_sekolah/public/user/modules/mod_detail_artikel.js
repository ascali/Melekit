var save_method; //for save method string
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
    $.getJSON("http://localhost/project_sekolah/index/detail_artikel_data/"+id, function(dataCarousel) {
            var newsContent = "";
            var imgCaption  = "";
            var id=0;

                newsContent += '<article class="news-item">'+
                                    '<p class="meta text-muted">By: <a href="#">'+dataCarousel.data.create_by+'</a> | Posted on: '+dataCarousel.data.created+'</p>'+
                                    '<p><img style="width: 50%; margin-bottom: 14px;" src="http://localhost/project_sekolah/public/admin/img/konten/'+dataCarousel.data.gambar+'"  alt="" /></p>'+
                                    '<p>'+dataCarousel.data.isi+'</p>'+
                                '</article>';
                    
                $('#newsContent').html(newsContent);

                var judul = dataCarousel.data.judul;
                $('.judul').html(judul);
    });
}