                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                      <br>
                      <li>
                        <div class="" style="margin-left: 10px;">
                          Username :
                          <?php echo $_SESSION['username']; ?>
                          <br>
                          Level :
                          <?php echo $_SESSION['level']; ?>
                          <hr>
                        </div>
                      </li>
                        <!-- <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                        </li> -->
                        <li>
                            <a href="<?=base_url('administrator/dashboard')?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-institution fa-fw"></i> Sekolah <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=base_url();?>administrator/profil">Profil</a>
                                </li>
                                <li>
                                    <a href="<?=base_url();?>administrator/visi_misi">Visi & Misi</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="<?=base_url('administrator/users')?>"><i class="fa fa-users fa-fw"></i> Users</a>
                        </li>
                        <li>
                            <a href="<?=base_url('administrator/kelas')?>"><i class="fa fa-tasks fa-fw"></i> Kelas</a>
                        </li>
                        <li>
                            <a href="<?=base_url('administrator/siswa')?>"><i class="fa fa-user fa-fw"></i> Siswa</a>
                        </li>
                        <li>
                            <a href="<?=base_url('administrator/kategori_konten')?>"><i class="fa fa-bars fa-fw"></i> Kategori konten</a>
                        </li>
                        <li>
                            <a href="<?=base_url('administrator/menu')?>"><i class="fa fa-th-list fa-fw"></i> Menu</a>
                        </li>
                        <li>
                            <a href="<?=base_url('administrator/submenu')?>"><i class="fa fa-list-ol fa-fw"></i> Submenu</a>
                        </li>
                        <li>
                            <a href="<?=base_url('administrator/konten')?>"><i class="fa fa-file-text fa-fw"></i> Konten</a>
                        </li>
                        <li>
                            <a href="<?=base_url('administrator/komentar')?>"><i class="fa fa-comments-o fa-fw"></i> Komentar</a>
                        </li>
                        <!-- <li>
                            <a href="<?=base_url();?>administrator/profil"><i class="fa fa-table fa-fw"></i>Profil</a>
                        </li> -->

                    </ul>
                </div>
