<?php
include '../db/database.php';
?>
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

    <?php

    include 'header.php';
    ?>

    <!-- Main content -->
    <section class="content container-fluid">

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            ประเภทสินค้า
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="product_type.php"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
            <li class="active"></li>
          </ol>


        </section>
        <!-- /.content -->
        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          <a href="frm_pt.php" class="btn btn-primary">เพิ่มรายการ</a>
          <!-- <a href="product_type_excel.php" class="btn btn-warning">ส่งออก Excel</a> -->
          <br>
          <br>
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">รายการประเภทสินค้า</h3>
              <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <?php
                $sql_pt = "SELECT COUNT(*) AS COUNTPT FROM product_type";
                $result_pt = mysqli_query($link, $sql_pt);
                $count_pt = mysqli_fetch_assoc($result_pt);
                ?>
                <span class="label label-primary">ทั้งหมด <?= $count_pt['COUNTPT']; ?> รายการ</span>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <?php
              $sql = "SELECT * FROM product_type ORDER BY prodTypeID ASC";
              $result = mysqli_query($link, $sql);

              ?>
              <table class="table table-striped">
                <tr>
                  <th>รหัส</th>
                  <th>ประเภท</th>
                  <th>ราคา</th>
                  <th>ลบ</th>
                </tr>
                <?php while ($row = mysqli_fetch_row($result)) {  ?>
                  <tr>
                    <td>
                      <?= $row[0]; ?>
                    </td>
                    <td>
                      <?= $row[1]; ?>
                    </td>
                    <td>
                      <?= $row[2]; ?>
                    </td>

                    <td>

                    
                    <a href="del_pt.php?id= <?= $row[0]; ?>" onclick="return confirm('คุณแน่ใจที่จะลบ ?')"><i class="fa fa-trash"></i></a>
                     
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









  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php include 'footer.php'; ?>

  <!-- Control Sidebar -->
  <?php include 'leftside.php'; ?>
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