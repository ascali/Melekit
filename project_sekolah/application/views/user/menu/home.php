
            <div id="promo-slider" class="slider flexslider">
                <ul class="slides">
                <?php 
                    foreach ($data as $gambar_slide):
                ?>
                    <li>
                        <img src="<?php echo base_url('public/admin/img/galeri/'); ?><?php echo $gambar_slide->file; ?>" alt="" width="5%" heigth="10px">
                        <p class="flex-caption">
                            <span class="main" ><?php echo $gambar_slide->nama; ?></span>
                            <br />
                            <span class="secondary clearfix" ><?php echo $gambar_slide->keterangan; ?></span>
                        </p>
                    </li>
                    
                <?php 
                    endforeach;
                ?>
                </ul>
            </div>
            <!--//flexslider-->

            <section class="promo box box-dark">        
                <div class="col-md-9">
                <h1 class="section-heading">Why College Green</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed bibendum orci eget nulla mattis, quis viverra tellus porta. Donec vitae neque ut velit eleifend commodo. Maecenas turpis odio, placerat eu lorem ut, suscipit commodo augue.  </p>   
                </div>  
                <div class="col-md-3">
                    <a class="btn btn-cta" href="#"><i class="fa fa-play-circle"></i>Apply Now</a>  
                </div>
            </section>
            <!--//promo-->
            
            <section class="course-finder">
                <h1 class="section-heading text-highlight"><span class="line">Sambutan</span></h1>
                <div class="section-content">
                    <div class="row">
                        <div class="col-md-12 news-item">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vestibulum pellentesque urna. Phasellus adipiscing et massa et aliquam. Ut odio magna, interdum quis dolor non, tristique vestibulum nisi. Nam accumsan convallis venenatis. Nullam posuere risus odio, in interdum felis venenatis sagittis. Integer malesuada porta fermentum. Sed luctus nibh sed mi auctor imperdiet. Cras et sapien rhoncus, pulvinar dolor sed, tincidunt massa. Nullam fringilla mauris non risus ultricies viverra. Donec a turpis non lorem pulvinar posuere.

                            <!-- Nulla facilisi. Aenean interdum iaculis odio, et suscipit lorem euismod et. Sed nec orci suscipit, accumsan mauris nec, vestibulum felis. Nam eu felis sem. Fusce ut odio ipsum. Duis orci ipsum, feugiat ac dignissim in, convallis quis tortor. Mauris semper tortor nec justo adipiscing volutpat. Donec suscipit rhoncus est, vitae pretium purus laoreet et. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed iaculis risus felis, sit amet porta urna volutpat vel. Integer vestibulum, neque a condimentum fermentum, est nunc tincidunt nunc, eget sagittis turpis elit nec arcu. Curabitur tempus mauris vitae dignissim vehicula. Fusce vehicula malesuada aliquam.

                            Nullam consequat lectus eget fringilla ultricies. Suspendisse potenti. Morbi in malesuada nibh. Morbi vel tellus eu magna tempor mattis. Praesent ut turpis feugiat, dignissim ipsum et, pharetra orci. Nullam in congue felis. Donec commodo metus metus, at faucibus purus convallis ac. Nullam quis tortor urna. In commodo metus sed tempus venenatis. Integer euismod consectetur lobortis. Mauris blandit in massa in rhoncus. Aliquam sit amet sollicitudin nulla. Ut nec mauris facilisis, pretium enim et, tristique risus. Fusce a ligula in velit congue hendrerit eu eget tortor. -->
                        </div> 
                    </div>  
                </div><!--//section-content-->
            </section><!--//course-finder-->
            <!--//news-->

            <div class="row cols-wrapper">
                <div class="col-md-3">
                    <section class="links">
                        <h1 class="section-heading text-highlight"><span class="line">Lowongan kerja</span></h1>
                        <div class="section-content">
                            <p><a href="#"><i class="fa fa-caret-right"></i>E-learning Portal</a></p>
                            <p><a href="#"><i class="fa fa-caret-right"></i>Gallery</a></p>
                            <p><a href="#"><i class="fa fa-caret-right"></i>Job Vacancies</a></p>
                            <p><a href="#"><i class="fa fa-caret-right"></i>Contact</a></p>
                        </div><!--//section-content-->
                    </section><!--//links-->

                    <section class="links">
                        <!-- <h1 class="section-heading text-highlight"><span class="line">Calendar</span></h1> -->
                        <div class="section-content">
                            <div id="eventCalendarHumanDate"></div>
                        </div>
                    </section>
                    
                </div><!--//col-md-3-->
                <div class="col-md-6">
                    <!-- Berita Terbaru -->
                    <section class="news">
                        <h1 class="section-heading text-highlight"><span class="line">BERITA TERBARU</span></h1>     
                        <div class="carousel-controls">
                            <a class="prev" href="#news-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
                            <a class="next" href="#news-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a>
                        </div><!--//carousel-controls--> 
                        <div class="section-content clearfix">
                            <div id="news-carousel" class="news-carousel carousel slide">
                                <div class="carousel-inner" style="margin-top: 1%;">
                                    <div class="item active" id="dataCarousel">

                                    </div>
                                    <div class="item" id="dataCarouseli">

                                    </div>
                                </div><!--//carousel-inner-->
                            </div><!--//news-carousel-->  
                        </div><!--//section-content-->     
                    </section>

                    <!-- Artikel Terbaru -->
                    <!-- <section class="news">
                        <h1 class="section-heading text-highlight"><span class="line">ARTIKEL TERBARU</span></h1>     
                        <div class="carousel-controls">
                            <a class="prev" href="#artikel-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
                            <a class="next" href="#artikel-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a>
                        </div> 
                        <div class="section-content clearfix">
                            <div id="news-carousel" class="news-carousel carousel slide">
                                <div class="carousel-inner" style="margin-top: 1%;">
                                    <div class="item active"> 
                                        <div class="col-md-6 news-item" style="padding-left: 0;">
                                            <center>
                                            <h2 class="title"><a href="news-single.html">Morbi at vestibulum turpis</a></h2>
                                                <img style="width: 50%;" src="<?php echo base_url('public/user/test/images/news/news-thumb-2.jpg'); ?>"  alt="" />
                                            </center><br>
                                            <p>Nam feugiat erat vel neque mollis, non vulputate erat aliquet. Maecenas ac leo porttitor, semper risus condimentum, cursus elit. Vivamus vitae libero tellus.</p>
                                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>
                                            
                                        </div>
                                        <div class="col-md-6 news-item" style="padding-left: 0;">
                                            <h2 class="title"><a href="news-single.html">Aliquam id iaculis urna</a></h2>
                                            <center>
                                                <img style="width: 50%" src="<?php echo base_url('public/user/test/images/news/news-thumb-3.jpg'); ?>"  alt="" />
                                            </center><br>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam bibendum mauris eget sapien consectetur pellentesque. Proin elementum tristique euismod. </p>
                                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>
                                            
                                        </div>
                                    </div>
                                        <div class="col-md-6 news-item" style="padding-left: 0;">
                                            <center>
                                            <h2 class="title"><a href="news-single.html">Morbi at vestibulum turpis</a></h2>
                                                <img style="width: 50%;" src="<?php echo base_url('public/user/test/images/news/news-thumb-2.jpg'); ?>"  alt="" />
                                            </center><br>
                                            <p>Nam feugiat erat vel neque mollis, non vulputate erat aliquet. Maecenas ac leo porttitor, semper risus condimentum, cursus elit. Vivamus vitae libero tellus.</p>
                                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>
                                            
                                        </div>
                                        <div class="col-md-6 news-item" style="padding-left: 0;">
                                            <h2 class="title"><a href="news-single.html">Aliquam id iaculis urna</a></h2>
                                            <center>
                                                <img style="width: 50%" src="<?php echo base_url('public/user/test/images/news/news-thumb-3.jpg'); ?>"  alt="" />
                                            </center><br>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam bibendum mauris eget sapien consectetur pellentesque. Proin elementum tristique euismod. </p>
                                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>   
                    </section> -->

                    <section class="news">
                        <h1 class="section-heading text-highlight"><span class="line">Artikel TERBARU</span></h1>     
                        <div class="carousel-controls">
                            <a class="prev" href="#artikel-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
                            <a class="next" href="#artikel-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a>
                        </div><!--//carousel-controls--> 
                        <div class="section-content clearfix">
                            <div id="artikel-carousel" class="artikel-carousel carousel slide">
                                <div class="carousel-inner" style="margin-top: 1%;">
                                    <div class="item active" id="dataArtikel">

                                    </div>
                                    <div class="item" id="dataArtikeli">

                                    </div>
                                </div><!--//carousel-inner-->
                            </div><!--//news-carousel-->  
                        </div><!--//section-content-->     
                    </section>
                </div>
                <div class="col-md-3">
                    <section class="links">
                        <h1 class="section-heading text-highlight"><span class="line">Vooting</span></h1>
                        <div class="section-content">
                            <p><a href="#"><i class="fa fa-caret-right"></i>E-learning Portal</a></p>
                            <p><a href="#"><i class="fa fa-caret-right"></i>Gallery</a></p>
                            <p><a href="#"><i class="fa fa-caret-right"></i>Job Vacancies</a></p>
                            <p><a href="#"><i class="fa fa-caret-right"></i>Contact</a></p>
                        </div><!--//section-content-->
                    </section><!--//links-->
                    <section class="testimonials">
                        <h1 class="section-heading text-highlight"><span class="line"> Testimonials</span></h1>
                        <div class="carousel-controls">
                            <a class="prev" href="#testimonials-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
                            <a class="next" href="#testimonials-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a>
                        </div><!--//carousel-controls-->
                        <div class="section-content">
                            <div id="testimonials-carousel" class="testimonials-carousel carousel slide">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <blockquote class="quote">                                  
                                            <p><i class="fa fa-quote-left"></i>I’m very happy interdum eget ipsum. Nunc pulvinar ut nulla eget sollicitudin. In hac habitasse platea dictumst. Integer mattis varius ipsum, posuere posuere est porta vel. Integer metus ligula, blandit ut fermentum a, rhoncus in ligula. Duis luctus.</p>
                                        </blockquote>                
                                        <div class="row">
                                            <p class="people col-md-8 col-sm-3 col-xs-8"><span class="name">Marissa Spencer</span><br /><span class="title">Curabitur commodo</span></p>
                                            <img class="profile col-md-4 pull-right" src="<?php echo base_url('public/user/test/images/testimonials/profile-1.png'); ?>"  alt="" />
                                        </div>                               
                                    </div><!--//item-->
                                    <div class="item">
                                        <blockquote class="quote">
                                            <p><i class="fa fa-quote-left"></i>
                                            I'm very pleased commodo gravida ultrices. Sed massa leo, aliquet non velit eu, volutpat vulputate odio. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse porttitor metus eros, ut fringilla nulla auctor a.</p>
                                        </blockquote>
                                        <div class="row">
                                            <p class="people col-md-8 col-sm-3 col-xs-8"><span class="name">Marco Antonio</span><br /><span class="title"> Gravida ultrices</span></p>
                                            <img class="profile col-md-4 pull-right" src="<?php echo base_url('public/user/test/images/testimonials/profile-2.png'); ?>"  alt="" />
                                        </div>                 
                                    </div><!--//item-->
                                    <div class="item">
                                        <blockquote class="quote">
                                            <p><i class="fa fa-quote-left"></i>
                                            I'm delighted commodo gravida ultrices. Sed massa leo, aliquet non velit eu, volutpat vulputate odio. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse porttitor metus eros, ut fringilla nulla auctor a.</p>
                                        </blockquote>
                                        <div class="row">
                                            <p class="people col-md-8 col-sm-3 col-xs-8"><span class="name">Kate White</span><br /><span class="title"> Gravida ultrices</span></p>
                                            <img class="profile col-md-4 pull-right" src="<?php echo base_url('public/user/test/images/testimonials/profile-3.png'); ?>"  alt="" />
                                        </div>                 
                                    </div><!--//item-->
                                    
                                </div><!--//carousel-inner-->
                            </div><!--//testimonials-carousel-->
                        </div><!--//section-content-->
                    </section><!--//testimonials-->
                    <section class="links">
                        <h1 class="section-heading text-highlight"><span class="line">Materi Baru</span></h1>
                        <div class="section-content">
                            <p><a href="#"><i class="fa fa-caret-right"></i>E-learning Portal</a></p>
                            <p><a href="#"><i class="fa fa-caret-right"></i>Gallery</a></p>
                            <p><a href="#"><i class="fa fa-caret-right"></i>Job Vacancies</a></p>
                            <p><a href="#"><i class="fa fa-caret-right"></i>Contact</a></p>
                        </div><!--//section-content-->
                    </section><!--//links-->
                </div><!--//col-md-3-->
            </div><!--//cols-wrapper-->

            <div class="row cols-wrapper">
                <div class="col-md-8">
                    <section class="news" style="padding-bottom: 4%;">
                        <h1 class="section-heading text-highlight"><span class="line">Images</span></h1>     
                        <div class="carousel-controls">
                            <a class="prev" href="#galeri-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
                            <a class="next" href="#galeri-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a>
                        </div><!--//carousel-controls--> 
                        <div class="section-content clearfix">
                            <div id="news-carousel" class="news-carousel carousel slide">
                                <div class="carousel-inner" style="margin-top: 4%;">
                                    <div class="item active"> 
                                        <div class="col-md-6 news-item">
                                            <h2 class="title"><a href="news-single.html">Morbi at vestibulum turpis</a></h2>
                                            <p>Nam feugiat erat vel neque mollis, non vulputate erat aliquet. Maecenas ac leo porttitor, semper risus condimentum, cursus elit. Vivamus vitae libero tellus.</p>
                                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>
                                            <img class="thumb" src="<?php echo base_url('public/user/test/images/news/news-thumb-2.jpg'); ?>"  alt="" />
                                        </div><!--//news-item-->
                                        <div class="col-md-6 news-item">
                                            <h2 class="title"><a href="news-single.html">Aliquam id iaculis urna</a></h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam bibendum mauris eget sapien consectetur pellentesque. Proin elementum tristique euismod. </p>
                                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>
                                            <img class="thumb" src="<?php echo base_url('public/user/test/images/news/news-thumb-3.jpg'); ?>"  alt="" />
                                        </div><!--//news-item-->
                                    </div><!--//item-->
                                    <div class="item"> 
                                        <div class="col-md-4 news-item">
                                            <h2 class="title"><a href="news-single.html">Phasellus scelerisque metus</a></h2>
                                            <img class="thumb" src="<?php echo base_url('public/user/test/images/news/news-thumb-4.jpg'); ?>"  alt="" />
                                            <p>Suspendisse purus felis, porttitor quis sollicitudin sit amet, elementum et tortor. Praesent lacinia magna in malesuada vestibulum. Pellentesque urna libero.</p>
                                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>                
                                        </div><!--//news-item-->
                                        <div class="col-md-4 news-item">
                                            <h2 class="title"><a href="news-single.html">Morbi at vestibulum turpis</a></h2>
                                            <p>Nam feugiat erat vel neque mollis, non vulputate erat aliquet. Maecenas ac leo porttitor, semper risus condimentum, cursus elit. Vivamus vitae libero tellus.</p>
                                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>
                                            <img class="thumb" src="<?php echo base_url('public/user/test/images/news/news-thumb-5.jpg'); ?>"  alt="" />
                                        </div><!--//news-item-->
                                        <div class="col-md-4 news-item">
                                            <h2 class="title"><a href="news-single.html">Aliquam id iaculis urna</a></h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam bibendum mauris eget sapien consectetur pellentesque. Proin elementum tristique euismod. </p>
                                            <a class="read-more" href="news-single.html">Read more<i class="fa fa-chevron-right"></i></a>
                                            <img class="thumb" src="<?php echo base_url('public/user/test/images/news/news-thumb-6.jpg'); ?>"  alt="" />
                                        </div><!--//news-item-->
                                    </div><!--//item-->
                                </div><!--//carousel-inner-->
                            </div><!--//news-carousel-->  
                        </div><!--//section-content-->     
                    </section>
                </div>
                <div class="col-md-4">
                    <section class="video" style="height: 12%">
                        <h1 class="section-heading text-highlight"><span class="line">Videos</span></h1>
                        <div class="carousel-controls">
                            <a class="prev" href="#videos-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
                            <a class="next" href="#videos-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a>
                        </div><!--//carousel-controls-->
                        <div class="section-content">    
                           <div id="videos-carousel" class="videos-carousel carousel slide">
                                <div class="carousel-inner">
                                    <div class="item active">            
                                        <iframe style="height: 12%" class="video-iframe" src="http://www.youtube.com/embed/r9LelXa3U_I?rel=0&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe>
                                    </div><!--//item-->
                                    <div class="item">            
                                        <iframe style="height: 12%" class="video-iframe" src="http://www.youtube.com/embed/RcGyVTAoXEU?rel=0&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe>
                                    </div><!--//item-->
                                    <div class="item">            
                                        <iframe style="height: 12%" class="video-iframe" src="http://www.youtube.com/embed/Ks-_Mh1QhMc?rel=0&amp;wmode=transparent" frameborder="0" allowfullscreen=""></iframe>
                                    </div><!--//item-->
                                </div><!--//carousel-inner-->
                           </div><!--//videos-carousel-->                            
                            <p class="description">Aenean feugiat a diam tempus sodales. Quisque lorem nulla, ultrices imperdiet malesuada at, suscipit vel lorem. Nulla dignissim nisi ac aliquet semper.</p>
                        </div><!--//section-content-->
                    </section><!--//video-->

                    <section class="news">
                        <h1 class="section-heading text-highlight"><span class="line">Artikel TERBARU</span></h1>     
                        <div class="carousel-controls">
                            <a class="prev" href="#artikel-carousel" data-slide="prev"><i class="fa fa-caret-left"></i></a>
                            <a class="next" href="#artikel-carousel" data-slide="next"><i class="fa fa-caret-right"></i></a>
                        </div><!--//carousel-controls--> 
                        <div class="section-content clearfix">
                            <div id="artikel-carousel" class="artikel-carousel carousel slide">
                                <div class="carousel-inner" style="margin-top: 1%;">
                                    <div class="item active" id="dataArtikel">

                                    </div>
                                    <div class="item" id="dataArtikeli">

                                    </div>
                                </div>
                            </div>  
                        </div>     
                    </section>
                </div>
            </div>

            <section class="awards">
                <div id="awards-carousel" class="awards-carousel carousel slide">
                    <div class="carousel-inner">
                        <div class="item active">
                            <ul class="logos" id="isi_galeri">
                                <li class="col-md-2 col-sm-2 col-xs-4">
                                    <a href="#"><img class="img-responsive" src="<?php echo base_url('public/user/test/images/awards/award1.jpg'); ?>"  alt="" /></a>
                                </li>
                                <li class="col-md-2 col-sm-2 col-xs-4">
                                    <a href="#"><img class="img-responsive" src="<?php echo base_url('public/user/test/images/awards/award2.jpg'); ?>"  alt="" /></a>
                                </li>
                                <li class="col-md-2 col-sm-2 col-xs-4">
                                    <a href="#"><img class="img-responsive" src="<?php echo base_url('public/user/test/images/awards/award3.jpg'); ?>"  alt="" /></a>
                                </li>
                                <li class="col-md-2 col-sm-2 col-xs-4">
                                    <a href="#"><img class="img-responsive" src="<?php echo base_url('public/user/test/images/awards/award4.jpg'); ?>"  alt="" /></a>
                                </li>
                                <li class="col-md-2 col-sm-2 col-xs-4">
                                    <a href="#"><img class="img-responsive" src="<?php echo base_url('public/user/test/images/awards/award5.jpg'); ?>"  alt="" /></a>
                                </li>
                                <li class="col-md-2 col-sm-2 col-xs-4">
                                    <a href="#"><img class="img-responsive" src="<?php echo base_url('public/user/test/images/awards/award6.jpg'); ?>"  alt="" /></a>
                                </li>             
                            </ul><!--//slides-->
                        </div><!--//item-->
                        
                        <div class="item">
                            <ul class="logos">
                                <li class="col-md-2 col-sm-2 col-xs-4">
                                    <img class="img-responsive" src="<?php echo base_url('public/user/test/images/awards/award7.jpg'); ?>"  alt="" />
                                </li>
                                <li class="col-md-2 col-sm-2 col-xs-4">
                                    <img class="img-responsive" src="<?php echo base_url('public/user/test/images/awards/award6.jpg'); ?>"  alt="" />
                                </li>
                                <li class="col-md-2 col-sm-2 col-xs-4">
                                    <img class="img-responsive" src="<?php echo base_url('public/user/test/images/awards/award6.jpg'); ?>"  alt="" />
                                </li>
                                <li class="col-md-2 col-sm-2 col-xs-4">
                                    <img class="img-responsive" src="<?php echo base_url('public/user/test/images/awards/award4.jpg'); ?>"  alt="" />
                                </li>
                                <li class="col-md-2 col-sm-2 col-xs-4">
                                    <img class="img-responsive" src="<?php echo base_url('public/user/test/images/awards/award3.jpg'); ?>"  alt="" />
                                </li>
                                <li class="col-md-2 col-sm-2 col-xs-4">
                                    <img class="img-responsive" src="<?php echo base_url('public/user/test/images/awards/award2.jpg'); ?>"  alt="" />
                                </li>             
                            </ul><!--//slides-->
                        </div><!--//item-->
                    </div><!--//carousel-inner-->
                    <a class="left carousel-control" href="#awards-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right carousel-control" href="#awards-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </section>