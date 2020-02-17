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
        <!-- Control Sidebar -->
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
                        สินค้า
                        <small>จัดการข้อมูลสินค้าโรงงานที่2</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> เมนูหลัก</a></li>
                        <li class="active">จัดการสินค้า</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">


                    <!-- Your Page Content Here -->

                    <!-- <a href="frm_product.php" class="btn btn-primary">เพิ่มรายการ</a> -->
                    <br><br>
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">รายการข้อมูลสินค้า</h3>
                            <div class="box-tools pull-right">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                <?php
                                $sql_cust = "SELECT COUNT(*) AS COUNTCUST FROM scale02";
                                $result_cust = mysqli_query($link, $sql_cust);
                                $count_cust = mysqli_fetch_assoc($result_cust);
                                ?>
                                <span class="label label-primary">ทั้งหมด <?= $count_cust['COUNTCUST']; ?> รายการ</span>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <?php
                        $sql1 = "SELECT
                        scale02.order_id,
                   customer.custName,
            product_type.prodTypeName,
            scale02.wieght,
            Sum(prodPrice * wieght),
            scale02.pt_date,
            product_type.prodPrice
            FROM
            scale02
            INNER JOIN customer ON scale02.custID = customer.custID
            INNER JOIN product_type ON scale02.prodTypeID = product_type.prodTypeID
            GROUP BY
            scale02.order_id,
            customer.custName,
            product_type.prodTypeName,
            scale02.wieght,
            scale02.pt_date";
                        $result1 = mysqli_query($link, $sql1);

                        ?>


                        <div class="box-body">
                            <a href="pt_excel2.php" class="btn btn-warning">Excel Export</a>
                            <!-- <button id="remove" class="btn btn-danger" disabled>
                                <i class="glyphicon glyphicon-remove"></i> ลบรายการ
                            </button> -->
                            <table id="table" data-toggle="table" data-url="product_json1.php" data-pagination="true" data-page-size="10" data-page-list="[5,10,15,ALL]" data-search="true" data-height="500" data-toolbar="#toolbar" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-id-field="order_id">

                                <thead>
                                    <tr>
                                        <th data-filed="state" data-checkbox="true"></th>
                                        <th data-field="order_id" data-align="center">รหัสสินค้า</th>
                                        <th data-field="custName">ชื่อผู้ขาย</th>
                                        <th data-field="prodTypeName">ประเภทสินค้า</th>
                                        <!-- <th data-field="prodTypeName" data-sortable="true" data-Formatter="priceFormatter">ประเภทสินค้า</th> -->
                                        <th data-field="wieght" data-align="center">น้ำหนัก</th>
                                        <th data-field="prodPrice" data-align="center">ราคา</th>
                                        <th data-field="Sum(prodPrice * wieght)" data-align="center" data-sortable="true">ราคารวม</th>
                                        <th data-field="pt_date" data-sortable="true">วันที่</th>
                                        <!-- <th data-field ="pt_date"  data-align ="center" data-events="operateEvents" data-formatter="operateFormatter"    >custom</th> -->
                                    </tr>

                                </thead>

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

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
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
    <!--bootstarp table -->
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <script src="bootstrap/js/smoke.min.js"></script>

    <script>
        var $table = $('#table'),
            $remove = $('#remove');


        $(function() {
            $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function() {
                $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
            });
            $remove.click(function() {
                $.smkConfirm({
                    text: 'แน่ใจว่าต้องการลบข้อมูล ?',
                    accept: 'ตกลง',
                    cancel: 'ยกเลิก'
                }, function(e) {
                    if (e) {
                        var ids = $.map($table.bootstrapTable('getSelections'), function(row) {
                            return row.prodID;
                        });
                        // alert(ids);

                        //ajax
                        $.get("del_product.php", {
                                "prodID[]": ids
                            })
                            .done(function(data) {
                                if (data.status === "success") {
                                    $.smkAlert({
                                        text: data.message,
                                        type: data.status
                                    });
                                } else {
                                    $.smkAlert({
                                        text: data.message,
                                        type: data.status
                                    });
                                }
                                $table.bootstrapTable('refresh');
                            });


                        $remove.prop('disabled', true);
                        //uncheck
                        $table.bootstrapTable('togglePagination').bootstrapTable('uncheckAll').bootstrapTable('togglePagination');
                    }
                });
            });
        });


        function priceFormatter(value) {
            return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");;
        }

        function operateFormatter(value, row, index) {
            return [
                '<a class="like" href="javascript:void(0)" title="แก้ไข">',
                '<i class="glyphicon glyphicon-pencil"></i>',
                '</a>  '
            ].join('');
        }

        window.operateEvents = {
            'click .like': function(e, value, row, index) {
                var prodID = [row.prodID];
                alert('You click like action, row: ' + row.prodID);
                $(location).attr('href', 'frm_edit_prodcut.php?prodID=' + prodID); //redirect to your url

            }
        };
    </script>


    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
</body>

</html>