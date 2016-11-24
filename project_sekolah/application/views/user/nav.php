<!-- ******NAV****** -->
        <nav class="main-nav" data-spy="affix" data-offset-top="197" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active nav-item"><a href="<?=base_url();?>index">Home</a></li>
                        <!-- Profil -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Profil <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                              <li><a href="<?=base_url();?>index/program_sekolah">Program Sekolah</a></li>
                              <li><a href="<?=base_url();?>index/kemitraan">Kemitraan</a></li>
                              <li class="dropdown-submenu">
                                <a class="trigger" tabindex="-1" href="#">Tentang Sekolah<i class="fa fa-angle-right"></i></a>
                                <ul class="dropdown-menu">
                                  <li><a href="<?=base_url();?>index/profil_lengkap">Profil Sekolah</a></li>
                                  <li><a href="<?=base_url();?>index/struktur_organisasi">Struktur Organisasi</a></li>
                                  <li><a href="<?=base_url();?>index/sejarah">Sejarah</a></li>
                                  <li><a href="<?=base_url();?>index/visi_misi">Visi Misi</a></li>
                                  <li><a href="<?=base_url();?>index/fasilitas">Fasilitas</a></li>
                                </ul>
                              </li>
                              <li class="dropdown-submenu">
                                <a class="trigger" tabindex="-1" href="#">Prestasi<i class="fa fa-angle-right"></i></a>
                                <ul class="dropdown-menu">
                                  <li><a href="<?=base_url();?>index/prestasi_sekolah">Prestasi Sekolah</a></li>
                                  <li><a href="<?=base_url();?>index/prestasi_guru">Prestasi Guru</a></li>
                                  <li><a href="<?=base_url();?>index/prestasi_siswa">Prestasi Siswa</a></li>
                                </ul>
                              </li>
                            </ul>
                        </li>
                        <!-- Direktori -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Direktori <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                  <a class="trigger" tabindex="-1" href="#">Direktori Guru<i class="fa fa-angle-right"></i></a>
                                  <ul class="dropdown-menu">
                                    <li><a href="<?=base_url();?>index/direktori_guru">Guru</a></li>
                                    <li><a href="<?=base_url();?>index/alumni_says">Kurikulum</a></li>
                                    <li><a href="<?=base_url();?>index/kalender_akademik">Kalender Akademik</a></li>
                                  </ul>
                                </li>
                                <li><a href="<?=base_url();?>index/direktori_staf">Direktori Staf</a></li>
                                <li><a href="<?=base_url();?>index/direktori_siswa">Direktori Siswa</a></li>
                                <li class="dropdown-submenu">
                                  <a class="trigger" tabindex="-1" href="#">Direktori Alumni<i class="fa fa-angle-right"></i></a>
                                  <ul class="dropdown-menu">
                                    <li><a href="<?=base_url();?>index/direktori_alumni">Alumni</a></li>
                                    <li><a href="<?=base_url();?>index/alumni_says">Testimonial Alumni</a></li>
                                  </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- Prestasi -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Jurusan <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=base_url();?>index/tkr">Teknik Kendaraan Ringan</a></li>
                                <li><a href="<?=base_url();?>index/tkj">Teknik Komputer & Jaringan</a></li>
                                <li><a href="<?=base_url();?>index/mm">Multimedia</a></li>
                            </ul>
                        </li>
                        <!-- Prestasi -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Kesiswaan <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                              <li><a href="<?=base_url();?>index/osis">Osis</a></li>
                              <li><a href="<?=base_url();?>index/ekstra_kurikuler">Ekstra Kurikuler</a></li>
                              <li><a href="<?=base_url();?>index/opini_siswa">Opini Siswa</a></li>
                              <li><a href="<?=base_url();?>index/prakerin">Prakerin</a></li>
                            </ul>
                        </li>
                        <!-- Prestasi -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Galeri <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                              <li><a href="<?=base_url();?>index/osis">Foto</a></li>
                              <li><a href="<?=base_url();?>index/ekstra_kurikuler">Vidio</a></li>
                            </ul>
                        </li>
                        <!-- Prestasi -->
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Info Njeret <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                              <li><a href="<?=base_url();?>index/ekstra_kurikuler">Agenda Sekolah</a></li>
                              <li><a href="<?=base_url();?>index/ekstra_kurikuler">Artikel</a></li>
                              <li><a href="<?=base_url();?>index/berita">Berita</a></li>
                              <li><a href="<?=base_url();?>index/ekstra_kurikuler">Lowongan Kerja</a></li>
                            </ul>
                        </li>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </div><!--//container-->
        </nav>
        <!--//main-nav-->
