var save_method; //for save method string
var table,select_galeri;
var base_url = 'http://localhost/project_sekolah/';

$(document).ready(function(){
    
    $('.fancybox').fancybox(); 

    $.getJSON("http://localhost/project_sekolah/index/latest_news_data", function(json) {
        var content='';


        for (var a=0; a<json.data.length; a++) {
            
            var id = json.data[a].id;
            var isi = json.data[a].isi;
            var subisi = isi.substring(0, 150);
            
            content +=  '<article class="news-item page-row has-divider clearfix row">'+
                        '<figure class="thumb col-md-2 col-sm-3 col-xs-4">'+
                            '<img class="img-responsive" src="http://localhost/project_sekolah/public/admin/img/konten/'+json.data[a].gambar+'" alt="" />'+
                        '</figure>'+
                        '<div class="details col-md-10 col-sm-9 col-xs-8">'+
                            '<h3 class="title"><a href="news-single.html">'+json.data[a].judul+'</a></h3>'+
                            '<p>'+subisi+'</p>'+
                            '<a class="btn btn-theme read-more" href="#" onclick="detail_berita('+id+',true);">Read more<i class="fa fa-chevron-right"></i></a>'+
                        '</div>'+
                    '</article>';

            $('.isi_berita').html(content);

        };

    });

    $.getJSON("http://localhost/project_sekolah/index/latest_news_data", function(data) {
        var items = [];
        $.each(data.items, function(i, item) {
            items.push('<li>' + id + '</li>');
        });
        $('#example4').append(items.join(''));
        $('#example4').paginate({itemsPerPage: 3});
    });

});

function detail_berita(id)
{
    
    $.ajax({
        url : "http://localhost/project_sekolah/index/detail_berita_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {
            //success: function(response) {
                var page = "http://localhost/project_sekolah/index/detail_berita/" + id;
                // id;
                window.location.replace(page);

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}