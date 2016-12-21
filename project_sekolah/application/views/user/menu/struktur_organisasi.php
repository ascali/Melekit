    <!-- ******CONTENT****** --> 
            <div class="page-wrapper">
                <header class="page-heading clearfix">
                    <h1 class="heading-title pull-left">Struktur Organisasi SMK Negeri 1 Balongan</h1>
                    <div class="breadcrumbs pull-right">
                        <ul class="breadcrumbs-list">
                            <li class="breadcrumbs-label">You are here:</li>
                        <li><a href="index.html"><?=$this->uri->segment(1)?></a><i class="fa fa-angle-right"></i></li>
                        <li><a href="courses.html"><?=$this->uri->segment(2)?></a><i class="fa fa-angle-right"></i></li>
                            <li class="current">SMK Negeri 1 Balongan</li>
                        </ul>
                    </div><!--//breadcrumbs-->
                </header> 
                <div class="page-content">
                    <div class="row page-row">
                        <div class="course-wrapper col-md-8 col-sm-7">                         
                            <article class="course-item">
                                <div class="panel panel-info">
                                  <div class="panel-body">
                                    <p class="featured-image page-row" id="struktur_organisasi"></p>
                                  </div>
                                </div>
                            </article><!--//course-item-->                                              
                        </div><!--//course-wrapper-->
                        <aside class="page-sidebar  col-md-3 col-md-offset-1 col-sm-4 col-sm-offset-1">
                        <?php $this->load->view('user/menu/aside_content'); ?>
                    </aside>
                    </div><!--//page-row-->
                </div><!--//page-content-->
            </div><!--//page--> 