<?php
include '../db/database.php';
?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<?php include 'head.php' ?>
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
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    เพิ่มข้อมูลลูกค้า
                    <small>เพิ่มรายการข้อมูลลูกค้า</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="customer.php"><i class="fa fa-dashboard"></i>ข้อมูลลูกค้า</a></li>
                    <li class="active">เพิ่มรายการข้อมูลลูกค้า</li>
                </ol>
            </section>



            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">เพิ่มข้อมูลลูกค้า</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->

                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <form id="form1" action="insert_cust.php" method="post" class="form">

                                    <div class="form-group">
                                        <label for="custName">ชื่อ-สกุล</label>
                                        <input id="custName" type="text" class="form-control" name="custName">

                                    </div>
                                    <div class="form-group">
                                        <label for="custAddr">ที่อยู่</label>
                                        <textarea id="custAddr" name="custAddr" class="form-control" rows="3"></textarea>

                                        <div class="form-group">
                                            <label for="custUsername">Username</label>
                                            <input id="custUsername" type="text" class="form-control" name="custUsername" smk-text="กรุณากรอก Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="custPassword">Password</label>
                                            <input id="custPassword" type="password" class="form-control" name="custPassword" smk-text="กรุณากรอก Password อย่างน้อย 4 ตัวอักษร" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="custEmail">อีเมล</label>
                                            <input id="custEmail" type="email" class="form-control" name="custEmail" smk-text="กรุณากรอกอีเมลในรูปแบบที่ถูกต้อง" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="custPassport">บัตรประชาชน</label>
                                            <input id="custPassport" type="text" class="form-control" name="custPassport">
                                        </div>

                    
                                    <div class="form-group">
                                        <label for="custCar">ทะเบียนรถ</label>
                                        <input id="custCar" type="text" class="form-control" name="custCar">
                                    </div>



                                    <div class="form-group">
                                        <label for="custTel">เบอร์โทรศัพท์</label>
                                        <input id="custTel" type="text" class="form-control" name="custTel">
                                    </div>


                                    <button type="submit" class="btn btn-default">บันทึก</button>
                                </form>
                            </div>
                        </div>

                    </div><!-- /.box-body -->
                    <!-- <div class="box-footer"> -->


                    <!-- /.box-body -->


                    <!-- <div class="box-footer">
                        The footer of the box
                    </div> -->
                    <!-- box-footer -->
                </div>
                <!-- /.box -->


            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <?php include 'footer.php'; ?>

        <!-- Control Sidebar -->

    </div>

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
        $(document).ajaxStart(function() {
            $("#spin").show();
        }).ajaxStop(function() {
            $("#spin").hide();
        });

        $(document).ready(function() {
            $("#custName").focus();

            var spinner = new Spinner().spin();
            $("#spin").append(spinner.el);
            $("#spin").hide();

            $('#btn1').on("click", function(e) {
                if ($('#form1').smkValidate()) {
                    $.post("insert_cust.php", $("#form1").serialize())
                        .done(function(data) {
                            if (data.status === "success") {
                                $('#btnAlertSuccess').click(function(e) {
                                    e.preventDefault();
                                    $.smkAlert({
                                        text: 'Alert type "success"',
                                        type: 'success'
                                    });
                                });
                            } else {
                                $.smkAlert({
                                    text: data.message,
                                    type: data.status
                                });
                            }
                            $('#form1').smkClear();
                            $("#custName").focus();
                        });

                    e.preventDefault();
                }
                e.preventDefault();
            });

            $("#custUsername").on("blur", function(e) {
                $.get("check_username.php", {
                        custUsername: $("#custUsername").val()
                    })
                    .done(function(data) {
                        if (data.status === "active") {
                            alert(data.message);
                            $("#custUsername").val('');
                            $("#custUsername").focus();
                        }
                    });
                e.preventDefault();
            });

        });
    </script>


    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>