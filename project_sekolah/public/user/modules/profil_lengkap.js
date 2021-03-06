var base_url = 'http://localhost/project_sekolah/';

$(document).ready(function(){
    $.getJSON(base_url+"index/profil_lengkap_data", function(json) {
        var isi='';

            isi +='<article class="course-item">'+
                            '<p class="featured-image page-row"><img class="img-responsive" src="'+base_url+'public/admin/img/profil/'+json.data[0].logo+'" alt=""/></p>'+
                            '<div class="page-row box box-border">'+
                                '<ul class="list-unstyled no-margin-bottom">'+
                                    '<li><strong>Start date:</strong> <em>24 Sep 2014</em></li>'+
                                    '<li><strong>Duration: </strong> <em>1 year</em></li>'+
                                    '<li><strong>Level: </strong> <em>Beginner</em></li>'+
                                    '<li><strong>Location: </strong> <em>Remote(Online)</em></li>'+
                                '</ul>'+
                            '</div><!--//page-row-->'+
                            '<div class="page-row">'+
                                '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vestibulum pellentesque urna. Phasellus adipiscing et massa et aliquam. Ut odio magna, interdum quis dolor non, tristique vestibulum nisi. Nam accumsan convallis venenatis. Nullam posuere risus odio, in interdum felis venenatis sagittis. Integer malesuada porta fermentum. Sed luctus nibh sed mi auctor imperdiet. Cras et sapien rhoncus, pulvinar dolor sed, tincidunt massa. Nullam fringilla mauris non risus ultricies viverra. Donec a turpis non lorem pulvinar posuere.</p>'+
                                '<p>Nulla facilisi. Aenean interdum iaculis odio, et suscipit lorem euismod et. Sed nec orci suscipit, accumsan mauris nec, vestibulum felis. Nam eu felis sem. Fusce ut odio ipsum. Duis orci ipsum, feugiat ac dignissim in, convallis quis tortor. Mauris semper tortor nec justo adipiscing volutpat. Donec suscipit rhoncus est, vitae pretium purus laoreet et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed iaculis risus felis, sit amet porta urna volutpat vel. Integer vestibulum, neque a condimentum fermentum, est nunc tincidunt nunc, eget sagittis turpis elit nec arcu. Curabitur tempus mauris vitae dignissim vehicula. Fusce vehicula malesuada aliquam.</p>'+
                                '<p>Nullam consequat lectus eget fringilla ultricies. Suspendisse potenti. Morbi in malesuada nibh. Morbi vel tellus eu magna tempor mattis. Praesent ut turpis feugiat, dignissim ipsum et, pharetra orci. Nullam in congue felis. Donec commodo metus metus, at faucibus purus convallis ac. Nullam quis tortor urna. In commodo metus sed tempus venenatis. Integer euismod consectetur lobortis. Mauris blandit in massa in rhoncus. Aliquam sit amet sollicitudin nulla. Ut nec mauris facilisis, pretium enim et, tristique risus. Fusce a ligula in velit congue hendrerit eu eget tortor.</p>'+
                            '</div><!--//page-row-->'+
                            '<div class="tabbed-info page-row">'+
                                '<ul class="nav nav-tabs">'+
                                  '<li class="active"><a href="#tab1" data-toggle="tab">Course structure</a></li>'+
                                  '<li><a href="#tab2" data-toggle="tab">Fees</a></li>'+
                                  '<li><a href="#tab3" data-toggle="tab">Entry requirements</a></li>'+
                                '</ul>'+
                                '<div class="tab-content">'+
                                    '<div class="tab-pane active" id="tab1">'+
                                        '<p>Duis ut ornare dui. Ut dapibus porta mattis. Ut eget enim sed nisl tristique lobortis non et dolor. Phasellus et venenatis metus. Duis nisl est, dictum id lacus consequat, tristique placerat orci. Sed porta leo sed lorem rhoncus, et ullamcorper lectus malesuada. </p>'+
                                    '<div class="table-responsive">'+
                                       '<table class="table table-striped">'+
                                            '<thead>'+
                                                '<tr>'+
                                                    '<th>Nullam consequat</th>'+
                                                    '<th>Commodo metus</th>'+
                                                    '<th>Dapibus porta</th>'+
                                                    '<th>Sed porta</th>'+
                                                '</tr>'+
                                            '</thead>'+
                                            '<tbody>'+
                                                '<tr>'+
                                                    '<td>Faucibus purus convallis</td>'+
                                                    '<td>Aliquam sit amet</td>'+
                                                    '<td>Sed porta leo</td>'+
                                                    '<td>Duis ut ornare dui</td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                    '<td>Condimentum fermentum</td>'+
                                                    '<td>Curabitur tempus mauris</td>'+
                                                    '<td>Fusce vehicula malesuada</td>'+
                                                    '<td>Nascetur ridiculus</td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                    '<td>Neque a condimentum</td>'+
                                                    '<td>Cum sociis natoque</td>'+
                                                    '<td>Penatibus magnis</td>'+
                                                    '<td>Curabitur tempus mauris</td>'+
                                                '</tr>'+
                                            '</tbody>'+
                                        '</table>'+
                                   '</div><!--//table-responsive-->'+
                                    '</div>'+
                                    '<div class="tab-pane" id="tab2">'+
                                        '<p>Donec suscipit rhoncus est, vitae pretium purus laoreet et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed iaculis risus felis, sit amet porta urna volutpat vel. Integer vestibulum, neque a condimentum fermentum, est nunc tincidunt nunc, eget sagittis turpis elit nec arcu. Curabitur tempus mauris vitae dignissim vehicula. Fusce vehicula malesuada aliquam.</p>'+
                                        '<ul>'+
                                            '<li><a href="#">Vitae pretium purus</a></li>'+
                                            '<li><a href="#">Eget sagittis turpis </a></li>'+
                                            '<li><a href="#">Curabitur tempus</a></li>'+
                                            '<li><a href="#">Fusce vehicula</a></li>'+
                                        '</ul>'+
                                    '</div>'+
                                    '<div class="tab-pane" id="tab3">'+
                                        '<p>Mauris blandit in massa in rhoncus. Aliquam sit amet sollicitudin nulla. Ut nec mauris facilisis, pretium enim et, tristique risus. Fusce a ligula in velit congue hendrerit eu eget tortor.</p>'+
                                        '<ol>'+
                                            '<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>'+
                                            '<li>Aliquam tincidunt mauris eu risus.</li>'+
                                            '<li>Vestibulum auctor dapibus neque.</li>'+
                                        '</ol>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</article>';
            $('#isi_konten').html(isi);

        // };

    });

});