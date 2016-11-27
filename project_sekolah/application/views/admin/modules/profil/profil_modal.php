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
                <h3 class="modal-title">Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input name="nama" placeholder=" Nama" max="20" maxlength="20" class="form-control" type="text" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kepala Sekolah</label>
                            <div class="col-md-9">
                                <input name="kepala_sekolah" placeholder=" Kepala Sekolah" max="20" maxlength="20" class="form-control" type="text" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">No Telepon</label>
                            <div class="col-md-9">
                                <input name="telp" placeholder=" No Telepon" max="20" maxlength="20" class="form-control" type="text" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input name="email" placeholder=" Email" max="20" maxlength="20" class="form-control" type="text" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Sejarah</label>
                            <div class="col-md-9">
                                <input name="sejarah" placeholder=" Sejarah" max="20" maxlength="20" class="form-control" type="text" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Program Kerja</label>
                            <div class="col-md-9">
                                <input name="program_kerja" placeholder=" Program Kerja" max="20" maxlength="20" class="form-control" type="text" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fasilitas</label>
                            <div class="col-md-9">
                                <textarea name="fasilitas" row="3" class="form-control"></textarea>
                                <!-- <input name="alamat" placeholder=" Alamat" max="20" maxlength="20" class="form-control" type="text" required=""> -->
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Prestasi Sekolah</label>
                            <div class="col-md-9">
                                <textarea name="prestasi_sekolah" row="3" class="form-control"></textarea>
                                <!-- <input name="alamat" placeholder=" Alamat" max="20" maxlength="20" class="form-control" type="text" required=""> -->
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <input name="alamat" placeholder=" Alamat" max="20" maxlength="20" class="form-control" type="text" required="">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="struktur_organisasi">
                            <label class="control-label col-md-3">Struktur Organisasi</label>
                            <div class="col-md-9">
                                (No Image Struktur Organisasi)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-photo-organisasi-struktur">Upload Image Struktur Organisasi</label>
                            <div class="col-md-9">
                                <input name="struktur_organisasi" type="file">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group" id="logo">
                            <label class="control-label col-md-3">Logo</label>
                            <div class="col-md-9">
                                (No Logo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-logo">Upload Logo </label>
                            <div class="col-md-9">
                                <input name="logo" type="file">
                                <span class="help-block"></span>
                            </div>
                        </div>
                                               
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->