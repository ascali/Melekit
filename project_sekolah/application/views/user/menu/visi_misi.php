<!-- ******CONTENT****** -->
        <div class="page-wrapper">
            <header class="page-heading clearfix">
                <h1 class="heading-title pull-left">Visi dan Misi SMK Negeri 1 Balongan</h1>
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
                                    <li><strong>Visi</strong></li>
                                </ul>
                            </div>
                            <div class="panel panel-info">
                              <div class="panel-body">
                                <p class="page-row" id="visi"></p>
                              </div>
                            </div>

                            <div class="page-row box box-border">
                                <ul class="list-unstyled no-margin-bottom">
                                    <li><strong>Misi</strong></li>
                                </ul>
                            </div>
                            <div class="panel panel-info">
                              <div class="panel-body">
                                <p class="page-row" id="misi"></p>
                              </div>
                            </div>

                        </article><!--//course-item-->
                    </div><!--//course-wrapper-->
                    <aside class="page-sidebar  col-md-3 col-md-offset-1 col-sm-4 col-sm-offset-1">
                        <section class="widget">
                            <ul class="nav" style="margin-top: 20px;">
                                <li><a href="<?=base_url();?>index/profil_sekolah">Profil Sekolah</a></li>
                                <li><a href="<?=base_url();?>index/struktur_organisasi">Struktur Organisasi</a></li>
                                <li><a href="<?=base_url();?>index/sejarah">Sejarah</a></li>
                                <li class="active"><a href="<?=base_url();?>index/visi_misi">Visi Misi</a></li>
                                <li><a href="<?=base_url();?>index/fasilitas">Fasilitas</a></li>
                            </ul>                    
                        </section>
                        <?php $this->load->view('user/menu/aside_content'); ?>
                    </aside>
                </div><!--//page-row-->
            </div><!--//page-content-->
        </div>
