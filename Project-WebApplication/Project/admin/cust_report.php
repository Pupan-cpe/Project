<?php
        include '../db/database.php';
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <?php include 'head.php';  ?>
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
      <?php include 'header.php';  ?>
      
      <!-- Left side column. contains the logo and sidebar -->
      <?php include 'leftside.php' ?>;

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            รายงานลูกค้า
            <small>ข้อมูลลูกค้า</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> เมนูหลัก</a></li>
            <li class="active">รายงานข้อมูลลูกค้า</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
           <!-- <a href="cust_pdf.php" class="btn btn-primary">PDF Report 1</a>
           <a href="cust_pdf2.php" class="btn btn-info">PDF Report 2</a> -->
           <a href="cust_excel.php" class="btn btn-warning">Excel Export</a>
          <br><br>
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">รายการข้อมูลลูกค้า</h3>
              <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <?php
                      $sql_cust = "SELECT COUNT(*) AS COUNTCUST FROM customer";
                      $result_cust = mysqli_query($link, $sql_cust);
                      $count_cust = mysqli_fetch_assoc($result_cust);
                ?>
                <span class="label label-primary">ทั้งหมด <?= $count_cust['COUNTCUST']; ?> รายการ</span>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <?php
                    $sql = "SELECT * FROM customer ORDER BY custID DESC";
                    $result = mysqli_query($link, $sql);
                    
              ?>
              <table class="table table-striped">
                  <tr>
                      <th>รหัส</th>
                      <th>ชื่อ-สกุล</th>
                      <th>อีเมล</th>
                      <th>โทรศัพท์</th>
                     
                  </tr>
                  <?php  while ($row = mysqli_fetch_assoc($result)) {  ?>
                  <tr>
                      <td>
                          <?=  $row['custID']; ?>
                      </td>
                      <td>
                          <?=  $row['custName']; ?>
                      </td>
                      <td>
                          <?=  $row['custEmail']; ?>
                      </td>
                      <td>
                          <?=  $row['custTel']; ?>
                      </td>
                      
                  </tr>
                  <?php } ?>
              </table>
                
            </div><!-- /.box-body -->
            <div class="box-footer">
              
            </div><!-- box-footer -->
          </div><!-- /.box -->
          

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <?php include 'footer.php'; ?>
      
      
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>