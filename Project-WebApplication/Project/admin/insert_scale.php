
<?php
include '../db/database.php';


$custID = $_POST['custID'];
$weight = $_POST['weight'];
$prodTypeID =$_POST['prodTypeID'];
$pt_date = $_POST['pt_date'];

$sql = "INSERT INTO `scale01` ( `custID`,`wieght`, `prodTypeID`, `pt_date`) VALUES (  '$custID','$weight', '$prodTypeID','$pt_date')";
// $sql = "INSERT INTO `scale01` (`order_id`, `wieght`, `prodTypeID`, `custID`, `cust_img`, `pt_date`) VALUES (NULL, '12', '1', '5', '', '2020-02-06')";
// $sql =" INSERT INTO `scale01` (`order_id`, `wieght`, `prodTypeID`, `custID` ) VALUES (NULL, '113', NULL, NULL, '')";
$result = mysqli_query($link, $sql);


if ($result) {
    header("Location: product.php");
    echo "บันทึกเรียบร้อยแล้ว";
    // header('Content-Type: application/json');
    // echo json_encode(array('status' => 'success','message' => 'บันทึกข้อมูลเรียบร้อยแล้ว'));
} else {
    header('Content-Type: application/json');
    $errors = "เกิดข้อผิดพลาดในการบันทึก กรุณาลองใหม่ " . mysqli_error($link);
    echo json_encode(array('status' => 'danger', 'message' => $errors));
    //echo "รหัสประเภทสินค้าซ้ำกัน";
    //echo mysqli_error($link);
}
