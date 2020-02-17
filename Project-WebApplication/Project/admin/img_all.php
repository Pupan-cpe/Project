<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<?php 
 
 include 'head.php';
 ?>

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect


|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
 <!-- Main Header -->
 <?php include 'header.php'; ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include 'leftside.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

  <!-- Control Sidebar -->
  <?php include 'leftside.php'; ?>

  <?php
            if ($s_admin != 'admin') {

                echo 'คุณไม่มีสิทธิ์ใช้งานหน้านี้';
                exit;
            } else {



            ?>

    <!-- Main content -->
    <section class="content container-fluid">

        <!-- Content Wrapper. Contains page content -->
        
 
 
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
        
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active"></li>
      </ol>
    

      <a href="http://raspberrypi.local/image/?C=M;O=D">คลังรูปภาพ</a>
         
<br><br><br><br>
    </section>
    <?php  }?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    
  <!-- Main Footer -->
  <?php include 'footer.php'; ?>
 

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>