<!-- ******CONTENT****** --> 
        <div class="content container">
            <div class="page-wrapper">
                <header class="page-heading clearfix">
                    <h1 class="heading-title pull-left">Tables</h1>
                    <div class="breadcrumbs pull-right">
                        <ul class="breadcrumbs-list">
                            <li class="breadcrumbs-label">You are here:</li>
                            <li><a href="<?php echo base_url('index'); ?>"><?=$this->uri->segment(1)?></a><i class="fa fa-angle-right"></i></li>
                            <li><a href=""><?=$this->uri->segment(2)?></a><i class="fa fa-angle-right"></i></li>
                            <li class="current">All List</li>
                        </ul>
                    </div>
                </header> 
                <div class="page-content">
                    <div class="row page-row">
                        <aside class="page-sidebar col-md-2 col-sm-4 affix-top">                    
                            <section class="widget">
                                <ul class="nav">
                                    <li><a href="typography.html">Typography</a></li>
                                    <li class="active"><a href="#">Tables</a></li>
                                    <li><a href="buttons.html">Buttons</a></li>
                                    <li><a href="components.html">Components</a></li>
                                     <li><a href="icons.html">Icons</a></li>
                                </ul>                    
                            </section><!--//widget-->
                        </aside><!--//page-sidebar-->
                        <div class="content-wrapper col-md-10 col-sm-8">  
                            <div class="page-row">
                                <h3 class="has-divider text-highlight">All List Direktori Siswa</h3>
                                <!-- <div class="table-responsive"> -->                      
                                <div class="panel-body">
                                    <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" style="width: 100%" id="direktori_siswa">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NIS</th>
                                                <th>Name</th>
                                                <th>Jurusan</th>
                                                <th>Kelas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        </tbody>
                                    </table><!--//table-->
                                    </div>
                                </div>
                                <!-- </div> --><!--//table-responsive-->                            
                            </div><!--//page-row-->                                                                    
                        </div><!--//content-wrapper-->                    
                    </div><!--//page-row-->
                </div><!--//page-content-->
            </div><!--//page--> 
        </div><!--//content-->


<!-- Modal -->
<script type="text/javascript">
    // var edit="";
    // var del="";
</script>
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog"  data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title"></h3>
            </div>
            <div class="modal-body" style="padding: 0">
                <!-- <form action="#" id="form" class="form-horizontal"> -->
                    <!-- <div class="form-body"> -->
                    <div class="row" style="margin-top: 20px;">    
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Nama</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">NIP</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">NUPTK</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Jenis Kelamin</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" id="nama" style="font-weight: 100;"></label>
                                </div>
                                <div class="form-group" >
                                    <label class="control-label" id="nip" style="font-weight: 100;"></label>
                                </div>
                                <div class="form-group" >
                                    <label class="control-label" id="nuptk" style="font-weight: 100;"></label>
                                </div>
                                <div class="form-group" >
                                    <label class="control-label" id="kelamin" style="font-weight: 100;"></label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" id="foto">
                                    <div class="col-md-12">
                                        (No photo)
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Tempat Tanggal Lahir</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Pelajaran/Jabatan</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label" id="ttl" style="font-weight: 100;"></label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" id="pelajaran_jabatan" style="font-weight: 100;"></label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" id="status" style="font-weight: 100;"></label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                

                                <div class="form-group">
                                    <label class="control-label">Blog/Web</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Alamat</label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">Prestasi</label>
                                </div>                                
                            </div>
                            <div class="col-md-3">
                                

                                <div class="form-group">
                                    <label class="control-label" id="blog" style="font-weight: 100;"></label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" id="alamat" style="font-weight: 100;"></label>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" id="prestasi" style="font-weight: 100;"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                <!-- </form> -->
            </div>
            <!-- <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary update-button">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div> -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
