<?php
        include '../db/database.php';
        include '../mpdf/mpdf.php';
        ob_start();     
        
        
?>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        
        <div class="text-center">
       
        </div>
                <?php
                      $sql_cust = "SELECT COUNT(*) AS COUNTCUST FROM customer";
                      $result_cust = mysqli_query($link, $sql_cust);
                      $count_cust = mysqli_fetch_assoc($result_cust);
                ?>
        <h1 class="text-center">รายการข้อมูลลูกค้า ทั้งหมด <?= $count_cust['COUNTCUST']; ?> รายการ</h1>
        
        
        <section class="content">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
              <div class="box-tools pull-right">
                <!-- Buttons, labels, and many other things can be placed here! -->
                <!-- Here is a label for example -->
                <span class="label label-primary"></span>
              </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">
              <?php
                    $sql = "SELECT * FROM customer ORDER BY custID DESC";
                    $result = mysqli_query($link, $sql);
                    
              ?>
              <table class="table table-bordered">
                  <tr>
                      <th>รหัส</th>
                      <th>ชื่อ-สกุล</th>
                      <th>อีเมล</th>
                      <th>โทรศัพท์</th>
                     
                  </tr>
                  <?php  while ($row = mysqli_fetch_assoc($result)) {  ?>
                  <tr>
                      <td>
                          <?=  $row['custID']; ?>
                      </td>
                      <td>
                          <?=  $row['custName']; ?>
                      </td>
                      <td>
                          <?=  $row['custEmail']; ?>
                      </td>
                      <td>
                          <?=  $row['custTel']; ?>
                      </td>
                      
                  </tr>
                  <?php } ?>
              </table>
                
            </div><!-- /.box-body -->
            <div class="box-footer">
              
            </div><!-- box-footer -->
          </div><!-- /.box -->
          

        </section><!-- /.content -->
        
        <?php
            $html = ob_get_contents();
            ob_end_clean();
            
            $mpdf=new mPDF('utf-8');
            $mpdf->margin_header = 9;
            $mpdf->SetHeader('รายงานโดย EN NPU | รายงานลูกค้าทั้งหมด | ออกรายงานเมื่อ: '.date('d/m/Y H:i:s'));
            $mpdf->margin_footer = 9;
            // $mpdf->SetFooter('หน้าที่ {PAGENO}');
            // Define a Landscape page size/format by name
            //$mpdf=new mPDF('utf-8', 'A4-L');
            // Define a page size/format by array - page will be 190mm wide x 236mm height
            //$mpdf=new mPDF('utf-8', array(190,236));  
            $stylesheet = file_get_contents('./bootstrap/css/printpdf.css');
            //$mpdf->SetDisplayMode('fullpage');
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($html,2);
            //$mpdf->Output();
            $mpdf->Output(time(),'I');
            
            
            exit;
        ?>
        
        
          
    </body>
</html>

