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


                <?php
                $sql2 = "SELECT
Sum(scale01.wieght * prodPrice)
FROM
product_type
INNER JOIN scale01 ON scale01.prodTypeID = product_type.prodTypeID";

                $result2 = mysqli_query($link, $sql2);



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
                <?php
                $sql_cust = "SELECT COUNT(*) AS COUNTCUST FROM customer";
                $result_cust = mysqli_query($link, $sql_cust);
                $count_cust = mysqli_fetch_assoc($result_cust);
                ?>
                <span class="label label-primary">ทั้งหมด <?= $count_cust['COUNTCUST']; ?> รายการ</span>

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
                        <div id="container" style="width:80%; height:500px;"></div>

                        <div id="container1" style="width:80%; height:500px;"></div>
                        <div id="container2" style="width:80%; height:500px;"></div>









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


// mount
$sql1 = "SELECT
Sum(prodPrice * wieght) AS countbytype1,
MONTH(pt_date)
FROM
     scale01
     INNER JOIN customer ON scale01.custID = customer.custID
     INNER JOIN product_type ON scale01.prodTypeID = product_type.prodTypeID
GROUP BY

MONTH(pt_date)
";

$result1 = mysqli_query($link, $sql1);

$category   =    array();
$count_product = array();

while ($row = mysqli_fetch_assoc($result1)) {
    $category1[] =   $row['MONTH(pt_date)'];
    $count_product1[] =  $row['countbytype1'];
}



//query product type and count product




// week
$sql = " SELECT
Sum(prodPrice * wieght) AS countbytype,
WEEK(pt_date)
FROM
     scale01
     INNER JOIN customer ON scale01.custID = customer.custID
     INNER JOIN product_type ON scale01.prodTypeID = product_type.prodTypeID
GROUP BY

WEEK(pt_date)";




$result = mysqli_query($link, $sql);

$category   =    array();
$count_product = array();

while ($row = mysqli_fetch_assoc($result)) {
    $category[] =   $row['WEEK(pt_date)'];
    $count_product[] =  $row['countbytype'];
}


?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myChart = Highcharts.chart('container', {
            chart: {
                type: 'column',
                // inverted:true
                borderWidth: 1,
                borderRadius: 3,
                options3d: {
                    enabled: true

                }
            },
            title: {
                text: 'สรุปยอดซื้อ (week)'
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
                    text: 'ราคา'
                }
            },

            series: [{
                    name: 'สรุปยอดรับซื้อแต่ละสัปดาห์',
                    data: [<?php echo implode(",", $count_product); ?>],
                    dataLabels: {
                        enabled: true,
                        x: 0,
                        y: 50,
                        format: ' {y:.2f} บาท'
                    }
                },
               

                
            ]
        });
    });
</script>


<?php


?>
<?php
//query product type and count product
$sql4 = "SELECT
Count(scale01.order_id) AS countbytype3,
product_type.prodTypeName AS scale01,
Sum(scale01.wieght) AS Scale
FROM
scale01
INNER JOIN product_type ON scale01.prodTypeID = product_type.prodTypeID
GROUP BY
product_type.prodTypeName
";
$result4 = mysqli_query($link, $sql4);

$data = array();
$data3 = array();

while ($row = mysqli_fetch_assoc($result4)) {
    extract($row);
    $data[] = array($row['scale01'], intval($row['countbytype3']));
    $data3[] = array($row['scale01'], intval($row['Scale']));
    $data2 = json_encode($data);
    $data5 = json_encode($data3);
}


?>

<script>
    $(function() {
        $('#container2').highcharts({
            chart: {
                type: 'pie',
                borderWidth: 1,
                borderRadius: 3,
                options3d: {
                    enabled: true,
                    alpha: 55,
                    beta: 0
                }
            },
            plotOptions: {
                pie: {
                    depth: 50,
                    innerSize: 100,
         
                    showInLegend: true,
                    dataLabels: {
                        // distance: -30,
                        style: {
                            fontWeight: 'bold'
                        },
                        format: '{point.name} ({y} % )'
                    }

                }
            },
            title: {
                text: 'รายงานจำนวนสินค้าแยกตามประเภทสินค้า'
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
                borderRadius: 3
            },
            series: [{
                name: 'ประเภทสินค้า',
                data: <?php echo $data2;   ?>,
                // name: 'น้ำหนัก',
                // data: <?php echo $data5;   ?>
                
            }]
        });
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myChart1 = Highcharts.chart('container1', {
            chart: {
                type: 'column',
                // inverted:true
                borderWidth: 1,
                borderRadius: 3,
                options3d: {
                    enabled: true

                }
            },
            title: {
                text: 'สรุปยอดซื้อ (month)'
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
                categories: [<?php echo "'" . implode("','", $category1) . "'"; ?>]
            },
            yAxis: {
                title: {
                    text: 'ราคา'
                }
            },

            series: [{
                    name: 'สรุปยอดรับซื้อแต่ละเดือน',
                    data: [<?php echo implode(",", $count_product1); ?>],
                    dataLabels: {
                        enabled: true,
                        x: 0,
                        y: 50,
                        format: ' {y:.2f} บาท'
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