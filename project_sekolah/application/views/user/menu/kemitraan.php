<!-- ******CONTENT****** -->
        <div class="page-wrapper">
            <header class="page-heading clearfix">
                <h1 class="heading-title pull-left">Kemitraan SMK Negeri 1 Balongan</h1>
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
                            <div class="page-row box box-border">
                                <ul class="list-unstyled no-margin-bottom">
                                    <li><strong>Kemitraan yang dimiliki SMK Negeri 1 Balongan</strong></li>
                                </ul>
                            </div>
                            <div class="panel panel-info">
                              <div class="panel-body">
                                <div id="kemitraan">
                                    <ol></ol>
                                </div>
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
