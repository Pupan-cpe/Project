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

            <?php
            if ($s_admin != 'admin') {

                echo 'คุณไม่มีสิทธิ์ใช้งานหน้านี้';
                exit;
            } else {



            ?>


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
                    <a href="pt_excel.php" class="btn btn-warning">Excel Export</a>
                    <a href="frm_cust.php" class="btn btn-primary">เพิ่มรายการ</a>
                    <br><br>
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">รายการข้อมูลลูกค้า</h3>
                            <div class="box-tools pull-right">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <?php
                                $sql_cust = "SELECT COUNT(*) AS COUNTCUST FROM scale01";
                                $result_cust = mysqli_query($link, $sql_cust);
                                $count_cust = mysqli_fetch_assoc($result_cust);
                                ?>
                                <span class="label label-primary">ทั้งหมด <?= $count_cust['COUNTCUST']; ?> รายการ</span>

                            </div><!-- /.box-tools -->



                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php


                            // $row = mysqli_fetch_assoc($result);
                            // echo " 
                            //     <script'>
                            //         console.log(" . json_encode($row) . ")
                            //     </script>
                            // ";

                            // $sql1 = "SELECT
                            // scale01.order_id,
                            // customer.custName,
                            // product_type.prodTypeName,
                            // scale01.wieght,
                            // Sum(prodPrice * wieght),
                            // scale01.pt_date
                            // FROM
                            // scale01
                            // INNER JOIN customer ON scale01.custID = customer.custID
                            // INNER JOIN product_type ON scale01.prodTypeID = product_type.prodTypeID
                            // GROUP BY
                            // scale01.order_id,
                            // customer.custName,
                            // product_type.prodTypeName,
                            // scale01.wieght,
                            // scale01.pt_date ";


                            $sql1 = "SELECT
            scale01.order_id,
customer.custName,
product_type.prodTypeName,
scale01.wieght,
Sum(prodPrice * wieght),
scale01.pt_date,
product_type.prodPrice
FROM
scale01
INNER JOIN customer ON scale01.custID = customer.custID
INNER JOIN product_type ON scale01.prodTypeID = product_type.prodTypeID
GROUP BY
scale01.order_id,
customer.custName,
product_type.prodTypeName,
scale01.wieght,
scale01.pt_date";

                            $result1 = mysqli_query($link, $sql1);

                            ?>

                            <table class="table table-striped">
                                <tr>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อผู้ขาย</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>น้ำหนัก</th>


                                    <th valign="middle"> ราคา</th>

                                    <th valign="middle"> ราคารวม</th>
                                    <th>วันที่</th>



                                </tr>
                                <?php while ($rs = mysqli_fetch_array($result1)) {      ?>


                                    <tr>
                                        <td> <?= $rs['order_id'];  ?> </td>
                                        <td> <?= $rs['custName']; ?> </td>
                                        <td> <?= $rs['prodTypeName']; ?> </td>
                                        <td> <?= $rs['wieght']; ?> </td>
                                        <td> <?= $rs['prodPrice']; ?> </td>
                                        <td> <?= $rs['Sum(prodPrice * wieght)']; ?> </td>
                                        <td> <?= $rs['pt_date']; ?> </td>

                                    </tr>

                                <?php  } ?>




                            </table>

                        </div><!-- /.box-body -->
                        <div class="box-footer">

                        </div><!-- box-footer -->
                    </div><!-- /.box -->


                </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

    <?php } ?>
    <!-- Main Footer -->

    <?php include 'footer.php'; ?>


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
    <script>
        // setInterval(function(){ getscale() }, 3000);
        // function getscale(){
        //     // alert('test');

        // }    



        $.ajax({
            url: 'http://localhost/project/admin/insert_name.php',
            method: "POST",
            data: {
                id: id
            },
            dataType: 'JSON',
            success: function(data) {
                var xxx = data;
                console.log(xxx);
                $('#custName').val(data[1])




            },
            error: function(jqXHR, textStatus, errorThrown) {

            }
        })
    </script>
    </script>
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
</body>

</html>