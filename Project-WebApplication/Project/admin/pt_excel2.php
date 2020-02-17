<?php

include '../db/database.php';
require_once '../phpexcel/Classes/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();


// Set document properties
$objPHPExcel->getProperties()->setCreator("Pupan Phonkaew")
    ->setLastModifiedBy("Pupan Phonkeaw")
    ->setTitle("PHPExcel ")
    ->setSubject("PHPExcel ")
    ->setDescription("This is the tutorial for PHP Excel from EN|NPU")
    ->setKeywords("office PHPExcel")
    ->setCategory("Tutorial Result");


// Add Data in your file
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1', 'รหัสสินค้า ')
    ->setCellValue('B1', 'ชื่อผู้ขาย')
    ->setCellValue('C1', 'ประเภทสินค้า')
    ->setCellValue('D1', 'น้ำหนัก')
    ->setCellValue('E1', 'ราคาสินค้า')
    ->setCellValue('F1', 'จำนวณเงินที่ได้')
    ->setCellValue('G1', 'วันที่ทำการขาย');



//from mysql
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



$cell = 2;
while ($row = mysqli_fetch_assoc($result1)) {
    $objPHPExcel->getActiveSheet()
        ->setCellValue('A' . $cell, $row['order_id'])
        ->setCellValue('B' . $cell,  $row['custName'])
        ->setCellValue('C' . $cell, $row['prodTypeName'])
        ->setCellValue('D' . $cell,  $row['wieght'])
        ->setCellValue('E' . $cell, $row['prodPrice'])
        ->setCellValue('F' . $cell, $row['Sum(prodPrice * wieght)'])
        ->setCellValue('G' . $cell, $row['pt_date']);


    $cell++;
}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('สรุปยอด');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save('product_type.xlsx');

// Save Excel 2003 file

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//$objWriter->save("product_type.xls");

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="factory02.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
$objWriter->save("php://output");
exit;


/*header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"product_type.xls\"");
header("Cache-Control: max-age=0");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
$objWriter->save("php://output")
 */
