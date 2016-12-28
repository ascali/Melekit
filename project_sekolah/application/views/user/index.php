<!DOCTYPE html>
<html lang="en">
<head>
    <title>Project Sekolah</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('public/admin/img/favicon.jpg'); ?>"/>
    <link rel="shortcut icon" href="<?php echo base_url('public/admin/img/favicon.jpg'); ?>">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public/user/test/plugins/bootstrap/css/bootstrap.min.css'); ?>">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public/user/test/plugins/font-awesome/css/font-awesome.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/user/test/plugins/flexslider/flexslider.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/user/test/plugins/pretty-photo/css/prettyPhoto.css'); ?>">
    <!-- Calendar -->
    <link href="<?php echo base_url('public/admin/bower_components/datatables-responsive/css/dataTables.responsive.css'); ?>" rel="stylesheet">

    <!-- Core CSS File. The CSS code needed to make eventCalendar works -->
    <link rel="stylesheet" href="<?=base_url()?>public/user/test/plugins/calendar-jquery/css/eventCalendar.css">

    <!-- Theme CSS file: it makes eventCalendar nicer -->
    <link rel="stylesheet" href="<?=base_url()?>public/user/test/plugins/calendar-jquery/css/eventCalendar_theme_responsive.css">

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="<?php echo base_url('public/user/test/css/styles.css'); ?>">

    <style type="text/css">
        /* Credit to bootsnipp.com for the css for the color graph */
        .colorgraph {
          height: 5px;
          border-top: 0;
          background: #c4e17f;
          border-radius: 5px;
          background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
          background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
          background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
          background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
        }
        body {
            position: relative;
        }
        .affix {
            top:0;
            width: 100%;
            z-index: 9999 !important;
        }
        .navbar {
            margin-bottom: 0px;
        }

        .affix ~ .container-fluid {
           position: relative;
           top: 50px;
        }
    </style>
</head>

