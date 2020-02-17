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
                        รายงาน
                        <small>จำนวนสินค้าแยกตามประเภท</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> เมนูหลัก</a></li>
                        <li class="active">รางาน</li>
                    </ol>
                </section>

                <!-- Main content -->
                <!-- Your Page Content Here -->
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">รายงาน</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->

                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div id="container" style="width:100%; height:400px;"></div>





                    </div><!-- /.box-body -->
                    <div class="box-footer">

                    </div><!-- box-footer -->
                </div><!-- /.box -->




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

<!-- chart -->
<script src="highchart/js/highcharts.js"></script>
<script src="highchart/js/highcharts-3d.js"></script>


<?php
//query product type and count product
$sql = "SELECT
Count(scale01.order_id) AS countbytype,
product_type.prodTypeName AS scale01
FROM
scale01
INNER JOIN product_type ON scale01.prodTypeID = product_type.prodTypeID
GROUP BY
product_type.prodTypeName";
$result = mysqli_query($link, $sql);

$category  = array();
$count_product = array();

while ($row = mysqli_fetch_assoc($result)) {
    $category[] = $row['scale01'];
    $count_product[] =  $row['countbytype'];
}


?>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myChart = Highcharts.chart('container', {
            chart: {
                // type: 'column',
                // inverted:true
                borderWidth: 1,
                borderRadius: 3,
                options3d: {
                    enabled: true

                }
            },
            title: {
                text: 'รายงานจำนวนสินค้าที่ซื้อแต่ละประเภท'
            },
            subtitle: {
                text: 'เปรียบเทียบ'
            },
            credits: {
                enabled: false

            },
            legend: {
                align: 'right',
                verticalAlign: 'middle',
                layout: 'vertical',
                borderWidth: 2,
                borderRadius: 3,


            },
            xAxis: {
                categories: [<?php echo "'" . implode("','", $category) . "'"; ?>]
            },
            yAxis: {
                title: {
                    text: 'จำนวนสินค้า'
                }
            },

            series: [{
                    name: 'จำนวนสินค้า',
                    data: [<?php echo implode(",", $count_product); ?>],
                    dataLabels: {
                        enabled: true,
                        x: -10,
                        y: 50,
                        format: 'สินค้า: {y:.2f} ชิ้น'
                    }
                },

            ]
        });
    });
</script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
</body>

</html>