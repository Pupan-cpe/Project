<?php

 include '../db/database.php';
 require_once '../phpexcel/Classes/PHPExcel.php';
    
    
 $objPHPExcel = new PHPExcel();
   
   
 $objPHPExcel->getProperties()->setCreator("Pupan Phonkaew")
           ->setLastModifiedBy("Pupan Phonkaew")
           ->setTitle("Product Type")
           ->setSubject("My Subject")
           ->setDescription("Excel file")
           ->setKeywords("office php")
           ->setCategory("Test result file");
  
  // Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'รหัส')
            ->setCellValue('B1', 'ประเภทสินค้า');

//from mysql
$sql2 = "SELECT * FROM product_type";
$result = mysqli_query($link, $sql2);
$cell = 2;

while ($row = mysqli_fetch_assoc($result)) {     
        $objPHPExcel->getActiveSheet()
                ->setCellValue('A'.$cell, $row['prodTypeID'])
                ->setCellValue('B'.$cell,  $row['prodTypeName']);
        $cell++;
}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('product type export');

$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="product_type.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('./excel/product_type.xlsx');
$objWriter->save('php://output');
exit;
  
  
   
   