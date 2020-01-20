<?php

    include '../db/database.php';
    
    
    $custName = $_POST['custName'];
    $custAddr = $_POST['custAddr'];
    $custUsername = $_POST['custUsername'];
    $custPassword = $_POST['custPassword'];
    $custEmail = $_POST['custEmail'];
    $custPassport = $_POST['custPassport'];
    $custCar = $_POST['custCar'];
    $custTel = $_POST['custTel'];
    

    // $sql = "INSERT INTO product_type ('prodTypeID', 'prodTypeName', 'prodPrice') VALUES ('$prodTypeID',  '$prodTypeName', '$prodPrice')";
    $sql = "INSERT INTO customer(custName, custAddr,custUsername,custPassword,custEmail,custPassport,custCar,custTel) VALUES ( '$custName', '$custAddr','$custUsername','$custPassword','$custEmail','$custPassport','$custCar', '$custTel')";
    $result = mysqli_query($link, $sql);


   
    // $result = "result";
   
    if ($result) {
        header("Location: customer.php");
        echo "บันทึกเรียบร้อยแล้ว";
        // header('Content-Type: application/json');
        // echo json_encode(array('status' => 'success','message' => 'บันทึกข้อมูลเรียบร้อยแล้ว'));
    } else {
        header('Content-Type: application/json');
        $errors = "เกิดข้อผิดพลาดในการบันทึก กรุณาลองใหม่ " . mysqli_error($link);
        echo json_encode(array('status' => 'danger','message' => $errors));
        //echo "รหัสประเภทสินค้าซ้ำกัน";
        //echo mysqli_error($link);
    }