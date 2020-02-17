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
                    เพิ่มข้อมูลการรับซื้อขยะ

                </h1>
                <ol class="breadcrumb">
                    <li><a href="customer.php"><i class="fa fa-dashboard"></i>ข้อมูลลูกค้า</a></li>
                    <li class="active">เพิ่มข้อมูลการรับซื้อ</li>
                </ol>
            </section>



            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->

                <button type="button" class="btn btn-default readfinger">แสกนลายนิ้วมือ</button>
                <button type="button" class="btn btn-default cappicture">ถ่ายภาพ</button>

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">เครื่องชั่งที่ 01</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <!-- <?php
                                    $sql_cust = "SELECT * FROM `project`.`customer` WHERE `custID` = 'customer_id'";
                                    $result_cust = mysqli_query($link, $sql_cust);
                                    $count_cust = mysqli_fetch_assoc($result_cust);
                                    ?> -->


                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">


                        <div class="row">
                            <div class="col-md-6">
                                <form id="form1" action="insert_Scale.php" method="post" class="form">

                                    
                                    <div class="form-group">
                                        <label for="pt_date" class="col-2 col-form-label">Date</label>
                                            <input class="form-control" type="date" value=<?php echo  date("Y-m-d") ;?> id="pt_date" name="pt_date">
                                        </div>

                                        <div class="form-group">
                                            <label for="custID">รหัสลายนิ้วมือ</label>
                                            <input id="customer_id" type="text" class="form-control" name="custID">

                                        </div>
                                        <div class="form-group">
                                            <label for="weight">น้ำหนัก</label>
                                            <input id="scale_input" type="text" class="form-control" name="weight">

                                        </div>
                                        <!-- <div class="form-group">
                                        <label for="cust_img">รูปภาพ</label>
                                        <input id="customer_img" type="text" class="form-control" name="cust_img">

                                    </div> -->
                                        <div class="form-group">
                                            <label for="custName">ชื่อ-สกุล</label>
                                            <input id="custName" type="text" class="form-control" name="custName">
                                        </div>
                                        <div class="form-group">
                                            <label for="custAddr">ที่อยู่</label>
                                            <textarea id="custAddr" name="custAddr" class="form-control" rows="3"></textarea>


                                            <div class="form-group">
                                                <label for="custEmail">อีเมล</label>
                                                <input id="custEmail" type="text" class="form-control" name="custEmail">
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
                                            $sql = "SELECT * FROM product_type ORDER BY prodTypeID  ASC ";
                                            $result = mysqli_query($link, $sql);

                                            ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <form id="form1" action="insert_scale.php" method="post" class="form" enctype="multipart/form-data" novalidate>
                                                        <div class="form-group">
                                                            <label for="prodTypeID">ประเภทสินค้า</label>
                                                            <select id="prodTypeID" class="form-control" name="prodTypeID">


                                                                <?php while ($row = mysqli_fetch_row($result)) {  ?>

                                                                    <option selected value="<?= $row[0]; ?>"> <?= $row[1]; ?></option>


                                                                <?php } ?>

                                                            </select>

                                                            <!-- <input type="text" id="scale_input" name="weight"> -->

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

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

    <script src="bootstrap/js/smoke.min.js"></script>

    <script src="bootstrap/js/spin.min.js"></script>
<script>

$( "selector" ).datepicker({
    dateFormat: "yyyy-mm-dd"
});


</script>

    <script>
        setInterval(function() {
            getscale()
        }, 100);
        // function getscale(){
        //     // alert('test');

        // }    

        // function aaa() {
        //     $.ajax({
        //         url: 'http://localhost/project/admin/getDatabase.php',
        //         method: "GET",
        //         success: function(data) {
        //             console.log(data)
        //         },
        //         error: function(jqXHR, textStatus, errorThrown) {

        //         }
        //     })
        // }

        function getscale() {
            $.ajax({
                url: 'http://192.168.11.8/getscale',
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
                url: 'http://192.168.11.33/readID',
                method: "GET",
                dataType: "JSON",
                beforeSend: function(data) {

                    swal({
                        title: 'กำลังแสกนลายนิ้วมือ ...'
                    })
                },


                success: function(data) {
                    // console.log(data.id);
                    $('#customer_id').val(data.id);
                    var id = data.id;
                    swal('แสกนลายนิ้วมือสำเร็จ', ' ', 'success');
                    search(data.id);
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

        function search(id) {
            $.ajax({
                url: 'http://localhost/project/admin/getDatabase.php',
                method: "POST",
                data: {
                    id: id
                },
                dataType: 'JSON',
                success: function(data) {
                    var xxx = data;
                    console.log(xxx);
                    $('#custName').val(data[1])
                    $('#custAddr').val(data[2])
                    $('#custEmail').val(data[3])
                    $('#custPassport').val(data[4])
                    $('#custCar').val(data[5])
                    $('#custTel').val(data[6])



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


        $(document).on('click', '.cappicture', function() {

            // alert('ok');



            $.ajax({
                url: 'http://raspberrypi.local:8000/cap',
                method: "GET",
                beforeSend: function(data) {

                    swal({
                        title: 'กำลังถ่ายภาพ ...'
                    })
                },


                success: function(data) {
                    console.log(data.id);
                    $('#customer_img').val(data.id);
                    var id = data.id;
                    swal('ถ่ายภาพสำเร็จ', ' ', 'success');





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