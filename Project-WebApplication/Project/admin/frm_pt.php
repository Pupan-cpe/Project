<?php
//include '../db/database.php';
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
          เพิ่มประเภทสินค้า
          <small>เพิ่มรายการประเภทสินค้า</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="product_type.php"><i class="fa fa-dashboard"></i> รายการประเภทสินค้า</a></li>
          <li class="active">เพิ่มประเภทสินค้า</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <!-- Your Page Content Here -->

        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">เพิ่มประเภทสินค้า</h3>
            <div class="box-tools pull-right">
              <!-- Buttons, labels, and many other things can be placed here! -->
              <!-- Here is a label for example -->

            </div><!-- /.box-tools -->
          </div><!-- /.box-header -->
          <div class="box-body">

            <div class="row">
              <div class="col-md-6">
                <form id="form1" action="insert_pt.php" method="post" class="form">
                  
                  <div class="form-group">
                    <label for="prodTypeName">ประเภทสินค้า</label>
                    <input id="prodTypeName" type="text" class="form-control" name="prodTypeName">
                  </div>

                  <div class="form-group">
                    <label for="prodPrice">ราคา</label>
                    <input id="prodPrice" type="text" class="form-control" name="prodPrice">
                  </div>

                 
                  <button type="submit" class="btn btn-default">บันทึก</button>
                </form>
              </div>
            </div>


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

  <script src="bootstrap/js/smoke.min.js"></script>

  <!-- <script>
    $(document).ready(function() {
      $("#prodTypeName").focus();
      $("#form1").on("submit", function(e) {
        if ($("#prodTypeID").val() === '' ) {
          alert("กรุณากรอกข้อมูลให้ครบ");
          e.preventDefault();
        } else {
          $.post("insert_pt.php", {
              prodTypeName: $("#prodTypeName").val(),
              prodPrice: $("#prodPrice").val(),
             
            })
            .done(function(data) {
              if (data.status === "success") {
                $.smkAlert({
                  text: data.message,
                  type: data.status
                });
              } else {
                $.smkAlert({
                  text: data.message,
                  type: data.status
                });
              }
              $('#form1').smkClear();
              $("#prodTypeName").focus();
            });
          e.preventDefault();
        }
        
      });
    });
  </script> -->

</body>

</html>