<?php
include '../database/db.php';
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

<body class="hold-transition skin-green sidebar-mini">
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
                    ลูกค้า
                    <small>จัดการข้อมูลลูกค้า</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-dashboard"></i> เมนูหลัก</a></li>
                    <li class="active">จัดการข้อมูลลูกค้า</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Your Page Content Here -->
                <a href="frm_cust.php" class="btn btn-primary">เพิ่มรายการ</a>
                <br><br>
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">รายการข้อมูลลูกค้า</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <?php
                            $sql_cust = "SELECT COUNT(*) AS COUNTCUST FROM custtomer";
                            $result_cust = mysqli_query($link, $sql_cust);
                            $count_cust = mysqli_fetch_assoc($result_cust);
                            ?>
                            <span class="label label-primary">ทั้งหมด <?= $count_cust['COUNTCUST']; ?> รายการ</span>

                        </div><!-- /.box-tools -->



                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        $sql = "SELECT * FROM custtomer ORDER BY custID ASC";
                        $result = mysqli_query($link, $sql);

                        ?>
                        <table class="table table-striped">
                            <tr>
                                <th>รหัส</th>
                                <th>ชื่อ-สกุล</th>
                                <th>ที่อยู่</th>
                                <th>ทะเบียนรถ</th>
                                <th>บัตรประชาชน</th>
                                <th>เบอร์โทรศัพท์</th>
                                <th>ลายนิ้วมือ</th>
                                <th>แสกนลายนิ้วมือ</th>
                                <th>ลบ</th>

                            </tr>
                            <?php while ($row = mysqli_fetch_assoc($result)) {  ?>
                                <tr>
                                    <td>
                                        <?= $row['custID']; ?>
                                    </td>
                                    <td>
                                        <?= $row['custName']; ?>
                                    </td>
                                    <td>
                                        <?= $row['custAddr']; ?>
                                    </td>
                                    <td>
                                        <?= $row['custCar']; ?>
                                    </td>
                                    <td>
                                        <?= $row['custPassport']; ?>
                                    </td>
                                    <td>
                                        <?= $row['custTel']; ?>
                                    </td>

                                    <td>
                                        <?php if ($row['isActive'] == 1) {
                                            echo "เก็บแล้ว";
                                        } else {
                                            echo "ยังไม่ได้เก็บ";
                                        } ?>
                                    </td>
                                    <td>
                                        <a href="#" id="<?= $row['custID'];  ?>" class="scan"><i class="fa fa-qrcode" style='font-size:30px;color:red'></i></a>
                                    </td>
                                    <td><a href="del_cust.php?id=<?= $row['custID'];  ?>" class="delete"><i class="fa fa-trash"></i> </a>
                                    </td>

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
    <script>
        // setInterval(function(){ getscale() }, 3000);
        // function getscale(){
        //     // alert('test');

        // }    


        $(document).on('click', '.scan', function() {

            // alert('ok');
            var id = $(this).attr("id");
            $.ajax({
                url: 'http://192.168.10.32/?id=' + id,
                method: "GET",
                dataType: "JSON",
                beforeSend: function() {
                    // alert ('กรุณารอซักครู่');
                    swal("กรุณารอซักครู่");

                },
                success: function(data) {
                    console.log(data);

                    if (data.id == 'Success!') {
                        swal('แสกนลายนิ้วมือสำเร็จ', '', 'success');
                        ($row['isActive'] === 1);

                    } else {
                        swal('แสกนลายนิ้วมือไม่สำเร็จ', '', 'error');
                    }



                },

                // alert(data.id);


                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                    if (textStatus === "Time Out") {
                        swal('ไม่สามารถเชื่อต่ออุปกรณ์ได้', 'error');

                    } else {

                        swal('เกิดข้อผิดพลาด', 'กรุณาแสกนให้ทันเวลาที่กำหนด', 'error')
                    }



                }
            });
        })

       
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
</body>

</html>
