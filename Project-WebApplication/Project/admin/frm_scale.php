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
                    จัดการเครื่องชั่ง
                    <small>เพิ่มรายการขยะรีไซเคิล</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="customer.php"><i class="fa fa-dashboard"></i>ข้อมูลลูกค้า</a></li>
                    <li class="active">เพิ่มรายการขยะรีไซเคิล</li>
                </ol>
            </section>



            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->

                <button type="button" class="btn btn-default readfinger">แสกนลายนิ้วมือ</button>

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">เครื่องชั่งที่ 01</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <?php
                            $sql_cust = "SELECT * FROM `project`.`customer` WHERE `custID` = 'customer_id'";
                            $result_cust = mysqli_query($link, $sql_cust);
                            $count_cust = mysqli_fetch_assoc($result_cust);
                            ?>


                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">


                        <div class="row">
                            <div class="col-md-6">
                                <form id="form1" action="insert_Scale.php" method="post" class="form">


                                    <div class="form-group">
                                        <label for="custID">รหัสลายนิ้วมือ</label>
                                        <input id="customer_id" type="text" class="form-control" name="custID">

                                    </div>
                                    <div class="form-group">
                                                            <label for="weight">น้ำหนัก</label>
                                                            <input id="scale_input" type="text" class="form-control" name="weight">

                                                        </div>

                                    <div class="form-group">
                                        <label for="custName">ชื่อ-สกุล</label>
                                        <input id="custName" type="text" class="form-control" name="custName">

                                        <?php
                                        $sql = "SELECT * FROM `project`.`customer` WHERE `custID` ='  ' ";
                                        $result = mysqli_query($link, $sql);


                                        ?>

                                        <?php while ($row = mysqli_fetch_assoc($result)) {  ?>

                                            <td>
                                                <?= $row['custName']; ?>
                                            </td>


                                        <?php   } ?>


                                    </div>
                                    <div class="form-group">
                                        <label for="custAddr">ที่อยู่</label>
                                        <textarea id="custAddr" name="custAddr" class="form-control" rows="3"></textarea>


                                        <div class="form-group">
                                            <label for="custEmail">อีเมล</label>
                                            <input id="custEmail" type="email" class="form-control" name="custEmail">
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

                                        <?php
                                        $sql = "SELECT * FROM product_type ORDER BY prodTypeID ASC";
                                        $result = mysqli_query($link, $sql);

                                        ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form id="form1" action="insert_scale.php" method="post" class="form" enctype="multipart/form-data" novalidate>
                                                    <div class="form-group">
                                                        <label for="prodTypeID">ประเภทสินค้า</label>
                                                        <select id="prodTypeID" class="form-control" name="prodTypeID">
                                                            <option selected value="">กรุณาเลือกประเภทสินค้า</option>

                                                            <?php while ($row = mysqli_fetch_row($result)) {  ?>

                                                                <option selected value=""> <?= $row[1]; ?></option>


                                                            <?php } ?>

                                                        </select>


                                                       
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

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <script>
        setInterval(function() {
            getscale()
        }, 50);
        // function getscale(){
        //     // alert('test');

        // }    


        function getscale() {
            $.ajax({
                url: 'http://192.168.137.219/getscale',
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


    <script>
        // setInterval(function(){ getscale() }, 3000);
        // function getscale(){
        //     // alert('test');

        // }    


        $(document).on('click', '.readfinger', function() {

            // alert('ok');



            $.ajax({
                url: 'http://192.168.137.198/readID',
                method: "GET",
                dataType: "JSON",
                beforeSend: function(data) {

                    swal({
                        title: 'กำลังแสกนลายนิ้วมือ ...'
                    })
                },


                success: function(data) {
                    console.log(data.id);
                    $('#customer_id').val(data.id);
                    var id = data.id;
                    swal('แสกนลายนิ้วมือสำเร็จ', ' ', 'success');
                  




                },

                timeout: 30000,



                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                    if (textStatus === "timeout") {
                        swal('ไม่สามารถเชื่อต่ออุปกรณ์ได้', 'error');

                    } else {

                        swal('เกิดข้อผิดพลาด', 'กรุณาตรวจสอบอินเทอร์เน็ต', 'error')
                    }



                }
            });


        })
    </script>


<script>
        // setInterval(function(){ getscale() }, 3000);
        // function getscale(){
        //     // alert('test');

        // }    


        $(document).on('click', '.cappicture', function() {

            // alert('ok');



            $.ajax({
                url: 'http://raspberrypi.local:8000/cap',
                method: "GET",
                dataType: "JSON",
                beforeSend: function(data) {

                    swal({
                        title: 'กำลังแสกนลายนิ้วมือ ...'
                    })
                },


                success: function(data) {
                    console.log(data.id);
                    $('#customer_id').val(data.id);
                    var id = data.id;
                    swal('แสกนลายนิ้วมือสำเร็จ', ' ', 'success');
                  




                },

                timeout: 30000,



                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                    if (textStatus === "timeout") {
                        swal('ไม่สามารถเชื่อต่ออุปกรณ์ได้', 'error');

                    } else {

                        swal('เกิดข้อผิดพลาด', 'กรุณาตรวจสอบอินเทอร์เน็ต', 'error')
                    }



                }
            });


        })
    </script>


    <!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>

</html>