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
                    เครื่องชั่ง
                    <small>จัดการเครื่องชั่ง</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> เมนูหลัก</a></li>
                    <li class="active">จัดการเครื่องชั่ง</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->
                <br><br>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">น้ำหนัก</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->

                        </div><!-- /.box-tools -->



                    </div><!-- /.box-header -->
                    <div class="box-body">
                          <h1 id="scale"></h1>
                          <form action="">
                          <input type="text" id="scale_input">
                          </form>
                          

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
    <script>
        setInterval(function(){ getscale() }, 50);
        // function getscale(){
        //     // alert('test');

        // }    


        function getscale() {
            $.ajax({
                url: 'http://192.168.11.22/getscale',
                method: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#scale').html(data.scale);
                    $('#scale_input').val(data.scale);
                    console.log(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                   
                }
            })
        }
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
</body>

</html>