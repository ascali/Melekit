var save_method; //for save method string
var table,select_konten;
var isi;
var judul;
var base_url = 'http://localhost/project_sekolah/';

$(document).ready(function(){

        $('.fancybox').fancybox();

        $.getJSON("http://localhost/project_sekolah/index/latest_news_data", function(dataCarousel) {
            var imgCarousel = "";
            var imgCarouseli = "";
            var id=0;

            //console.log(dataCarousel.data.length);

            var begin = dataCarousel.data.length - 2;
            var now = dataCarousel.data.length; 
            //console.log(begin);

            for (var i = 0; i < 2; i++) {

                var id = dataCarousel.data[i].id;
                var judul = dataCarousel.data[i].judul;
                var subjudul = judul.substring(0, 25);

                var isi = dataCarousel.data[i].isi;
                var subisi = isi.substring(0, 150);
                imgCarousel += '<div class="col-md-6 news-item" style="padding-left: 0;">'+
                                    '<center>'+
                                        '<h2 class="title"><a title="'+dataCarousel.data[i].judul+'" href="#" onclick="detail_berita('+judul+',true);">'+subjudul+'</a></h2>'+
                                        '<img style="width: 50%; margin-bottom: 14px;" src="http://localhost/project_sekolah/public/admin/img/konten/'+dataCarousel.data[i].gambar+'"  alt="" />'+
                                        '<p>'+subisi+'</p>'+
                                    '</center>'+
                                    '<a class="read-more" href="#" onclick="detail_berita('+id+',true);">Read more<i class="fa fa-chevron-right"></i></a>'+
                                '</div>';
                    
                $('#dataCarousel').html(imgCarousel);
            }

            for (var a = 2; a < 4; a++){
                var id = dataCarousel.data[a].id;

                var judul = dataCarousel.data[a].judul;
                var subjudul = judul.substring(0, 25);

                var isi = dataCarousel.data[a].isi;
                var subisi = isi.substring(0, 150);
                imgCarouseli += '<div class="col-md-6 news-item" style="padding-left: 0;">'+
                                    '<center>'+
                                        '<h2 class="title"><a title="'+judul+'" href="#" onclick="detail_berita('+judul+',true);">'+subjudul+'</a></h2>'+
                                        '<img style="width: 50%; margin-bottom: 14px;" src="http://localhost/project_sekolah/public/admin/img/konten/'+dataCarousel.data[a].gambar+'"  alt="" />'+
                                        '<p>'+subisi+'</p>'+
                                    '</center>'+
                                    '<a class="read-more" href="#" onclick="detail_berita('+id+',true);">Read more<i class="fa fa-chevron-right"></i></a>'+
                                '</div>';
                     console.log("judul",judul);

                $('#dataCarouseli').html(imgCarouseli);
                //console.log(imgCarouseli);
            }
        });

        $.getJSON("http://localhost/project_sekolah/index/artikel_data", function(dataJson) {
            var imgArtikel = "";
            var imgArtikeli = "";
            var id=0;

            //console.log(dataCarousel.data.length);

            var begin = dataJson.data.length - 2;
            var now = dataJson.data.length; 
            //console.log(begin);

            for (var i = 0; i < 2; i++) {

                var id = dataJson.data[i].id;
                var judul = dataJson.data[i].judul;
                var subjudul = judul.substring(0, 25);

                var isi = dataJson.data[i].isi;
                var subisi = isi.substring(0, 150);
                imgArtikel += '<div class="col-md-6 news-item" style="padding-left: 0;">'+
                                    '<center>'+
                                        '<h2 class="title"><a title="'+dataJson.data[i].judul+'" href="#" onclick="detail_berita('+judul+',true);">'+subjudul+'</a></h2>'+
                                        '<img style="width: 50%; margin-bottom: 14px;" src="http://localhost/project_sekolah/public/admin/img/konten/'+dataJson.data[i].gambar+'"  alt="" />'+
                                        '<p>'+subisi+'</p>'+
                                    '</center>'+
                                    '<a class="read-more" href="#" onclick="detail_berita('+id+',true);">Read more<i class="fa fa-chevron-right"></i></a>'+
                                '</div>';
                    
                $('#dataArtikel').html(imgArtikel);
            }

            for (var a = 2; a < 4; a++){
                var id = dataJson.data[a].id;

                var judul = dataJson.data[a].judul;
                var subjudul = judul.substring(0, 25);

                var isi = dataJson.data[a].isi;
                var subisi = isi.substring(0, 150);
                imgArtikeli += '<div class="col-md-6 news-item" style="padding-left: 0;">'+
                                    '<center>'+
                                        '<h2 class="title"><a title="'+judul+'" href="#" onclick="detail_berita('+judul+',true);">'+subjudul+'</a></h2>'+
                                        '<img style="width: 50%; margin-bottom: 14px;" src="http://localhost/project_sekolah/public/admin/img/konten/'+dataJson.data[a].gambar+'"  alt="" />'+
                                        '<p>'+subisi+'</p>'+
                                    '</center>'+
                                    '<a class="read-more" href="#" onclick="detail_berita('+id+',true);">Read more<i class="fa fa-chevron-right"></i></a>'+
                                '</div>';
                     //console.log("judul",judul);

                $('#dataArtikeli').html(imgArtikeli);
                //console.log(imgCarouseli);
            }
        });

        /*$.getJSON("http://localhost/project_sekolah/index/vidio_data", function(dataJson) {
            var imgArtikel = "";
            var imgArtikeli = "";
            var id=0;

            //console.log(dataCarousel.data.length);

            var begin = dataJson.data.length - 2;
            var now = dataJson.data.length; 
            //console.log(begin);

            for (var i = 0; i < 2; i++) {

                var id = dataJson.data[i].id;
                var judul = dataJson.data[i].judul;
                var subjudul = judul.substring(0, 25);

                var isi = dataJson.data[i].isi;
                var subisi = isi.substring(0, 150);
                imgArtikel += '<div class="col-md-6 news-item" style="padding-left: 0;">'+
                                    '<center>'+
                                        '<h2 class="title"><a title="'+dataJson.data[i].judul+'" href="#" onclick="detail_berita('+judul+',true);">'+subjudul+'</a></h2>'+
                                        '<img style="width: 50%; margin-bottom: 14px;" src="http://localhost/project_sekolah/public/admin/img/konten/'+dataJson.data[i].gambar+'"  alt="" />'+
                                        '<p>'+subisi+'</p>'+
                                    '</center>'+
                                    '<a class="read-more" href="#" onclick="detail_berita('+id+',true);">Read more<i class="fa fa-chevron-right"></i></a>'+
                                '</div>';
                    
                $('#dataArtikel').html(imgArtikel);
            }

            for (var a = 2; a < 4; a++){
                var id = dataJson.data[a].id;

                var judul = dataJson.data[a].judul;
                var subjudul = judul.substring(0, 25);

                var isi = dataJson.data[a].isi;
                var subisi = isi.substring(0, 150);
                imgArtikeli += '<div class="col-md-6 news-item" style="padding-left: 0;">'+
                                    '<center>'+
                                        '<h2 class="title"><a title="'+judul+'" href="#" onclick="detail_berita('+judul+',true);">'+subjudul+'</a></h2>'+
                                        '<img style="width: 50%; margin-bottom: 14px;" src="http://localhost/project_sekolah/public/admin/img/konten/'+dataJson.data[a].gambar+'"  alt="" />'+
                                        '<p>'+subisi+'</p>'+
                                    '</center>'+
                                    '<a class="read-more" href="#" onclick="detail_berita('+id+',true);">Read more<i class="fa fa-chevron-right"></i></a>'+
                                '</div>';
                     //console.log("judul",judul);

                $('#dataArtikeli').html(imgArtikeli);
                //console.log(imgCarouseli);
            }
        });*/

        $.getJSON("http://localhost/project_sekolah/index/galeri_data", function(json) {
            var isi='';


            for (var a=0; a < json.data.length; a ++) {
                isi +=  '<li class="col-md-2 col-sm-2 col-xs-4" style="width: 100px; height: 100px; margin-right: 20px; margin-left: 20px;">'+
                            '<a href="#"><img style="    display: block; max-width: 100%;" class=" fancybox" src="http://localhost/project_sekolah/public/admin/img/galeri/'+json.data[a].file+'"  alt="" /></a>'+
                        '</li>';

                $('#isi_galeri').html(isi);

            };

        });

    $("#eventCalendarHumanDate").eventCalendar({
        eventsjson: 'http://localhost/project_sekolah/index/event_data_user',
        jsonDateFormat: 'human' // 'YYYY-MM-DD HH:MM:SS'
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

