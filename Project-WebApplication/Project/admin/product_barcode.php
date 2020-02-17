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
        <img src="dist/img/akenarin.jpg" width="92px">
        </div>
                <?php
                      $sql_product= "SELECT COUNT(*) AS COUNTPROD FROM product";
                      $result_product = mysqli_query($link, $sql_product);
                      $count_product = mysqli_fetch_assoc($result_product);
                ?>
        <h1 class="text-center">รายการสินค้าทั้งหมด <?= $count_product['COUNTPROD']; ?> รายการ</h1>
        
        
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
                    $sql = "SELECT * FROM product";
                    $result = mysqli_query($link, $sql);
                    
              ?>
              <table class="table table-bordered">
                  <tr>
                      <th style="width: 200px;">BARCODE</th>                  
                      <th>ชื่อสินค้า</th>
                      <th>ราคา</th>
                      <th>คงเหลือ</th>
                     
                  </tr>
                  <?php  while ($row = mysqli_fetch_assoc($result)) {  ?>
                  <tr>
                      <td class="text-center" style="width: 200px;">
                         
                            <barcode code="<?=$row['prodID']; ?>" type="EAN13" /><br />
                            <div><?=  $row['prodName']; ?></div>
                      </td>
                      
                      <td>
                          <?=  $row['prodName']; ?>
                      </td>
                      <td>
                          <?=  $row['prodPrice']; ?>
                      </td>
                      <td>
                          <?=  $row['prodStock']; ?>
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
            $mpdf->SetHeader('รายงานโดย codingthailand | รายงานสินค้าทั้งหมด | ออกรายงานเมื่อ: '.date('d/m/Y H:i:s'));
            $mpdf->margin_footer = 9;
            $mpdf->SetFooter('หน้าที่ {PAGENO}');
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