<body class="home-page" data-spy="scroll" data-target=".navbar" data-offset="50">
    <div class="wrapper">
        <!-- ******HEADER****** -->
        <header class="header">
            <div class="top-bar">
                <div class="container">
                    <ul class="social-icons col-md-6 col-sm-6 col-xs-12 hidden-xs">
                        <li><a href="#" ><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" ><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" ><i class="fa fa-youtube"></i></a></li>
                        <li><a href="#" ><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#" ><i class="fa fa-google-plus"></i></a></li>
                        <li class="row-end"><a href="#" ><i class="fa fa-rss"></i></a></li>
                    </ul><!--//social-icons-->
                    <form class="pull-right search-form" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search the site...">
                        </div>
                        <button type="submit" class="btn btn-theme">Go</button>
                    </form>
                </div>
            </div><!--//to-bar-->
            <div class="header-main container">
              <div class="col-md-12">
                  <div class="info col-md-2">
                  <div class="img-responsive">
                  <img src="<?php echo base_url('public/admin/img/profil/'); ?>polindra.png" width="50%" alt="Logo">
                        
                  </div>

                  </div>
                  <div class="col-md-4">
                  <strong><h3>SMK N 1 BALONGAN</h3></strong>
                  </div>
                  <div class="info col-md-6 col-sm-6">
                      <ul class="menu-top navbar-right">
                          <!-- <li class="divider"><a href="#" >Home</a></li> -->
                          <li class="divider"><a href="#" data-toggle="modal" data-target="#modalLogin">Login</a></li>
                          <li class="divider"><a href="faq.html">FAQ</a></li>
                          <li><a href="<?=base_url('index/kontak');?>">Contact</a></li>
                      </ul><!--//menu-top-->
                      <br />
                  </div><!--//info-->
              </div>
            </div><!--//header-main-->
        </header><!--//header-->

        <!-- Start Navbar -->
            <?php $this->load->view('user/menu/nav'); ?>
        <!-- End Navbar -->

        <!-- ******CONTENT****** -->
        <div class="content container">
            <?php $this->load->view($content); ?>
        </div>
        <!--//content-->
    </div><!--//wrapper-->

    <!-- ******FOOTER****** -->
    <footer class="footer">
        <div class="footer-content">
            <div class="container">
                <div class="row">
                <div class="footer-col col-md-3 col-sm-4 about">
                    <div class="footer-col-inner">
                        <h3>About</h3>
                        <ul>
                            <li><a href="about.html"><i class="fa fa-caret-right"></i>About us</a></li>
                            <li><a href="contact.html"><i class="fa fa-caret-right"></i>Contact us</a></li>
                            <li><a href="privacy.html"><i class="fa fa-caret-right"></i>Privacy policy</a></li>
                            <li><a href="terms-and-conditions.html"><i class="fa fa-caret-right"></i>Terms & Conditions</a></li>
                        </ul>
                    </div><!--//footer-col-inner-->
                </div><!--//foooter-col-->
                <div class="footer-col col-md-6 col-sm-8 newsletter">
                    <div class="footer-col-inner">
                        <h3>Join our mailing list</h3>
                        <p>Subscribe to get our weekly newsletter delivered directly to your inbox</p>
                        <form class="subscribe-form">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Enter your email" />
                            </div>
                            <input class="btn btn-theme btn-subscribe" type="submit" value="Subscribe">
                        </form>

                    </div><!--//footer-col-inner-->
                </div><!--//foooter-col-->
                <div class="footer-col col-md-3 col-sm-12 contact">
                    <div class="footer-col-inner">
                        <h3>Contact us</h3>
                        <div class="row">
                            <p class="adr clearfix col-md-12 col-sm-4">
                                <i class="fa fa-map-marker pull-left"></i>
                                <span class="adr-group pull-left">
                                    <span class="street-address">College Green</span><br>
                                    <span class="region">56 College Green Road</span><br>
                                    <span class="postal-code">BS16 AP18</span><br>
                                    <span class="country-name">UK</span>
                                </span>
                            </p>
                            <p class="tel col-md-12 col-sm-4"><i class="fa fa-phone"></i>0800 123 4567</p>
                            <p class="email col-md-12 col-sm-4"><i class="fa fa-envelope"></i><a href="#">enquires@website.com</a></p>
                        </div>
                    </div><!--//footer-col-inner-->
                </div><!--//foooter-col-->
                </div>
            </div>
        </div><!--//footer-content-->
        <div class="bottom-bar">
            <div class="container">
                <div class="row">
                    <small class="copyright col-md-6 col-sm-12 col-xs-12">Copyright @ 2014 College Green Online | Website template by <a href="#">3rd Wave Media</a></small>
                    <ul class="social pull-right col-md-6 col-sm-12 col-xs-12">
                        <li><a href="#" ><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" ><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" ><i class="fa fa-youtube"></i></a></li>
                        <li><a href="#" ><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#" ><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#" ><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#" ><i class="fa fa-skype"></i></a></li>
                        <li class="row-end"><a href="#" ><i class="fa fa-rss"></i></a></li>
                    </ul><!--//social-->
                </div><!--//row-->
            </div><!--//container-->
        </div><!--//bottom-bar-->
    </footer><!--//footer-->

    <!-- *****CONFIGURE STYLE****** -->
    <div class="config-wrapper hidden-xs">
        <div class="config-wrapper-inner">
            <!-- <a id="config-trigger" class="config-trigger" href="#"><i class="fa fa-cog"></i></a> -->
            <div id="config-panel" class="config-panel">
                <p>Choose Colour</p>
                <ul id="color-options" class="list-unstyled list-inline">
                    <li class="default active" ><a data-style="<?php echo base_url('public/user/test/css/styles.css'); ?>" data-logo="<?php echo base_url('public/user/test/images/logo.png'); ?>" href="#"></a></li>
                    <li class="green"><a data-style="<?php echo base_url('public/user/test/css/styles-green.css'); ?>" data-logo="<?php echo base_url('public/user/test/images/logo-green.png'); ?>" href="#"></a></li>
                    <li class="purple"><a data-style="<?php echo base_url('public/user/test/css/styles-purple.css'); ?>" data-logo="<?php echo base_url('public/user/test/images/logo-purple.png'); ?>" href="#"></a></li>
                    <li class="red"><a data-style="<?php echo base_url('public/user/test/css/styles-red.css'); ?>" data-logo="<?php echo base_url('public/user/test/images/logo-red.png'); ?>" href="#"></a></li>
                </ul><!--//color-options-->
                <a id="config-close" class="close" href="#"><i class="fa fa-times-circle"></i></a>
            </div><!--//configure-panel-->
        </div><!--//config-wrapper-inner-->
    </div><!--//config-wrapper-->

    <!-- Modal Login -->
    <!-- Modal -->
    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Login Form</h4>
          </div> -->
          <div class="modal-body">

            <div class="row" style="margin-top:-25px">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                    <form role="form" method="POST" action="<?php echo base_url()?>login/do_login">
                        <fieldset>
                            <h2>Please Sign In</h2>
                            <hr class="colorgraph">
                            <div class="form-group">
                                <input type="text" name="username" id="username" required="" class="form-control input-lg" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" required="" class="form-control input-lg" placeholder="Password">
                            </div>
                            <!-- <span class="button-checkbox">
                                <button type="button" class="btn" data-color="info">Remember Me</button>
                                <input type="checkbox" name="remember_me" id="remember_me" checked="checked" class="hidden">
                                <a href="" class="btn btn-link pull-right">Forgot Password?</a>
                            </span> -->
                            <hr class="colorgraph">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <button type="submit" id="btnLogin" class="btn btn-lg btn-success btn-block">Log in</button>
                                </div>
                                <!-- <div class="col-xs-6 col-sm-6 col-md-6">
                                    <a href="" class="btn btn-lg btn-primary btn-block">Register</a>
                                </div> -->
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

          </div>
          <!-- <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div> -->
        </div>
      </div>
    </div>
    <!-- End Modal Login -->
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo base_url('public/user/test/plugins/jquery-1.12.3.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/paging/js/jquery.paginate.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/source/jquery.fancybox.css?v=2.1.5'); ?>" media="screen" />
    <script type="text/javascript" src="<?php echo base_url('public/source/jquery.fancybox.js?v=2.1.5'); ?>"></script>
        

    <script type="text/javascript" src="<?php echo base_url('public/user/test/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/user/test/plugins/bootstrap-hover-dropdown.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/user/test/plugins/back-to-top.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/user/test/plugins/jquery-placeholder/jquery.placeholder.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/user/test/plugins/pretty-photo/js/jquery.prettyPhoto.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/user/test/plugins/flexslider/jquery.flexslider-min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/user/test/plugins/jflickrfeed/jflickrfeed.min.js'); ?>"></script>
    <!-- plugin has dependency of moment.js to show dates -->
    <script src="<?=base_url()?>public/user/test/plugins/calendar-jquery/js/moment.js" type="text/javascript"></script>
    <script src="<?=base_url()?>public/user/test/plugins/calendar-jquery/js/jquery.eventCalendar.min.js" type="text/javascript"></script>

    <script src="<?php echo base_url('public/admin/bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
    
    <script type="text/javascript" src="<?php echo base_url('public/user/test/js/main.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('public/admin/modules/login.js'); ?>"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script src="<?php echo base_url('public/user/modules/'.$modules.'.js'); ?>" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){
    
            $("#eventCalendarHumanDate").eventCalendar({
                eventsjson: 'http://localhost/project_sekolah/index/event_data_user',
                jsonDateFormat: 'human' // 'YYYY-MM-DD HH:MM:SS'
            });

            $.getJSON("http://localhost/project_sekolah/index/kontak_data", function(json) {
                var content='';


                //for (var a=0; a<json.data.length; a++) {
                    
                    //var id = json.data[a].id;
                    var judul = json.data[0].judul;
                    var isi = json.data[0].isi;
                    var map = json.data[0].map;

                    var maps = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.0402176358093!2d110.37821475!3d-7.785560899999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a59d2a47d2609%3A0xd5a7d343fbdbcd63!2sJalan+Doktor+Wahidin+Sudirohusodo!5e0!3m2!1sid!2s!4v1395643159663" width="100%" height="70%" frameborder="0" style="border:0"></iframe>';
                    
                    $('#judul').html(judul);
                    $('#isi').html(isi);
                    $('#maps').html(maps);
                //};
            });

        });
    </script>

</body>
</html>
