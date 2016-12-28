            <div class="page-wrapper">
                <header class="page-heading clearfix">
                    <h1 class="heading-title pull-left">Lowongan Kerja</h1>
                    <div class="breadcrumbs pull-right">
                        <ul class="breadcrumbs-list">
                            <li class="breadcrumbs-label">You are here:</li>
                            <li><a href="<?php echo base_url('index'); ?>">Home</a><i class="fa fa-angle-right"></i></li>
                            <li class="current">Lowongan Kerja</li>
                        </ul>
                    </div>
                </header> 
                <div class="page-content">
                    <div class="row page-row">
                        <div class="news-wrapper col-md-8 col-sm-7" id="isi_loker">
                            <ul id="example4" class="isi_loker">
                            </ul>
                            <div id="example4-pagination" style="margin-top: 12px; float: right; margin-bottom: 12px;">
                                <a id="example4-previous" href="#">&laquo; Previous</a> 
                                <a id="example4-next" href="#">Next &raquo;</a> 
                            </div>
                            <!-- <ul class="pagination">
                                <li class="disabled"><a href="#">&laquo;</a></li>
                                <li class="active"><a href="#">1<span class="sr-only">(current)</span></a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">&raquo;</a></li>
                            </ul> -->
                        </div>
                        <aside class="page-sidebar  col-md-3 col-md-offset-1 col-sm-4 col-sm-offset-1">                    
                            <section class="widget has-divider">
                                <h3 class="title">Arcu Aliquet Quam Vel</h3>
                                <p>Maecenas nisl urna, condimentum ac justo a, adipiscing hendrerit magna. Fusce pharetra laoreet accumsan. Phasellus elit sapien, consequat vel sapien sit amet, condimentum vulputate odio. Aliquam fringilla justo quis est placerat, eu imperdiet lorem cursus. Curabitur pretium nulla lorem, sed egestas ante vestibulum dignissim.</p>
                            </section><!--//widget-->
                            <?php $this->load->view('user/menu/aside_content'); ?>
                        </aside>
                    </div>
                </div>
            </div> 