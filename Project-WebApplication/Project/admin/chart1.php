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
                <section class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- AREA CHART -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Area Chart</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="chart">
                                        <canvas id="DOMContentLoaded" style="height:250px"></canvas>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <!-- DONUT CHART -->
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Donut Chart</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <canvas id="pieChart" style="height:250px"></canvas>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </div><!-- /.col (LEFT) -->
                        <div class="col-md-6">
                            <!-- LINE CHART -->
                            <div class="box box-info">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Line Chart</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="chart">
                                        <canvas id="lineChart" style="height:250px"></canvas>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            <!-- BAR CHART -->
                            <div class="box box-success">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Bar Chart</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="chart">
                                        <canvas id="barChart" style="height:230px"></canvas>
                                    </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                        </div><!-- /.col (RIGHT) -->
                    </div><!-- /.row -->


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

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>


    <!-- ChartJS 1.0.1 -->
    <script src="../../plugins/chartjs/Chart.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->

<!-- chart -->
<script src="highchart/js/highcharts.js"></script>
<script src="highchart/js/highcharts-3d.js"></script>


<?php
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
    $(function() {

     
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
    });
</script>


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

while ($row = mysqli_fetch_assoc($result)) {
    $category1[] =   $row['WEEK(pt_date)'];
    $count_product1[] =  $row['countbytype1'];
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
                    name: 'สรุปยอดรับซื้อแต่ละสัปดาห์',
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


<script>
 $(function () {
        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var areaChart = new Chart(areaChartCanvas);

        var areaChartData = {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
              label: "Digital Goods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",
              data: [28, 48, 40, 19, 86, 27, 90]
            }
          ]
        };

        var areaChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: false,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        //Create the line chart
        areaChart.Line(areaChartData, areaChartOptions);

        //-------------
        //- LINE CHART -
        //--------------
        var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
        var lineChart = new Chart(lineChartCanvas);
        var lineChartOptions = areaChartOptions;
        lineChartOptions.datasetFill = false;
        lineChart.Line(areaChartData, lineChartOptions);

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
          {
            value: 700,
            color: "#f56954",
            highlight: "#f56954",
            label: "Chrome"
          },
          {
            value: 500,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "IE"
          },
          {
            value: 400,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "FireFox"
          },
          {
            value: 600,
            color: "#00c0ef",
            highlight: "#00c0ef",
            label: "Safari"
          },
          {
            value: 300,
            color: "#3c8dbc",
            highlight: "#3c8dbc",
            label: "Opera"
          },
          {
            value: 100,
            color: "#d2d6de",
            highlight: "#d2d6de",
            label: "Navigator"
          }
        ];
        var pieOptions = {
          //Boolean - Whether we should show a stroke on each segment
          segmentShowStroke: true,
          //String - The colour of each segment stroke
          segmentStrokeColor: "#fff",
          //Number - The width of each segment stroke
          segmentStrokeWidth: 2,
          //Number - The percentage of the chart that we cut out of the middle
          percentageInnerCutout: 50, // This is 0 for Pie charts
          //Number - Amount of animation steps
          animationSteps: 100,
          //String - Animation easing effect
          animationEasing: "easeOutBounce",
          //Boolean - Whether we animate the rotation of the Doughnut
          animateRotate: true,
          //Boolean - Whether we animate scaling the Doughnut from the centre
          animateScale: false,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true,
          // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
        };
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;
        barChartData.datasets[1].fillColor = "#00a65a";
        barChartData.datasets[1].strokeColor = "#00a65a";
        barChartData.datasets[1].pointColor = "#00a65a";
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
      });
</script>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
</body>

</html>