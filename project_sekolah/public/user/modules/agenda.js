var save_method; //for save method string
var table,select_galeri;
var base_url = 'http://localhost/project_sekolah/';

$(document).ready(function(){
    
    $('.fancybox').fancybox(); 

    $.getJSON("http://localhost/project_sekolah/index/agenda_data", function(json) {
        var content='';


        for (var a=0; a<json.data.length; a++) {
            
            var id = json.data[a].id;
            //var isi = json.data[a].isi;
            //var subisi = isi.substring(0, 150);

            var date = json.data[a].date;
            var title = json.data[a].title;
            var type = json.data[a].type;
            var description = json.data[a].description;
            
            content +=  '<article class="news-item page-row has-divider clearfix row">'+
                        //'<figure class="thumb col-md-2 col-sm-3 col-xs-4">'+
                        //    '<img class="img-responsive" src="http://localhost/project_sekolah/public/admin/img/konten/'+json.data[a].gambar+'" alt="" />'+
                        //'</figure>'+
                        '<div class="details col-md-10 col-sm-9 col-xs-8">'+
                            '<h3 class="title"><a href="news-single.html">'+title+'</a></h3>'+
                            '<p class="meta text-muted">By: <a href="#">'+json.data[a].create_by+'</a> | Posted on: '+json.data[a].created+'</p>'+
                            '<p> Tanggal: '+date+'</p>'+
                            '<p> Type Event: '+type+'</p>'+
                            '<p> Description: '+description+'</p>'+
                        '</div>'+
                    '</article>';

            $('.isi_artikel').html(content);



        };

    });

    $.getJSON("http://localhost/project_sekolah/index/agenda_data", function(data) {
        var items = [];
        $.each(data.items, function(i, item) {
            items.push('<li>' + id + '</li>');
        });
        $('#example4').append(items.join(''));
        $('#example4').paginate({itemsPerPage: 4});
    });

});

/*function detail_artikel(id)
{
    
    $.ajax({
        url : "http://localhost/project_sekolah/index/detail_artikel_data/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(dataRow)
        {
            //success: function(response) {
                var page = "http://localhost/project_sekolah/index/detail_artikel/" + id;
                // id;
                window.location.replace(page);

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}*/