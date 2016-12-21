var save_method; //for save method string
var table,select_galeri;
var base_url = 'http://localhost/project_sekolah/';

$(document).ready(function(){
    
    $('.fancybox').fancybox(); 

    $.getJSON("http://localhost/project_sekolah/index/galeri_data", function(json) {
        var isi='';


        for (var a=0; a < json.data.length; a ++) {
            isi +=  '<a class="fancybox col-md-3 col-sm-3 col-xs-6" title="'+json.data[a].nama+'" href="http://localhost/project_sekolah/public/admin/img/galeri/'+json.data[a].file+'"><img class="img-responsive img-thumbnail" src="http://localhost/project_sekolah/public/admin/img/galeri/'+json.data[a].file+'" alt="" /></a>';
            $('.isi_galeri').html(isi);

        };

    });

    $.getJSON("http://localhost/project_sekolah/index/galeri_data", function(data) {
        var items = [];
        $.each(data.items, function(i, item) {
            items.push('<li>' + id + '</li>');
        });
        $('#example4').append(items.join(''));
        $('#example4').paginate({itemsPerPage: 4});
    });

});