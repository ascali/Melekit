<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('public/admin/img/favicon.jpg'); ?>"/>

    <title>Admin Sekolah</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('public/admin/bower_components/metisMenu/dist/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'); ?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url('public/admin/bower_components/datatables-responsive/css/dataTables.responsive.css'); ?>" rel="stylesheet">

    <!-- Timeline CSS -->
    <!-- <link href="<?php //echo base_url('public/admin/dist/css/timeline.css'); ?>" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="<?php echo base_url('public/admin/dist/css/sb-admin-2.css'); ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!-- <link href="<?php //echo base_url('public/admin/bower_components/morrisjs/morris.css'); ?>" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('public/admin/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
    <style type="text/css">
      .modal-bodys{
          height: 220px;
          overflow-y: auto;
      }

      @media (min-height: 500px) {
          .modal-bodys { height: 445px; }
      }

      @media (min-height: 800px) {
          .modal-bodys { height: 600px; }
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

<body data-spy="scroll" data-target=".navbar" data-offset="50">

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" data-spy="affix" data-offset-top="197" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('administrator/dashboard'); ?>">Sekolah Melek IT</a>
            </div>
            <!-- /.navbar-header -->

            <!-- Start Header -->
            <ul class="nav navbar-top-links navbar-right">
              <?php $this->load->view('admin/navbar'); ?>
            </ul>
            <!-- End Header -->

            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <?php $this->load->view('admin/menu')?>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Start Container -->
        <div id="page-wrapper">
            <?php $this->load->view($content); ?>
        </div>
        <!-- /.container -->

        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- Modal All -->
    <?php $this->load->view($modals); ?>

    <!-- jQuery -->
    <script src="<?php echo base_url('public/admin/bower_components/jquery/dist/jquery.min.js'); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('public/admin/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('public/admin/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>

    <!-- Morris Charts JavaScript -->
    <!-- <script src="<?php //echo base_url('public/admin/bower_components/raphael/raphael-min.js'); ?>"></script>
    <script src="<?php //echo base_url('public/admin/bower_components/morrisjs/morris.min.js'); ?>"></script>
    <script src="<?php //echo base_url('public/admin/js/morris-data.js'); ?>"></script> -->

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url('public/admin/bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('public/admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('public/admin/dist/js/sb-admin-2.js'); ?>"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script src="<?php echo base_url('public/admin/modules/'.$modules.'.js'); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
    
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true,
                fixedHeader: true
        });
    });
    </script>

</body>

</html>
