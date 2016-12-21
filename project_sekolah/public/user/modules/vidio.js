var save_method; //for save method string
var table,select_galeri;
var base_url = 'http://localhost/project_sekolah/';

$(document).ready(function(){
    
    $('.fancybox').fancybox(); 

    $.getJSON("http://localhost/project_sekolah/index/vidio_data", function(json) {
        var isi='';


        for (var a=0; a < json.data.length; a ++) {
            isi +=  '<iframe class="col-md-3 col-sm-3 col-xs-6" src="http://www.youtube.com/embed/'+json.data[a].link+'" frameborder="0" width="300" height="200"></iframe>';
            $('.isi_video').html(isi);

        };

    });

    $.getJSON("http://localhost/project_sekolah/index/vidio_data", function(data) {
        var items = [];
        $.each(data.items, function(i, item) {
            items.push('<li>' + id + '</li>');
        });
        $('#example4').append(items.join(''));
        $('#example4').paginate({itemsPerPage: 4});
    });

});