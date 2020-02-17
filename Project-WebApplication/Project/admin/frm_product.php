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
            สินค้า
            <small>เพิ่มสินค้าใหม่</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="product.php.php"><i class="fa fa-dashboard"></i> รายการสินค้า</a></li>
            <li class="active">เพิ่มสินค้าใหม่</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Your Page Content Here -->
          
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">เพิ่มสินค้าใหม่</h3>
              <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              
                <div class="row">
                    <div class="col-md-6">
                        <form id="form1" action="insert_product.php" method="post" class="form" enctype="multipart/form-data" novalidate>
                            <div class="form-group">
                                <label for="prodTypeID">ประเภทสินค้า</label>
                                <select id="prodTypeID"  class="form-control" name="prodTypeID">
                                    <option selected value="">กรุณาเลือกประเภทสินค้า</option>
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="prodName">ชื่อสินค้า</label>
                                <input id="prodName" type="text" class="form-control" name="prodName" smk-text="กรุณากรอกชื่อสินค้า" required>
                            </div>
                             <div class="form-group">
                                <label for="prodPicture">ภาพสินค้า</label>
                                <input id="prodPicture" type="file" name="prodPicture">
                                <p class="help-block">เลือกไฟล์ภาพนามสกุล .jpg, .png, .gif เท่านั้น</p>
                             </div>
                            <button id="btn1" type="submit" class="btn btn-primary">บันทึก</button>
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
    
    <script src="bootstrap/js/spin.min.js"></script>
    
    
    <script>
            $( document ).ajaxStart(function() {
                $("#spin").show();
             }).ajaxStop(function() {
                $("#spin").hide(); 
             });
                            
            $(document).ready(function(){
                $("#prodName").focus();
                
                //select2

               
                
                var spinner = new Spinner().spin();
                $("#spin").append(spinner.el);
                $("#spin").hide();

                $('#form1').on("submit",function(e) {
                    if ($('#form1').smkValidate()) {
                        //upload file via ajax setting
                        $.ajax({
                            url: 'insert_product.php',
                            type: 'POST',
                            data: new FormData( this ),
                            processData: false,
                            contentType: false,
                            dataType: 'json'
                        }).done(function( data ) {
                            if (data.status === "success") {
                                $.smkAlert({text: data.message , type: data.status});
                            } else {
                                $.smkAlert({text: data.message , type: data.status});
                            }
                            $("#form1").smkClear();
                            $("#prodName").focus();
                        });          
                        e.preventDefault();
                    }
                   e.preventDefault();
                });
                
               
                
            });
    </script>

    
    
  </body>
</html>